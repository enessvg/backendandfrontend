<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Listeleme kodu
        $items = Item::all();
        return $items; //burda listeyi geri döndürüyoruz
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:items',
            'desc' => 'required',
            'miktar' => 'required',
        ], [
            'name.unique' => 'Aynı isimde ürün bulunmaktadır.',
            'name.required' => 'İsim alanı zorunludur.',
            'desc.required' => 'Açıklama alanı zorunludur.',
            'miktar.required' => 'Miktar alanı zorunludur.',
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->desc = $request->desc;
        $item->miktar = $request->miktar;
        $item->save();
        return response()->json(['message'=>'Save successful!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //idsine göre getirir
        $item = Item::find($id);
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:items,name,' . $id,
            'desc' => 'required',
            'miktar' => 'required',
        ], [
            'name.required' => 'İsim alanı zorunludur.',
            'desc.required' => 'Açıklama alanı zorunludur.',
            'miktar.required' => 'Miktar alanı zorunludur.',
        ]);
        
        //idsine göre güncelleme yapar
        $item = Item::findOrFail($request->id);
        $item->name = $request->name;
        $item->desc = $request->desc;
        $item->miktar = $request->miktar;
        
        $item->save();
        //return response()->json(['message'=>'Update successful!']);
        return response()->json(['message'=>'Update successful!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //idsine göre silme yapar
        $item = Item::destroy($id);
        if($item === 0){
            return response()->json(['message'=>'Böyle bir id yok!']);

        }else{
            return response()->json(['message'=>'Delete successful!']);

        }
        //return response()->json(['message'=>'Deletion successful!']);
       
    }
}
