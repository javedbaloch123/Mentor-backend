<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Course extends Model
{
     use HasFactory,Notifiable,HasApiTokens;

     public function trainer(){
        return $this->belongsTo(Trainer::class, 'trainer_id');
     }
}
