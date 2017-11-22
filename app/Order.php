<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
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
    protected $fillable = ['code', 'weight', 'postage', 'status'];

    public function products()
    {
        return $this->belongsToMany('App\Product','orders_products','order_id')->withPivot('price','amount');;
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
