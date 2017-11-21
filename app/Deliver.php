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
        return $this->belongsToMany('App\Product','delivers_products','deliver_id');
    }
    
}
