<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\VideoLesson;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\StudentPayment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use \Exception;
use Illuminate\Support\Facades\Redirect;;

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

class LMS_IN_ClassRoomPaymentController extends Controller
{
    public function daypiker($class){
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
                return view('Admin/LMS_InClassRoom/class_StudentPayments_Step1',['classroom'=>$classroom]);
            }  
        }
    }


    
    public function index (Request $request,$class){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed"); 
        }else{
            $class = test_input($class);
            $validator = Validator::make(['id' => $class], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else if(0 == validClass($class)){
                return Redirect::back()->with('failed',"operation failed");
            }else{

                $rules = [
                    'Date_From' => 'required|string',
                    'Date_To' => 'required|string'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{
                    $data = $request->input();

                    $Date_From = date_create($data['Date_From']);
                    $Date_To = date_create($data['Date_To']);

                    if($Date_From > $Date_To){
                        return redirect('Manage_Student_Payments')->with('failed',"Invalid Date Range");
                    }else{

                     

                        $Payments = DB::select('SELECT * FROM student_payments,students
                        WHERE 
                            student_payments.SP_S_ID = students.S_ID AND 
                            students.S_CLASS_ROOM_ID = ? AND
                            (student_payments.SP_DATE BETWEEN ? AND ?) 
                            ORDER BY student_payments.SP_DATE DESC'
                        ,[$class,$Date_From,$Date_To]);

                        $classroom = DB::select('SELECT * FROM classrooms WHERE C_ID = ? LIMIT 1',[$class]);
                        return view('Admin/LMS_InClassRoom/class_StudentPayments_Step2',['Payments'=>$Payments,'classroom'=>$classroom]);
                    }
                }


                
            }  
        }
    }

}
