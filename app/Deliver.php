<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'delivers';
    protected $appends = ['statusStr'];
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'weight', 'price', 'status'];

    public function products()
    {
        return $this->belongsToMany('App\Product','delivers_products','deliver_id')->withPivot('price');;
    }

    public function getStatusStrAttribute()
    {
        $str = "";
        if ($this->status == 0) {
            $str = "In preparation";
        } else if ($this->status == 1) {
            $str = "Delivering";
        } else {
            $str = "Received";
        }
        return $str;
    }
    
}
