<?php
/**
 * Created by PhpStorm.
 * User: justas
 * Date: 08/02/2017
 * Time: 13:26
 */

return array(
    "from" => "required",
    "to" => "required",
    "number" => "required|integer|min_len,1",
    "date" => "required",
    "due_date" => "string",
    "payment_terms" => "alpha_space",
    "fields[tax]" => "required|boolean",
    "fields[discounts]" => "required|boolean",
    "fields[shipping]" => "required|boolean",
    "tax"=> "integer",
    "shipping"=> "integer",
    "amount_paid" => "float",
    "terms" => "required"
);