<?php

namespace App\FormAnalyzer;

class AnalyserBase
{    
    public $paramater;
    
    public function __construct($paramater) {
        $this->$paramater = $paramater;
    }

    public function report() {
        
    }

    public function data() {
        
    }

}
