<?php

namespace App\Http\Controllers;

use App\CarInventory;
use App\CarInventoryView;
use Illuminate\Http\Request;
use App\Groups;
use Illuminate\Support\Facades\Auth;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $goods = CarInventoryView::all()
               ->whereIn('group_id', $this->getUserGroupsIds())
               ->where('user_id', Auth::user()->id);
        
        return view('cars.index', [
            'goods' => $goods
        ]);
    }
    
    /**
     * Seleziona le chiavi primarie dei gruppi a cui appartiene l'utente 
     * e le chiavi primarie dei gruppi di cui l'utente è proprietario
     */
    private function getUserGroupsIds() {
        return Groups::getUserGroupsIds();
    }
    
    private function getUserGroupsForSelect() {
        return Groups::getUserGroupsForOptionsSelect();
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
     *
     * @param  \App\CarInventory  $carInventory
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        $groups = $this->getUserGroupsForSelect();
        
        if ($id == 0) {
            
            return response()->json([
               
                'car' => [
                    'id' => 0,
                    'group_id' => 0,
                    'title' => '',
                    'description' => '',
                    'img_file_name' => 'default.jpg',
                    'price' => 0,
                    'registration_number' => '',
                    'kilometres' => 0,
                    'registration_year' => '',
                    'status' => 0
                ],
               
                'groups' => $groups
            ]); 
        }
        
        return response()->json([
            'car' => CarInventoryView::find( $id ),
            'groups'  => $groups
        ]);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarInventory  $carInventory
     * @return \Illuminate\Http\Response
     */
    public function edit(CarInventory $carInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarInventory  $carInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $isNew = ( $request->id == 0 );
        if ( $isNew ) {
            $good = new CarInventory;
        } else {
            $good = CarInventory::find($request->id);
        }  
        
        $good->group_id = $request->group_id;
        $good->title = $request->title;
        $good->description = $request->description;
        $good->img_file_name = $request->img_file_name;
        $good->price = $request->price;
        $good->registration_number = $request->registration_number;
        $good->kilometres = $request->kilometres;
        $good->registration_year = $request->registration_year;
        
        $good->status = $request->status;
        $good->save();
        
        return response()->json([
            'success' => true,
            'carid' => $good->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarInventory  $carInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = CarInventory::find($id);
        $car->deleted = true;
        $car->save();
        
        return redirect()->action(
            'CarsController@index'
        );
    }
}
