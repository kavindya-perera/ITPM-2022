<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\VideoLesson;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Session;
use Redirect;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validClass($id) {
    $classroom = DB::select('SELECT * FROM classrooms WHERE C_ID = ? LIMIT 1',[$id]);
    if($classroom == TRUE){
        return 1;
    }else{
        return 0;
    }
}

function islog(){
    $S_NUMBER = Session::get('S_NUMBER');
    $S_FIRST_NAME = Session::get('S_FIRST_NAME');
    $S_CLASS_ROOM_ID = Session::get('S_CLASS_ROOM_ID');
    if( ($S_NUMBER === NULL) || ($S_FIRST_NAME === NULL) || ($S_CLASS_ROOM_ID === NULL) ){
        return 0;
    }else{
        return 1;
    }
}

class ST_Dashboard extends Controller
{
    //
}
