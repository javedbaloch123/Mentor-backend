<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::with('trainer')->get();
        return $courses;
    }

     public function Single($id){
        $course = Course::with('trainer')->find($id);
        return $course;
    }
}
