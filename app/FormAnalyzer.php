<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormAnalyzer extends Model
{
    //
    protected $table = 'form_analyzers';

    public function form()
    {
        return $this->belongsTo('App\Form');
    }    
}
