<?php

namespace App\Models\Admin;

use App\Models\Admin\Employee;
use App\Models\Admin\Room;
use App\Models\Admin\Shift;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_Schedule extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'work__schedules';

   /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
   protected $guarded = [];

   public function employee(){
    return $this->belongsTo(Employee::class,'emp_id');
   }

   public function room(){
    return $this->belongsTo(Room::class,'room_id');
   }
   public function shift(){
    return $this->belongsTo(Shift::class,'shift_id');
   }

}
