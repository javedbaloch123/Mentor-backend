<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainer::get();
        return view('trainers',['trainers'=>$trainers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
          $validate = Validator::make($request->all(),[
               'name'=>'required',
               'desc'=>'required',
               'skill'=>'required',
               'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // max:2MB
          ]);

          if($validate->fails()){
               return response()->json([
                 'status'=>false,
                 'error'=>$validate->errors(),
               ]);
          }

          $trainer = new Trainer();
          $trainer->name = $request->name;
          $trainer->skill = $request->skill;
          $trainer->desc = $request->desc;

          if($request->hasFile('image')){
               $imageName = time().'.'. $request->image->extension();

               $request->image->move(public_path('trainer_images'),$imageName);
               $trainer->picture = $imageName;
          }
  
         $trainer->save();
         session()->flash('success','Trainer has been saved');
         return response()->json([
                 'status'=>true,
                 'message'=>'data saved successfully',
               ]);
         
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $trainers = Trainer::find($id);
         return view('Edit_trainer',['trainer'=>$trainers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
  
        {
          
              $validate = Validator::make($request->all(),[
               'name'=>'required',
               'skill'=>'required',
               'desc'=>'required',
               'image'=>'nullable',
               
          ]);

          if($validate->fails()){
               return response()->json([
                 'status'=>false,
                 'error'=>$validate->errors(),
               ]);
          }

          $trainer = Trainer::where('id',$request->id)->first();
         
          $trainer->name = $request->name;
          $trainer->skill = $request->skill;
          $trainer->desc = $request->desc;
        
         

          if($request->hasFile('image')){
               $imageName = time().'.'. $request->image->extension();

               $request->image->move(public_path('images'),$imageName);
               $trainer->image = $imageName;
          }
  
         $trainer->save();
         session()->flash('success','Trainer has been updated');
        return response()->json([
                 'status'=>true,
                 'message'=>'data saved successfully',
               ]);
      }
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $trainer = Trainer::find($id);
        $trainer->delete();

        session()->flash('success','Trainer has been deleted');
        return response()->json([
            'status'=>true,
    
        ]);
    }
}
