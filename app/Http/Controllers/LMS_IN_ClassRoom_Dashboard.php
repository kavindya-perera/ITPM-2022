<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Student;
use \Illuminate\Http\Response;
use App\Models\LiveClass;
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
    $classroom = DB::select('SELECT * FROM classrooms WHERE C_ID = ?',[$id]);
    if($classroom == TRUE){
        return 1;
    }else{
        return 0;
    }
}

function islog(){
    $AdminFirstName = Session::get('AdminFirstName');
    $AdminLastName = Session::get('AdminLastName');
    $AdminDesignation = Session::get('AdminDesignation');
    $AdminContactNumber = Session::get('AdminContactNumber');
    $AdminAddress = Session::get('AdminAddress');
    $AdminSystemRole = Session::get('AdminSystemRole');
    if(($AdminSystemRole != 'Administrator') || ($AdminFirstName === NULL) || ($AdminFirstName === NULL) || ($AdminDesignation === NULL) || ($AdminContactNumber === NULL) || ($AdminAddress === NULL)){
        return 0;
    }else{
        return 1;
    }
}

class LMS_IN_ClassRoom_Dashboard extends Controller
{
    //class rooms
    public function index($class){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed"); 
        }else{
            $id = test_input($class);
            $validator = Validator::make(['id' => $id], [ 
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else if(0 == validClass($class)){
                return Redirect::back()->with('failed',"operation failed");
            }else{

 

                $classroom = DB::select('SELECT * FROM classrooms WHERE C_ID = ?',[$class]);
                $live = DB::select('SELECT * FROM live_classes WHERE LC_CLASS_ID = ? LIMIT 1',[$class]);
                $Students = DB::select('SELECT COUNT(S_ID) AS numOfStudents FROM students WHERE S_CLASS_ROOM_ID = ?',[$class]);
                $ActiveStudents = DB::select('SELECT COUNT(S_ID) AS numOfStudents FROM students WHERE S_STATUS=1 AND S_CLASS_ROOM_ID = ?',[$class]);

                $Videos = DB::select('SELECT COUNT(V_ID) AS numOfVideo FROM video_lessons WHERE CLASS_ID = ?',[$class]);

                $TodayPayments = DB::select('SELECT SUM(sp.SP_AMOUNT) AS totalPayments FROM students s, student_payments sp WHERE sp.SP_S_ID = s.S_ID AND sp.SP_DATE=? AND s.S_CLASS_ROOM_ID=?',[date('Y-m-d'),$class]);
                $MonthPayments = DB::select('SELECT SUM(sp.SP_AMOUNT) AS totalPayments FROM students s, student_payments sp WHERE sp.SP_S_ID = s.S_ID AND sp.SP_DATE BETWEEN ? AND ? AND s.S_CLASS_ROOM_ID=?',[date('Y-m')."-1",date('Y-m')."-31",$class]);
                $TotalPayments = DB::select('SELECT SUM(sp.SP_AMOUNT) AS totalPayments FROM students s, student_payments sp WHERE sp.SP_S_ID = s.S_ID AND s.S_CLASS_ROOM_ID=?',[$class]);

                return view('Admin/LMS_InClassRoom/class_Dashboard',[
                    'classroom'=>$classroom , 
                    'live'=>$live , 
                    'Students'=>$Students,
                    'Videos'=>$Videos,
                    'ActiveStudents'=>$ActiveStudents,
                    'TodayPayments'=>$TodayPayments,
                    'MonthPayments'=>$MonthPayments,
                    'TotalPayments'=>$TotalPayments


                ]);
            }  
        }
    }







}
