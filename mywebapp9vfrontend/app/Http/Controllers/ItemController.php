<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function ekle(Request $request){

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

        $token = $request->session()->get('token');
        if (!$token) {
            return redirect('/home')->withErrors(['ekleerror' => 'API token not found.']);
        }else{
            // kaydetme kodu
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token, 
            ])->post('http://127.0.0.1:8000/api/item/add', [
                'name' => $request->name,
                'desc' => $request->desc,
                'miktar' => $request->miktar,
            ]);

            if ($response->successful()) {
                return redirect('/home')->withErrors(['statusok' => 'Kaydetme başarılı']);
            } else {
                return redirect('/home')->withErrors(['statuserror' => 'Kaydedilemedi.']);
            }
        }
        
    }

    public function guncelle(Request $request, $id){
    
     $this->validate($request, [ 
         'name' => 'required|unique:items,name,' . $id,
         'desc' => 'required',
         'miktar' => 'required|regex:/^[^\s]+$/',
     ], [
         'name.required' => 'İsim alanı zorunludur.',
         'desc.required' => 'Açıklama alanı zorunludur.',
         'miktar.required' => 'Miktar alanı zorunludur.',
         
     ]);

        $token = $request->session()->get('token');
        if (!$token) {
            return redirect('/home')->withErrors(['statuserror' => 'API token not found.']);
        }

        // Güncelleme işlemi
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, 
        ])->post('http://127.0.0.1:8000/api/item/update/'. $id, [
            'name' => $request->name,
            'desc' => $request->desc,
            'miktar' => $request->miktar,
        ]);
        
        if ($response->successful()) {
            return redirect('/home')->withErrors(['statusok' => 'Güncelleme başarılı']);
        } else {
            return redirect('/home')->withErrors(['statuserror' => 'Güncellenemedi.']);
        }
    }
    
    
    public function sil(Request $request, $id){  

        $token = $request->session()->get('token');
        if (!$token) {
            return redirect('/home')->withErrors(['statuserror' => 'API token not found.']);
        }

        // Silme kodu
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, 
        ])->post("http://127.0.0.1:8000/api/item/delete/{$id}");

        if ($response->successful()) {
            return redirect('/home')->withErrors(['statusok' => 'Silme başarılı']);
        } else {
            return redirect('/home')->withErrors(['statuserror' => 'Silme işlemi başarısız.']);
        }
    
    }

}