<?php

namespace App\Http\Controllers;

use App\ProductInventory;
use Illuminate\Http\Request;
use App\ProductInventoryView;
use App\Groups;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $goods = ProductInventoryView::all()
                     ->whereIn('id', $this->getUserGroupsIds());
        
        return view('products.index', [
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
               
                'group' => [
                    'id' => 0,
                    'howner_id' => Auth::user()->id,
                    'title' => '',
                    'description' => '',
                    'img_file_name' => 'default.jpg',
                    'visible' => 'Nascosto',
                    'subscription_id' => 0
                ],
               
                'subscriptions' => $groups
            ]); 
        }
        
        return response()->json([
            'product' => ProductInventoryView::find($id),
            'groups' => $groups
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
    public function edit(ProductInventory $productInventory)
    {
        //
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
            
            $good = new ProductInventory;
            $good->img_file_name = $request->img_file_name;
        
        } else {
            $good = ProductInventory::find($request->id);
        }  
        
        $good->title = $request->title;
        $good->description = $request->description;
        $good->visible = $request->visible;
        $good->group_id = $request->group_id;
        $good->price = $request->price;
        
        $good->save();
        
        return response()->json([
            'success' => true,
            'productid' => $good->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductInventory  $productInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductInventory $productInventory)
    {
        //
    }
}
