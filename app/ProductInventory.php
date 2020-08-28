<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'barcode', 'title', 'description', 'img_file_name', 'price', 'status'
    ];
    
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'img_file_name' => 'default.jpg',
        'status' => true,
        'deleted' => false
    ];
}
