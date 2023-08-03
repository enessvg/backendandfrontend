<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout() { 
        
    //     public function logout()  
    //     { 
    //     Auth::user()->tokens->each(function($token, $key) { 
    //         $token->delete();
    //     }); 
     
    //     return response()->json([ 
    //         'message' => 'Logged out successfully!', 
            
    //     ], 200); 
    // } 

        $user = Auth::user();
        $token = $user->currentAccessToken();
        if ($token) {
            $token->delete();
            return response()->json([ 
                'message' => 'Logged out successfully!', 
            ], 200); 
        }
    }
    
}

