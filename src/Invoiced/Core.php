<?php

namespace InvoiceGenerator\Invoiced;
use InvoiceGenerator\DataSanitation\Sanitizer;
use GuzzleHttp\Client;

/**
 * static core class.
 */
class Core
{

    /**
     * Sanitizer object variable
     * @var variable/object
     */
    private $s;

    public $header;
    public $currency;

    /**
     * call the init function
     */
    public function __construct() {
        $this->init();
    }

    /**
     * setup the sanitizer object
     * @return object
     */
    public function init() {
        $this->s = new Sanitizer;
    }

    /**
     * Check if the data needs to be filtered and validate it.
     * @param  array  $invoice Holds all the invoice items
     * @return array           Returns the validated and filtered data array
     */
    public function check(array $invoice) {

        // Check if invoice array is correct.
        return $this->s->doCheck($invoice);
    }

    /**
     * Generate the pdf after the check is done.
     * @return file returns a pdf file.
     */
    public function generate(array $invoiceData, $directDownload = false) {

        $tplData = require __DIR__ . '/../Config/templateData.php';
        $invoiceData = array_merge($tplData, $invoiceData);
        if ($this->header){
            $invoiceData['header'] = $this->header;
        }

        if ($this->currency){
            $invoiceData['currency'] = $this->currency;
        }
        
        /**
         * Setup the client
         * @var Client
         */
        $client = new Client([
            'base_uri'=>'https://invoice-generator.com',
            'verify'=> false
        ]);

        $response = $client->request('POST', 'https://invoice-generator.com', [
            'form_params'=>$invoiceData
        ]);


        if($directDownload == true) {

            $file = $response->getBody();
            $date = \Carbon\Carbon::now();
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="invoice_'.$invoiceData['date'].'_' . $invoiceData['number'] . '.pdf"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . $response->getHeader('Content-Length')[0]);
            echo $file;

        } else {

            return $response;
        }

    }
}