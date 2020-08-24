<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    

    static function getUserGroupsIds() {
        
        $ids = [];
        
        $registredGroupsIds = Member::all()
                   ->where('user_id', Auth::user()->id)
                   ->pluck('group_id');
        
        foreach ($registredGroupsIds as $id) {
            $ids[] = $id;
        }
        
        $propertyGroupIds = Groups::all()    
                          ->where('howner_id', Auth::user()->id)
                          ->where('deleted', false)
                          ->pluck('id');
        
        foreach ($propertyGroupIds as $id) {
            $ids[] = $id;
        }
        
        return $ids;
    }
    
    /**
     * Seleziona in formato text, value, i gruppi di interesse dell'utente 
     * @return [{'text' => $group->title, 'id' => $grou->id}, ... ]
     */
    static function getUserGroupsForOptionsSelect() {
        
        $ids = [];
        $userId = Auth::user()->id;
        $options = [];
        
        $registredGroupsIds = Member::all()
                   ->where('user_id', $userId)
                   ->pluck('group_id');
        
        foreach ($registredGroupsIds as $id) {
            $ids[] = $id;
        }
        
        
        $groups = DB::table('groups')->whereIn('id', $ids)
                                     ->orWhere('howner_id', $userId)
                                     ->get();
        
        foreach ($groups as $group) {
            $options[] = [
                'text' => $group->title,
                'value' => $group->id
            ];
        }
        
        return $options;
    }
}
