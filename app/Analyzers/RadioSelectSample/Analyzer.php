<?php

namespace App\Analyzers\RadioSelectSample;

class Analyzer
{

    public function report(Parameter $parameter) {
        $ret = "You select option ".$parameter->p_select_sample;
        return $ret;
    }

    public function data(Parameter $parameter) {
        return $parameter->p_select_sample;
    }

}
