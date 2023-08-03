<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{

    public function apigetir(){
        $token = Session::get('token');
        
        if (!$token) {
            return redirect('login')->withErrors(['login' => 'Token bulunamadı lütfen giriş yapınız (HOME)']);
        }else{
            // return redirect('/home')->withErrors(['statusok' => 'Giriş başarılı. Hoşgeldiniz']);
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
            ])->get('http://127.0.0.1:8000/api/items');
            
            $veriler = $response->json();
            return view('veriler', ['veriler'=> $veriler]);
        }
        return view('login');
        
    }
    public function uruneklecontrol(){
        $token = Session::get('token');
        if (!$token) {
            return redirect('login')->withErrors(['login' => 'Token bulunamadı lütfen giriş yapınız (ÜRÜN)']);
        }
        else{
            return view('urunekle');
        }
  }
}