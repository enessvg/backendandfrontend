<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(Request $request){

        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($response->successful()) {
            $token = $response->json('token');
            session(['token' => $token]);
            
            return redirect('/home')->withErrors(['statusok' => 'Giriş başarılı. Hoşgeldiniz.....']);
        } else {
            return redirect('/login')
                ->withErrors(['login' => 'E-Posta veya şifre hatalı']);
        }
    }
    
    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|regex:/^[^\s]+$/',
            'c_password' => 'required|same:password',
        ]);
        // [
        //     'name.required' => 'İsim alanı zorunludur.',
        //     'name.min' => 'İsim en az :min karakter olmalıdır.',
        //     'email.required' => 'E-Mail adresi alanı zorunludur.',
        //     'email.email' => 'Geçerli bir E-Mail adresi giriniz.',
        //     'email.unique' => 'Bu E-Mail adresi daha önce kullanılmıştır.',
        //     'password.required' => 'Şifre alanı zorunludur.',
        //     'password.min' => 'Şifre en az :min karakter olmalıdır.',
        //     'c_password.required' => 'Şifre tekrar alanı zorunludur.',
        //     'c_password.same' => 'Şifre tekrarı şifre ile aynı olmalıdır.',
        // ]);        
        $response = Http::post('http://127.0.0.1:8000/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'c_password' => $request->c_password
        ]);
        if ($response->successful()) {
           
            return redirect('http://127.0.0.1:8001/login')->withErrors(['kayitok' => 'Kaydınız tamamlanmıştır giriş yapabilirsiniz.']);
        } else {
            
            // return redirect('http://127.0.0.1:8001/register');
            return redirect('http://127.0.0.1:8001/register')->withErrors(['kayitemail' => 'Bu E-Mail adresi daha önce kullanılmıştır.']);
           
        }
    }

    public function logout(Request $request){  
        $token = $request->session()->get('token');
        if (!$token) {
            return redirect('/login')->withErrors(['login' => 'Token bulunamadı. İlk önce giriş yapınız. (LOGOUT)']);
        }
        else{
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token, 
            ])->get("http://127.0.0.1:8000/api/logout");
            Session::flush(); //çerezlerin hepsini temizler
            return redirect('/login')->withErrors(['kayitok' => 'Çıkış Başarılı ']);
        }
        
    
    }
}
