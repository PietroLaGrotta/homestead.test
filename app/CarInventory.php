<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarInventory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'registration_number', 'title', 'description', 'img_file_name', 'price','registration_year', 'kilometers', 'status'
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
