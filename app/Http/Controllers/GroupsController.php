<?php

namespace App\Http\Controllers;

use App\Groups;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Groups::all()
                ->whereIn('id', $this->getUserGroupsIds())
                ->where('deleted', false);
        
        return view('groups.index', [
            'user' => Auth::user(),
            'groups' => $groups
        ]);
    }
    
    /**
     * Seleziona le chiavi primarie dei gruppi a cui appartiene l'utente 
     * e le chiavi primarie dei gruppi di cui l'utente è proprietario
     */
    private function getUserGroupsIds() {
        return Groups::getUserGroupsIds();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        
        $subscriptions = $this->getAllSubscritions();
        
        if ($id == 0) {
            
            return response()->json([
               
                'group' => [
                    'id' => 0,
                    'howner_id' => Auth::user()->id,
                    'title' => '',
                    'description' => '',
                    'img_file_name' => 'default.jpg',
                    'status' => 0,
                    'subscription_id' => 0
                ],
               
                'subscriptions' => $subscriptions
            ]); 
        }
        
        return response()->json([
            'group' => Groups::find($id),
            'subscriptions' => $subscriptions
        ]);   
    }
    
    private function getAllSubscritions() {
        
        $rawSubscriptions = \App\Subscription::all()
                       ->where('deleted', false)
                       ->where('status', true);
        
        $subscriptions = []; 
        
        foreach ( $rawSubscriptions as $item ) {
            $subscriptions[] = [
                'text' => $item->title,
                'value' => $item->id
            ];
        }
              
        return $subscriptions;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit(Groups $groups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $isNew = ( $request->id == 0 );
        if ( $isNew ) {
            
            $group = new Groups;
            $group->howner_id = $request->howner_id;
            $group->img_file_name = $request->img_file_name;
        
        } else {
            $group = Groups::find($request->id);
        }  
        
        $group->title = $request->title;
        $group->description = $request->description;
        $group->status = $request->status;
        $group->subscription_id = $request->subscription_id;
        
        $group->save();
        
        if ( $isNew ) {
            $this->addHownerAsFirstMember($group->howner_id, $group->id);
        }

        return response()->json([
            'success' => true,
            'groupid' => $group->id
        ]);
    }
    
    function addHownerAsFirstMember($userId, $groupId) {
        
        $member = new Member;
        
        $member->user_id = $userId;
        $member->group_id = $groupId;
        
        $member->product_abled = 
        $member->home_abled = 
        $member->car_abled = true;
        
        $member->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Groups::find($id);
        $group->deleted = true;
        $group->save();
        
        return redirect()->action(
            'GroupsController@index'
        );
    }
}
