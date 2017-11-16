<?php

namespace App\Analyzers\RadioSelectSample;

use App\FormAnalyzer\AnalyserBase;

class Analyser extends AnalyserBase
{

    public function report() {
        return ['sample'=>'test'];
    }

    public function data() {
        return json_encode(['sample'=>'test']);
    }

}
