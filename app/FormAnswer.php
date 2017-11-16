<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormAnswer extends Model
{
    //
    protected $table = 'form_answers';

    public function form()
    {
        return $this->belongsTo('App\Form');
    }
}
