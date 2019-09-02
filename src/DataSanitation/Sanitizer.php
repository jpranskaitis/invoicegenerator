<?php

namespace InvoiceGenerator\DataSanitation;

/**
 * Sanitizer class for invoice input.
 */
class Sanitizer
{

    private $g;

    /**
     * start the init function
     */
    public function __construct() {
        $this->init();
    }

    /**
     * setup a new object.
     * @return [type] [description]
     */
    public function init() {
        $this->g = new \GUMP;
    }

    /**
     * Sanitize the posted data.
     * @param  array $invoiceData data array
     * @return array              sanitized data array
     */
    private function sanitizeData($invoiceData) {
        return $this->g->sanitize($invoiceData);
    }

    /**
     * Run all the check needed.
     * @param  array $invoiceData data array
     * @return boolean            it either returns validated data or an error.
     */
    public function doCheck($invoiceData) {

        $validation = require_once __DIR__ . '/../Config/ValidationRules.php';
        $filter = require_once __DIR__ . '/../Config/FilterRules.php';

        $this->g->validation_rules($validation);
        $this->g->filter_rules($filter);

        $validatedData = $this->g->run($this->sanitizeData($invoiceData));

        if($validatedData === false) {
            return $this->g->get_readable_errors(true);
        } else {
            return $validatedData;
        }
    }

}