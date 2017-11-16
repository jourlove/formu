<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    //
    protected $table = 'forms';

    public function answers()
    {
        return $this->hasMany('App\FormAnswer');
    }

    public function analyzers()
    {
        return $this->hasMany('App\FormAnalyzer');
    }
}
