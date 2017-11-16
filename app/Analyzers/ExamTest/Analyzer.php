<?php

namespace App\Analyzers\ExamTest;

class Analyzer
{

    public $score = 0;

    public function report(Parameter $parameter) {
        $this->run($parameter);
        $ret = "You total score ".$this->score;
        return $ret;
    }

    public function data(Parameter $parameter) {
        $this->run($parameter);        
        return $this->score;
    }

    public function run(Parameter $parameter) {

        if ($parameter->p_model == '2') {
            $this->score += 30;
        };

        if ($parameter->p_view == '1') {
            $this->score += 30;
        };

        if ($parameter->p_contrller == '3') {
            $this->score += 30;
        };

    }

}
