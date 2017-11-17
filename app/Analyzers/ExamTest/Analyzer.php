<?php

namespace App\Analyzers\ExamTest;

class Analyzer
{

    public $score = 0;

    public function report() {
        $namespace = basename(__DIR__);
        view()->addNamespace($namespace, __DIR__);
        return view($namespace.'::report',['data'=>$this->data()]);
    }

    public function data() {
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

        return ['report'=>$this->report(), 'report_data'=>$this->data()];
    }

}
