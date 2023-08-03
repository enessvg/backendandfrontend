<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class RegisterController extends BaseController
{
    /**
     * success register api 
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required|min:3|max:15',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6|regex:/^[^\s]+$/',
            'c_password' => 'required|same:password',
        ]);
    
        if($validator->fails()){
                    return $this->sendError('Validation Error.',$validator->errors());
                }
                $input = $request->all();
                $input['password'] = bcrypt($input['password']);
                $user = User::create($input);
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $success['name'] =  $user->name;
                return $this->sendResponse($success,'User register successfully.');
    }
    /**
     * Login register api 
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user = Auth::user();
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
       
        return $success;
        }else{
        return $this->sendError('Wrong email or password.',['error' =>'Wrong email or password']);
    }
  }
}

