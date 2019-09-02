<?php
/**
 * Created by PhpStorm.
 * User: justas
 * Date: 08/02/2017
 * Time: 13:25
 */

/**
 * Holds default filter rules.
 */

return array(
    "logo" => "sanitize_string|trim",
    "from" => "trim",
    "to" => "trim",
    "payment_terms" => "trim",
    "tax"=> "whole_number",
);