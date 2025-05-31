<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return view('Login');
    }

     public function register(){
        return view('Register');
    }


     public function process(Request $request){

         $validate = Validator::make($request->all(),[
               'name'=> 'required',
               'email'=>'required|email|unique:users',
               'password'=>'required|min:8',
               'cpassword'=>'required|same:password',
               'role'=>'required'
         ]);


         if($validate->fails()){
             return response()->json([
                'status'=>false,
                'error'=>$validate->errors()
             ]);
         }


         $user = new User();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->role = $request->role;
         $user->password = $request->password;

         $user->save();

          return response()->json([
                'status'=>true,
             ]);
    }

     public function processLogin(Request $request){

         $validate = Validator::make($request->all(),[
               'email'=>'required|email|exists:users',
               'password'=>'required|min:8',
               
         ]);


         if($validate->fails()){
             return response()->json([
                'status'=>false,
                'error'=>$validate->errors()
             ]);
         }


        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            
            return response()->json([
                'status'=>true,
             ]);
             
        } else{
             return response()->json([
                'status'=>"error",
                'message'=>'invalid credentials'
             ]);
        }

        

           
    }



    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
