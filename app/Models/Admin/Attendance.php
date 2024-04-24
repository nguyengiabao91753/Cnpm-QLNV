<?php

namespace App\Models\Admin;

use App\Models\Admin\Work_Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'attendances';

   /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
   protected $guarded = [];


   public function work(){
    return $this->belongsTo(Work_Schedule::class,'work_id');
   }
}
