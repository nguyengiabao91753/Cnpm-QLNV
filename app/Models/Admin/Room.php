<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'rooms';

   /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
   protected $guarded = [];
}
