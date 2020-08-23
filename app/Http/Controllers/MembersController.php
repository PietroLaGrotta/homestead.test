<?php

namespace App\Http\Controllers;

use App\Member;
use App\GroupMembersView;
use App\User;
use App\Groups;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($groupId) {
        
        $members = GroupMembersView::all()
                 ->where('group_id', $groupId);
        
        $others = User::all()->except(
            $this->getMembersIds($members)
        );
        
        $group = Groups::find($groupId);
        
        return view('members.index', [
            'group' => $group,
            'members' => $members,
            'users' => $others
        ]);    
    }
    
    private function getMembersIds($members) {
        
        $ids = [];
        foreach ( $members as $member ) {
            $ids[] = $member->user_id;
        }
        return $ids;
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
    public function store(Request $request) {
        
        $member = new Member;
        $member->user_id = $request->userid;
        $member->group_id = $request->groupid;
        $member->save();
        
        return redirect()->to('/members/' . $request->groupid . '/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request ) {
        
        $member = Member::find($request->memberid);
        
        switch ($request->app) {
            case 'products': 
                $member->product_abled = $request->checked;
                break;
            case 'homes': 
                $member->home_abled = $request->checked;
                break;
            case 'cars': 
                $member->car_abled = $request->checked;
                break;
            default : break;
        }
        
        $member->save();
        
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $member = Member::find($id);
        $groupid = $member->group_id;
        $member->delete();
        return redirect()->to('/members/' . $groupid . '/index');
    }
}
