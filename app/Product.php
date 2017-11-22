<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['category_id', 'jan', 'name', 'description', 'color', 'size', 'suitable_age', 'suitable_gender', 'material'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }    

    public function delivers()
    {
        return $this->belongsToMany('App\Deliver','delivers_products','product_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order','orders_products','product_id');
    }

}
