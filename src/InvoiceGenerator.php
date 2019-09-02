<?php

use Carbon\Carbon;
use InvoiceGenerator\Invoiced\Core;

/**
 * Created by PhpStorm.
 * User: justas
 * Date: 08/02/2017
 * Time: 13:35
 */
class InvoiceGenerator
{

    private $invoice_data;
    public $t;


    public function __construct($invoice_data, $header = FALSE, $currency = FALSE, $validation = FALSE, $download = FALSE)

    {
        $date = Carbon::now();
        $twoWeeks = Carbon::now()->addWeeks(2);
        $t = new Core();
        if($validation){
            $this->invoice_data = $t->check($invoice_data);
        }

		$t->header = $header;
		$t->currency = $currency;
        $this->t = $t->generate($invoice_data, $download);
    }
}