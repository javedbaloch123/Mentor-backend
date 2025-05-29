<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $trainers = Trainer::get();
        $courses = Course::get();
        return view('Courses',['trainers'=>$trainers,'courses'=>$courses]);
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
               'title'=>'required',
               'schedual'=>'required',
               'trainer'=>'required',
               'seat'=>'required',
               'fees'=>'required',
               'desc'=>'required',
               'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // max:2MB
          ]);

          if($validate->fails()){
               return response()->json([
                 'status'=>false,
                 'error'=>$validate->errors(),
               ]);
          }

          $course = new Course();
          $course->title = $request->title;
          $course->schedule = $request->schedual;
          $course->trainer_id = $request->trainer;
          $course->seats = $request->seat;
          $course->fee = $request->fees;
          $course->desc = $request->desc;

          if($request->hasFile('image')){
               $imageName = time().'.'. $request->image->extension();

               $request->image->move(public_path('images'),$imageName);
               $course->image = $imageName;
             
          }
  
         $course->save();
         session()->flash('success','Course has been saved');
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
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $course = Course::find($id);  
         $trainers = Trainer::get();
         return view('Edit_course',['course'=>$course,'trainers'=>$trainers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
      {
          
              $validate = Validator::make($request->all(),[
               'title'=>'required',
               'schedule'=>'required',
               'trainer'=>'required',
               'seats'=>'required',
               'fees'=>'required',
               'desc'=>'required',
               'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // max:2MB
          ]);

          if($validate->fails()){
               return response()->json([
                 'status'=>false,
                 'error'=>$validate->errors(),
               ]);
          }

          $course = Course::where('id',$request->id)->first();
         
          $course->title = $request->title;
          $course->schedule = $request->schedule;
          $course->trainer_id = $request->trainer;
          $course->seats = $request->seats;
          $course->fee = $request->fees;
          $course->desc = $request->desc;

          if($request->hasFile('image')){
               $imageName = time().'.'. $request->image->extension();

               $request->image->move(public_path('images'),$imageName);
               $course->image = $imageName;
          }
  
         $course->save();
         session()->flash('success','Course has been updated');
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
        $course = Course::find($id);
        $course->delete();

        session()->flash('success','Course has been deleted');
        return response()->json([
            'status'=>true,
    
        ]);
    }
}
