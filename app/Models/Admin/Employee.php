<?php

namespace App\Models\Admin;

use App\Models\Admin\Level;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'employees';

   /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
   protected $guarded = [];

   public function position(){
    return $this->belongsTo(Position::class,'position_id');
   }

   public function salary(){
    return $this->belongsTo(Salary::class,'salary_level');
   }

   
}
