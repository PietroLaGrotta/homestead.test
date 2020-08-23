<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeInventory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'property_code', 'title', 'description', 'img_file_name', 'price','address', 'country', 'zip_code', 'position', 'visible'
    ];
    
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'img_file_name' => 'default.jpg',
        'visible' => true,
        'deleted' => false
    ];
}
