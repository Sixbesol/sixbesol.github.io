<?php

/**
 *  https://stackoverflow.com/questions/1312300/how-to-pass-parameters-to-php-template-rendered-with-include
 *
 * @param $fn
 * @return string
 */
function function_get_output($fn)
{
    $args = func_get_args();
    unset($args[0]);
    ob_start();
    call_user_func_array($fn, $args);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}


/**
 *  Display the template
 *
 * @param $template
 * @param array $params
 */
function display($template, $params = array())
{
    extract($params);
    include $template;
}


/**
 *
 * Returns template as a string without making an output, useful to assign the output to a variable
 *
 * @param $template
 * @param array $params
 * @return string
 */
function render($template, $params = array())
{
    return function_get_output('display', $template, $params);
}