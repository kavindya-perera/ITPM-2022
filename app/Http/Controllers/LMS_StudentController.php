<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentPayment;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use \Exception;
use Illuminate\Support\Facades\Redirect;

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

class LMS_StudentController extends Controller
{
           //add student view
            public function addStudent(){
                if(islog() != 1){
                    return redirect('Logout')->with('failed',"operation failed");
                }else{
                    $classrooms = DB::select('SELECT C_ID,C_NAME FROM classrooms ORDER BY C_NAME ASC');
                    $RandomNumber = "WITC".date('y').rand(10,99).rand(10,99);
                    $invalidStudentNumber = DB::select('SELECT * FROM students WHERE S_NUMBER =? LIMIT 1',[$RandomNumber]);
                    if($invalidStudentNumber == TRUE){
                        return Redirect::back()->with('failed',"Invalid Student Number. Please Try Again.");
                    }else{
                        return view('Admin/AddStudent',['classrooms'=>$classrooms,'StudentNumber'=>$RandomNumber]);
                    }
                }
            } 


            public function insert(Request $request){
                if(islog() != 1){
                    return redirect('Logout')->with('failed',"operation failed");
                }else{
                    $rules = [
                        'S_NUMBER' => 'required|string|min:3|max:10',
                        'S_FIRST_NAME' => 'required|string|min:3|max:50',
                        'S_LAST_NAME' => 'required|string|min:3|max:50',
                        'S_FULL_NAME' => 'required|string|min:3|max:200',
                        'S_NIC' => 'required_if:type,max:12',
                        'S_AGE' => 'required|numeric|digits:2',
                        'S_BIRTHDAY' => 'required|date|max:11',
                        'S_GENDER' => 'required|string|max:11',
                        'S_CONTACT_NUMBER_1' => 'required|numeric|digits:10',
                        'S_CONTACT_NUMBER_2' => 'required_if:type,numeric',
                        'S_WHATSAPP_NUMBER' => 'required_if:type,numeric',
                        'S_ADDRESS' => 'required|string|max:255',
                        'S_P_NAME' => 'required|string|max:200',
                        'S_P_CONTACT_NUMBER' => 'required|numeric|digits:10',
                        'S_CLASS_ROOM_ID' => 'required|numeric'
                    ];
                    $validator = Validator::make($request->all(),$rules);
                    if ($validator->fails()) {
                        return Redirect::back()->with('failed',"operation failed");
                    }else{

                        $data = $request->input();
                        try{
                            $Student = new Student;
                            $Student->S_NUMBER = test_input($data['S_NUMBER']);
                            $Student->S_FIRST_NAME = test_input($data['S_FIRST_NAME']);
                            $Student->S_LAST_NAME = test_input($data['S_LAST_NAME']);
                            $Student->S_FULL_NAME = test_input($data['S_FULL_NAME']);
                            $Student->S_NIC = test_input($data['S_NIC']);
                            $Student->S_AGE = test_input($data['S_AGE']);
                            $Student->S_BIRTHDAY = test_input($data['S_BIRTHDAY']);
                            $Student->S_GENDER = test_input($data['S_GENDER']);
                            $Student->S_CONTACT_NUMBER_1 = test_input($data['S_CONTACT_NUMBER_1']);
                            $Student->S_CONTACT_NUMBER_2 = test_input($data['S_CONTACT_NUMBER_2']);
                            $Student->S_WHATSAPP_NUMBER = test_input($data['S_WHATSAPP_NUMBER']);
                            $Student->S_EMAIL = test_input($data['S_EMAIL']);
                            $Student->S_ADDRESS = test_input($data['S_ADDRESS']);
                            $Student->S_P_NAME = test_input($data['S_P_NAME']);
                            $Student->S_P_CONTACT_NUMBER = test_input($data['S_P_CONTACT_NUMBER']);
                            $Student->S_CLASS_ROOM_ID = test_input($data['S_CLASS_ROOM_ID']);
                            $Student->S_USERNAME = test_input($data['S_NUMBER']);
                            $Student->S_PASSWORD = test_input(sha1($data['S_NUMBER']));
                            if($Student->save()){
                                return Redirect::back()->with('status',"New Student has been created.");
                            }else{
                                return Redirect::back()->with('failed',"operation failed");
                            }
                    
                        }
                        catch(Exception $e){
                            return Redirect::back()->with('failed',"operation failed");
                        }
                         
                    }
                }
            }




    //Manage student
    public function index(){
        if(islog() == 1){
            $Students = DB::select('SELECT * FROM students ORDER BY S_NUMBER DESC');
            return view('Admin/ManageStudents',['Students'=>$Students]);
        }else{
            return redirect('Logout')->with('failed',"operation failed");
        }
    }


        //Employee status Controller
        public function status(Request $request,$id,$action) {
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $validator = Validator::make(['id' => $id],['action' => $action], [
                    'id' => 'required|numeric',
                    'action' => 'required|numeric',
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else {
        
                    if($action == 0){
                        DB::update('UPDATE students SET S_STATUS = ? WHERE S_ID = ?',[$action,$id]);
                        return Redirect::back()->with('status',"Student has been Disabled!"); 
                       
                    }else if($action == 1){
                        DB::update('UPDATE students SET S_STATUS = ? WHERE S_ID = ?',[$action,$id]);
                        return Redirect::back()->with('status',"Student has been Activated!"); 
                    }else{
                        return Redirect::back()->with('failed',"operation failed");
                    }
                    
                }
            }
    
        }



   //student Delete action
    public function destroy($id) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $id = test_input($id);
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{
                DB::delete('DELETE FROM students WHERE S_ID = ?',[$id]);
                return Redirect::back()->with('status',"Employee details has been deleted!");
            }
        }
    }


           //classroom Edit View 
        public function show($id) {
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $id = test_input($id);
                $validator = Validator::make(['id' => $id], [
                    'id' => 'required|numeric'
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else {
                    $Data1 = DB::select('SELECT * FROM students,classrooms WHERE classrooms.C_ID = students.S_CLASS_ROOM_ID AND students.S_ID  = ? LIMIT 1',[$id]);
                    $Data2 = DB::select('SELECT C_ID,C_NAME FROM classrooms ORDER BY C_NAME ASC');
                    if($Data1 == TRUE && $Data2 == TRUE){
                        return view('Admin/EditStudent',['student'=>$Data1,'classrooms'=>$Data2]);
                    }else{
                        return Redirect::back()->with('failed',"operation failed");
                    }
                }
            }
            
        }



        //classroom edit action
    public function edit(Request $request,$id) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else {
                $rules = [
                    'S_FIRST_NAME' => 'required|string|min:3|max:50',
                    'S_LAST_NAME' => 'required|string|min:3|max:50',
                    'S_FULL_NAME' => 'required|string|min:3|max:200',
                    'S_NIC' => 'required_if:type,max:12',
                    'S_AGE' => 'required|numeric|digits:2',
                    'S_BIRTHDAY' => 'required|date|max:11',
                    'S_GENDER' => 'required|string|max:11',
                    'S_CONTACT_NUMBER_1' => 'required|numeric|digits:10',
                    'S_CONTACT_NUMBER_2' => 'required_if:type,numeric',
                    'S_WHATSAPP_NUMBER' => 'required_if:type,numeric',
                    'S_ADDRESS' => 'required|string|max:255',
                    'S_P_NAME' => 'required|string|max:200',
                    'S_P_CONTACT_NUMBER' => 'required|numeric|digits:10',
                    'S_CLASS_ROOM_ID' => 'required|numeric',
                    'PASSWORD' => 'required|string|min:3|max:50',
                    'RE_PASSWORD' => 'required|string|min:3|max:50'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                    $S_FIRST_NAME = $request->input(test_input('S_FIRST_NAME'));
                    $S_LAST_NAME = $request->input(test_input('S_LAST_NAME'));
                    $S_FULL_NAME = $request->input(test_input('S_FULL_NAME'));
                    $S_NIC = $request->input(test_input('S_NIC'));
                    $S_AGE = $request->input(test_input('S_AGE'));
                    $S_BIRTHDAY = $request->input(test_input('S_BIRTHDAY'));
                    $S_GENDER = $request->input(test_input('S_GENDER'));
                    $S_CONTACT_NUMBER_1 = $request->input(test_input('S_CONTACT_NUMBER_1'));
                    $S_CONTACT_NUMBER_2 = $request->input(test_input('S_CONTACT_NUMBER_2'));
                    $S_WHATSAPP_NUMBER = $request->input(test_input('S_WHATSAPP_NUMBER'));
                    $S_EMAIL = $request->input(test_input('S_EMAIL'));
                    $S_ADDRESS = $request->input(test_input('S_ADDRESS'));
                    $S_P_NAME = $request->input(test_input('S_P_NAME'));
                    $S_P_CONTACT_NUMBER = $request->input(test_input('S_P_CONTACT_NUMBER'));
                    $S_CLASS_ROOM_ID = $request->input(test_input('S_CLASS_ROOM_ID'));

                    $PASSWORD = $request->input(test_input('PASSWORD'));
                    $RE_PASSWORD = $request->input(test_input('RE_PASSWORD'));

                    if($PASSWORD != $RE_PASSWORD){
                        return Redirect::back()->with('failed',"Passwords do not match. Try Again");
                    }else{
        
                        DB::update('UPDATE students SET 
                            S_FIRST_NAME=?, 
                            S_LAST_NAME=?, 
                            S_FULL_NAME=?, 
                            S_NIC=?, 
                            S_AGE=?, 
                            S_BIRTHDAY=?, 
                            S_GENDER=?, 
                            S_CONTACT_NUMBER_1=?, 
                            S_CONTACT_NUMBER_2=?, 
                            S_WHATSAPP_NUMBER=?, 
                            S_EMAIL=?, 
                            S_ADDRESS=?, 
                            S_P_NAME=?, 
                            S_P_CONTACT_NUMBER=?, 
                            S_CLASS_ROOM_ID=?,
                            S_PASSWORD = ? 
                        WHERE S_ID = ?',[
                            $S_FIRST_NAME,
                            $S_LAST_NAME,
                            $S_FULL_NAME,
                            $S_NIC,
                            $S_AGE,
                            $S_BIRTHDAY,
                            $S_GENDER,
                            $S_CONTACT_NUMBER_1,
                            $S_CONTACT_NUMBER_2,
                            $S_WHATSAPP_NUMBER,
                            $S_EMAIL,
                            $S_ADDRESS,
                            $S_P_NAME,
                            $S_P_CONTACT_NUMBER,
                            $S_CLASS_ROOM_ID,
                            sha1($PASSWORD),
                            $id,
                        ]);
                        return redirect('AD_ManageStudents')->with('status',"Student details have been Updated!");

                    }

                
                }
            }
        }
    }


    public function view($id) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $id = test_input($id);
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else {
                $Data1 = DB::select('SELECT * FROM students,classrooms WHERE students.S_CLASS_ROOM_ID = classrooms.C_ID   AND students.S_ID  = ? LIMIT 1',[$id]);
                $Data2 = DB::select('SELECT * FROM student_payments WHERE SP_S_ID  = ?',[$id]);
                $Data3 = DB::select('SELECT * FROM attendances WHERE A_S_ID  = ?',[$id]);
                if($Data1 == TRUE){
                    return view('Admin/ViewStudent',['student'=>$Data1,'payments'=>$Data2,'attendances'=>$Data3]);
                }else{
                    return Redirect::back()->with('failed',"operation failed");
                }
            }
        }
        
    }


    public function Download_Setudent_Details($id) {
        $Data = DB::select('SELECT * FROM students,classrooms WHERE classrooms.C_ID = students.S_CLASS_ROOM_ID AND students.S_ID  = ? LIMIT 1',[$id]);
        return view('Download/DownloadStudentDetails',['student'=>$Data]);

    }

    public function Download_Setudent_Payment($id) {
        $Data = DB::select('SELECT * FROM students,student_payments,classrooms WHERE classrooms.C_ID = students.S_CLASS_ROOM_ID AND student_payments.SP_S_ID = students.S_ID AND students.S_ID  = ? ',[$id]);
        if($Data == TRUE){
            return view('Download/DownloadStudentPayment',['payments'=>$Data]);
        }else{
            return Redirect::back()->with('failed',"No Payments");
        }
        

    }



       //Class Manage student
    public function classStudents($class){
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
            
                $classroom = DB::select('SELECT * FROM classrooms WHERE C_ID = ? LIMIT 1',[$class]);
                $Students = DB::select('SELECT * FROM students WHERE S_CLASS_ROOM_ID = ? ORDER BY S_NUMBER DESC',[$class]);
                return view('Admin/LMS_InClassRoom/class_ManageStudents',['Students'=>$Students , 'classroom'=>$classroom]);
            }
        }
    }



    
    public function classView($id,$class) {
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

                $classroom = DB::select('SELECT * FROM classrooms WHERE C_ID = ? LIMIT 1',[$class]);
                $Data1 = DB::select('SELECT * FROM students WHERE S_ID  = ? AND S_CLASS_ROOM_ID = ? LIMIT 1',[$id,$class]);
                $Data2 = DB::select('SELECT * FROM student_payments WHERE SP_S_ID  = ?',[$id]);
                $Data3 = DB::select('SELECT * FROM attendances WHERE A_S_ID  = ?',[$id]);
                if($Data1 == TRUE){
                    return view('Admin/LMS_InClassRoom/class_ViewStudent',['student'=>$Data1, 'classroom'=>$classroom,'payments'=>$Data2,'attendances'=>$Data3]);
                }else{
                    return Redirect::back()->with('failed',"operation failed");
                }

            }
        }
        
    }



    public function changeClassroom($id,$class) {
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

                $classroom = DB::select('SELECT * FROM classrooms WHERE C_ID = ? LIMIT 1',[$class]);
                $classrooms = DB::select('SELECT * FROM classrooms ORDER BY C_NAME ASC');
                $Data1 = DB::select('SELECT * FROM students,classrooms WHERE classrooms.C_ID = students.S_CLASS_ROOM_ID AND students.S_ID  = ? AND students.S_CLASS_ROOM_ID = ? LIMIT 1',[$id,$class]);
                if($Data1 == TRUE){
                    return view('Admin/LMS_InClassRoom/class_ChangeClassRoom',['student'=>$Data1, 'classroom'=>$classroom,'classrooms'=>$classrooms]);
                }else{
                    return Redirect::back()->with('failed',"operation failed");
                }

            }
        }
        
    }


    public function changeAction(Request $request,$id,$class) {
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
                    'C_ID' => 'required|numeric'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

             
                    $S_CLASS_ROOM_ID = $request->input(test_input('C_ID'));
        
                    DB::update('UPDATE students SET 
                        S_CLASS_ROOM_ID=? 
                    WHERE S_ID = ?',[
                        $S_CLASS_ROOM_ID,
                        $id,
                    ]);
                    return redirect('class_Students/'.$class)->with('status',"Student details have been Updated!");

                 

                
                }

            }
        }
        
    }


    




}
