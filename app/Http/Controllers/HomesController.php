<?php

namespace App\Http\Controllers;

use App\HomeInventory;
use App\HomeInventoryView;
use Illuminate\Http\Request;
use App\Groups;

class HomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $goods = HomeInventoryView::all()
               ->whereIn('id', $this->getUserGroupsIds());
        
        return view('homes.index', [
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
     * @param  \App\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        $groups = $this->getUserGroupsForSelect();
        
        if ($id == 0) {
            
            return response()->json([
               
                'homes' => [
                    'id' => 0,
                    'group_id' => 0,
                    'property_code' => '',
                    'title' => '',
                    'description' => '',
                    'img_file_name' => 'default.jpg',
                    'price' => 0,
                    'address' => '',
                    'country' => '',
                    'zip_code' => 0,
                    'visible' => 0,
                ],
               
                'groups' => $groups
            ]); 
        }
        
        return response()->json([
            'homes' => HomeInventoryView::find( $id ),
            'groups'  => $groups
        ]);   
    }
    
    private function getUserGroupsForSelect() {
        return Groups::getUserGroupsForOptionsSelect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeInventory $productInventory) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $isNew = ( $request->id == 0 );
        if ( $isNew ) {
            $good = new HomeInventory;
        } else {
            $good = HomeInventory::find($request->id);
        }  
        
        $good->group_id = $request->group_id;
        $good->property_code = $request->property_code;
        $good->title = $request->title;
        $good->description = $request->description;
        $good->img_file_name = $request->img_file_name;
        $good->price = $request->price;
        $good->address = $request->address;
        $good->country = $request->country;
        $good->zip_code = $request->zip_code;
        $good->visible = $request->visible;
        
        $good->save();
        
        return response()->json([
            'success' => true,
            'homeid' => $good->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = HomeInventory::find($id);
        $product->deleted = true;
        $product->save();
        
        return redirect()->action(
            'HomesController@index'
        );
    }
}
