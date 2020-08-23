<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'howner_id', 'subscription_id', 'title', 'description', 'img_file_name'
    ];
    
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'img_file_name' => 'default.jpg',
        'visible' => 'Visibile',
        'deleted' => false
    ];
    
//    function isHowner($currentUserId): string {
//        return ($this->id == $currentUserId) ? 'Si' : 'No';
//    }
}
