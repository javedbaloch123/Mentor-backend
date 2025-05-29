<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request){
    
         $validate = Validator::make($request->all(),[
            'name'=> 'required|min:5|max:20',
            'subject'=> 'required|min:10',
            'email'=> 'required|email',
            'message'=>'required|min:100'
         ]);


         if($validate->fails()){
            return response()->json([
                'status'=>false,
                'error'=>$validate->errors()
            ]);
         }

         $contact = new Contact();
         $contact->name = $request->name;
         $contact->email = $request->email;
         $contact->subject = $request->subject;
         $contact->message = $request->message;

         $contact->save();

          return response()->json([
                'status'=> true,
            ]);
    }
}
