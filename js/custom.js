function paymentSelectionHandler() {
    $("#stripe-button").hide();
}

//set PayPal payment once loaded as it is selected in index.php (radio button)
$(window).on("load", function () {
    paymentSelectionHandler();
});

var formOrder = $('#order-form'), formState = formOrder.serialize();
var requested = false;
var productItems = '', items;

function generateItems() {
    items = formItemsPaypalObj();
    items.forEach(function(item){
        item.quantity = '' + item.quantity
    });
    productItems = '{"items": ' + JSON.stringify(items) + '}';
    $('#pr-items').val(productItems);
}

$(formOrder).on('click', generateItems);

//$("input[name='payment_method']").click(paymentSelectionHandler);
$('#paypal-buttons-container').addClass('hidden');
$('#process-order-btn').addClass('hidden');
$('form :input').on('change input', function() {

   // if(formOrder.serialize() !== formState) {
        formState = formOrder.serialize();
        $('#paypal-buttons-container').addClass('hidden');

        //Generate value for "items" input
        generateItems();

        var qtdError = '<br>Quantity can not be zero.';
        var formError = '<br>Please fill all required fields.';
        var curErrors = '';

        if (items.length < 1) {
            //qtd == 0
            curErrors += qtdError;
        }
        if (validateFormInputs() === false || validateCountrySelect() === false) {
            //form data incorrect
            curErrors += formError;
        }

        if (!curErrors.length) {
            $('#paypal-buttons-container').removeClass('hidden');
            $('#process-order-btn').removeClass('hidden');
            $('#isErrorrs').html('');

        } else {
            $('#paypal-buttons-container').addClass('hidden');
            $('#process-order-btn').addClass('hidden');
            $('#isErrorrs').html('<p>Problems:' + curErrors + '</p>');
        }

        console.log('validateFormInputs: ' + validateFormInputs());
        console.log('validateCountrySelect: ' + validateCountrySelect());
        console.log(curErrors);

   // }
});



// Close Checkout on page navigation:
window.addEventListener('popstate', function () {
    handler.close();
});
//END Handle Stripe payment


//Functions Below
function isValid() {
    return document.querySelector('#check').checked;
}

function onChangeCheckbox(handler) {
    document.querySelector('#check').addEventListener('change', handler);
}

function toggleButton(actions) {
    return isValid() ? actions.enable() : actions.disable();
}


//validate quantatiy more than zero
$("#order-form select.quantity, #order-form input, #order-form select[name='addressCountry']").change(function () {

    var items = formItemsPaypalObj();

    if (items.length > 0 && validateFormInputs() == true && validateCountrySelect() == true) {
        if ($("#check").prop("checked") == false) //allow
            $("#check").trigger("click");
    } else {
        if ($("#check").prop("checked") == true) //prevent
            $("#check").trigger("click");
    }


});


function stripeDescription() {
    var items = formItemsPaypalObj();

    var description = "";
    $.each(items, function (key, value) {
        description += value.quantity + " x " + value.name + ". ";
    });

    return description;
}

function formItemsPaypalObj() {
    var items = [];
    $("#order-form-table tr").each(function () {
        $this = $(this);


        //Skip headers
        if ($this.find("th").length) {
            return true;
        }

        $select = $this.find("select");

        //Skip zero quantatiy
        if ($select.find("option:selected").index() == 0) {
            return true;
        }

        var item = {};

        item.name = $this.find("td:first").text();
        //  item.description = "Desctiption";
        item.quantity = $select.find("option:selected").index();
        item.price = $this.find(".unit-cost").text();
        item.currency = "EUR";
        items.push(item);
    });


    return items;
}


function validateFormInputs() {
    var $form = $("#order-form");
    if ($form[0].checkValidity() == true) {
        //Allow
        return true;
    } else {
        //Prevent
        return false;
    }
}

function validateCountrySelect($this) {
    var $select = $("#order-form select[name='addressCountry']");

    var $selectedValue = $select.find("option:checked").val();
    //validate Select element sicne checkValidatidy does not work on it
    if ($selectedValue == '') {
        return false;
    } else {
        return true;
    }
}


function _createAjaxOrderData(payment_method) {
    var items = formItemsPaypalObj();

    var total = $("input[name='total']").val();
    var subtotal = $("input[name='subtotal']").val();
    var shipping = $("input[name='shipping']").val();

    var shipping_address = {};
    shipping_address.recipient_name = $("input[name='name']").val();
    shipping_address.email = $("input[name='email']").val();
    shipping_address.line1 = $("input[name='street']").val();
    shipping_address.line2 = $("input[name='house']").val();
    shipping_address.city = $("input[name='city']").val();
    shipping_address.country_code = $("#order-form select[name='addressCountry'] option:selected").val();
    shipping_address.postal_code = $("input[name='postcode']").val();
    shipping_address.phone = $("input[name='telephone']").val();

    var payment_info = {};
    payment_info.payment_method = payment_method; //"paypal,"credit_card"
    payment_info.total = total;
    payment_info.subtotal = subtotal; //total - shipping
    payment_info.shipping = shipping; //shipping cost

    return {items: items, shipping_address: shipping_address, payment_info: payment_info}
}

/**
 * Disable Striple
 */

/*
function processStripeOrder(stripeToken, stripeEmail) {
    var dataObj = _createAjaxOrderData("credit_card");

    dataObj.payment_info.stripeToken = stripeToken;
    dataObj.payment_info.stripeEmail = stripeEmail;

    $.ajax({
        type: "POST",
        url: "process_stripe_order.php",
        cache: false,
        data: {
            items: dataObj.items,
            shipping_address: dataObj.shipping_address,
            payment_info: dataObj.payment_info,
            stripeToken: stripeToken,
            stripeEmail: stripeEmail
        },
        dataType: "json",
        error: function (xhr, ajaxOptions, thrownError) {
            $("#no-interaction-background").hide();
            alert(thrownError);
        },
        success: function (data) {
            if (data.result == true) {
                var hash = data.hash; //unique record hash
                window.location.href = "http://www.mini-e-store.tk/order_thankyou.php?hash=" + hash;
            } else {
                $("#no-interaction-background").hide();
                alert(data.message)
            }
        },
        complete: function (transport) {
        }
    });
}*/

function processPaypalOrder(paymentMethod) {
    var dataObj = _createAjaxOrderData("paypal");

    $.ajax({
        type: "POST",
        url: "process_paypal_order.php",
        cache: false,
        data: {
            items: dataObj.items,
            shipping_address: dataObj.shipping_address,
            payment_info: dataObj.payment_info
        },
        dataType: "json",
        error: function (xhr, ajaxOptions, thrownError) {
            $("#no-interaction-background").hide();
            alert(thrownError);
        },
        success: function (data) {
            if (data.result == true) {
                var hash = data.hash; //unique record hash
                window.location.href = "http://www.mini-e-store.tk/order_thankyou.php?hash=" + hash;
            } else {
                $("#no-interaction-background").hide();
                alert(data.message)
            }
        },
        complete: function (transport) {

        }
    });
}


