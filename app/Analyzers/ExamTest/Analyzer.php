<?php

namespace App\Analyzers\ExamTest;

class Analyzer
{

    public $score = 0;

    public function report(Parameter $parameter) {
        $data = $this->data($parameter);
        $namespace = basename(__DIR__);
        view()->addNamespace($namespace, __DIR__);
        return view($namespace.'::report',['data'=>$data]);
    }

    public function data(Parameter $parameter) {

        if ($parameter->p_model == '2') {
            $this->score += 30;
        };

        if ($parameter->p_view == '1') {
            $this->score += 30;
        };

        if ($parameter->p_contrller == '3') {
            $this->score += 30;
        };

        return $this->score;

    }

}
