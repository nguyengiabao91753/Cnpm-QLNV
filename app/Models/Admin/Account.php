<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory; 

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'users';

   /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
   protected $guarded = [];

   public function level(){
    return $this->belongsTo(Level::class,'level_id');
   }
}
