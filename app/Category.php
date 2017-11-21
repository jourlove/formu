<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $appends = ['fullName'];
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
    protected $fillable = ['parent_id', 'name', 'layer'];

    public function getFullNameAttribute()
    {
        $thisCate = $this;
        $fullName = $this->name;
        while($thisCate->parent_id) {
            $thisCate = Category::find($thisCate->parent_id);
            $fullName = $thisCate->name.":".$fullName;
            
        }
        return $fullName;
    }
}
