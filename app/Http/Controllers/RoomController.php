<?php

namespace App\Http\Controllers;

use App\Models\Admin\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function getroom(string $id){
        $room['data'] = Room::where('department_id',$id)->get();
        return response()->json($room);
    }
}
