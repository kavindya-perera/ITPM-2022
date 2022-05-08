<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use \Exception;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

class AdminEmployeeController extends Controller
{


    //add employee view
    public function addEmployee(){
        if(islog() == 1){
            $RandomNumber = "WITC".rand(10,99).rand(10,99);
            $Employees = DB::select('SELECT * FROM employees WHERE EM_NUMBER =?',[$RandomNumber]);
            if($Employees == TRUE){
                return redirect('AD_AddTask');
            }else{
                return view('Admin/AddEmployee',['EMNUMBER'=>$RandomNumber]);
            }
            
        }else{
            return redirect('Logout')->with('failed',"operation failed");
        }

    }


    // create new employee
    public function insert(Request $request){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $rules = [
                'FIRST_NAME' => 'required|string|min:3|max:100',
                'LAST_NAME' => 'required|string|min:3|max:100',
                'EM_NUMBER' => 'required|string|min:3|max:100',
                'DESIGNAMTION' => 'required|string|min:3|max:100',
                'SYSTEM_ROLE' => 'required|string|min:3|max:100',
                'BIRTHDAY' => 'required',
                'AGE' => 'required|numeric',
                'CONTACT_NUMBER' => 'required|numeric',
                'PHOTO' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'ADDRESS' => 'required|string|min:5|max:225',
                'EMAIL' => 'required|email|min:5|max:225',
                'PASSWORD' => 'required|string|min:5|max:50'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return redirect('AD_AddEmployee')->with('failed',"operation failed");
            }else{

                $data = $request->input();
                if($data['PASSWORD'] != $data['RE_PASSWORD']){
                    return redirect('AD_AddEmployee')->with('failed',"Password does not match. Try again!");
                }else{

                 
                    $EM_NUMBER = test_input($data['EM_NUMBER']);
                    $invalidEM_Number = DB::select('SELECT EM_ID FROM employees WHERE EM_NUMBER = ? LIMIT 1',[$EM_NUMBER]);
                    if($invalidEM_Number == TRUE){
                        return redirect('AD_AddEmployee')->with('failed',"Invalid Employee Number. Try Again");
                    }else{

                        $EMAIL = test_input($data['EMAIL']);
                        $invalidEmail = DB::select('SELECT EM_ID FROM employees WHERE EM_Email = ? LIMIT 1',[$EMAIL]);
                        if($invalidEmail == TRUE){
                            return redirect('AD_AddEmployee')->with('failed',"This email has been already used. Try again with another email.");
                        }else{

                            $imageName = time().'.'.$request->PHOTO->extension(); 
                            $request->PHOTO->move(public_path('employee'), $imageName);
                            try{
                                $employee = new Employee;
                                $employee->EM_NUMBER = test_input($data['EM_NUMBER']);
                                $employee->EM_SystemRole = test_input($data['SYSTEM_ROLE']);
                                $employee->EM_FirstName = test_input($data['FIRST_NAME']);
                                $employee->EM_LastName = test_input($data['LAST_NAME']);
                                $employee->EM_Designation = test_input($data['DESIGNAMTION']);
                                $employee->EM_AGE = test_input($data['AGE']);
                                $employee->EM_BIRTHDAY = test_input($data['BIRTHDAY']);
                                $employee->EM_ContactNumber = test_input($data['CONTACT_NUMBER']);
                                $employee->EM_Address = test_input($data['ADDRESS']);
                                $employee->EM_IMAGE = $imageName;
                                $employee->EM_Email = test_input($data['EMAIL']);
                                $employee->EM_Password = sha1(test_input($data['PASSWORD']));
                                if($employee->save()){
                                    return redirect('AD_AddEmployee')->with('status',"New Employee has been created.");
                                }else{
                                    return redirect('AD_AddEmployee ')->with('failed',"operation failed");
                                }
             
                            }
                            catch(Exception $e){
                                return redirect('AD_AddEmployee ')->with('failed',"operation failed");
                            }
                       }
                    }

   

                }

            }
        }

    }


    //Manage Employees
    public function index(){
        if(islog() == 1){
            $Employees = DB::select('SELECT * FROM employees ORDER BY EM_ID DESC');
            return view('Admin/ManageEmployee',['Employees'=>$Employees]);
        }else{
            return redirect('Logout')->with('failed',"operation failed");
        }
    }


    //Employee Edit View 
    public function show($id) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $id = test_input($id);
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('AD_ManageEmployees')->with('failed',"operation failed");
            }else {
                $Data = DB::select('SELECT * FROM employees WHERE EM_ID  = ? LIMIT 1',[$id]);
                if($Data == TRUE){
                    return view('Admin/EditEmployee',['Employee'=>$Data]);
                }else{
                    return redirect('AD_ManageEmployees')->with('failed',"operation failed");
                }
            }
        }
        
    }


    //Employee edit action
    public function edit(Request $request,$id) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('AD_ManageEmployees')->with('failed',"operation failed");
            }else {
                $rules = [
                    'FIRST_NAME' => 'required|string|min:3|max:100',
                    'LAST_NAME' => 'required|string|min:3|max:100',
                    'DESIGNAMTION' => 'required|string|min:3|max:100',
                    'SYSTEM_ROLE' => 'required|string|min:3|max:100',
                    'BIRTHDAY' => 'required',
                    'AGE' => 'required|numeric',
                    'CONTACT_NUMBER' => 'required|numeric',
                    'ADDRESS' => 'required|string|min:5|max:225',
                    'PASSWORD' => 'required|string|min:5|max:50'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return redirect('AD_ManageEmployees')->with('failed',"operation failed");
                }else{

                    $PASSWORD = $request->input('PASSWORD');
                    $REPASSWORD = $request->input('RE_PASSWORD');
                    $PASSWORD = test_input($PASSWORD);
                    $REPASSWORD = test_input($REPASSWORD);
                    if($PASSWORD != $REPASSWORD){
                        return redirect('AD_ManageEmployees')->with('failed',"Update failed! Password does not match. Try again!");
                    }else{

                        $SYSTEM_ROLE = $request->input('SYSTEM_ROLE');
                        $FIRST_NAME = $request->input('FIRST_NAME');
                        $LAST_NAME = $request->input('LAST_NAME');
                        $DESIGNAMTION = $request->input('DESIGNAMTION');
                        $AGE = $request->input('AGE');
                        $BIRTHDAY = $request->input('BIRTHDAY');
                        $CONTACT_NUMBER = $request->input('CONTACT_NUMBER');
                        $ADDRESS = $request->input('ADDRESS');
                
                        $SYSTEM_ROLE = test_input($SYSTEM_ROLE);
                        $FIRST_NAME = test_input($FIRST_NAME);
                        $LAST_NAME = test_input($LAST_NAME);
                        $DESIGNAMTION = test_input($DESIGNAMTION);
                        $AGE = test_input($AGE);
                        $BIRTHDAY = test_input($BIRTHDAY);
                        $CONTACT_NUMBER = test_input($CONTACT_NUMBER);
                        $ADDRESS = test_input($ADDRESS);
                        
                        DB::update('UPDATE employees SET 
                            EM_SystemRole = ?, 
                            EM_FirstName=?, 
                            EM_LastName=?,
                            EM_Designation=?,
                            EM_AGE=?,
                            EM_BIRTHDAY=?,
                            EM_ContactNumber=?,
                            EM_Address=?,
                            EM_Password=?,
                            updated_at=? 
                        WHERE EM_ID = ?',[
                            $SYSTEM_ROLE,
                            $FIRST_NAME,
                            $LAST_NAME,
                            $DESIGNAMTION,
                            $AGE,
                            $BIRTHDAY,
                            $CONTACT_NUMBER,
                            $ADDRESS,
                            sha1($PASSWORD),
                            date('Y-m-d'),
                            $id
                        ]);
                        return redirect('AD_ManageEmployees')->with('status',"Employee details have been Updated!");

                    }
                }
            }
        }
    }



    //Employee Delete action
    public function destroy($id) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $id = test_input($id);
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('AD_ManageEmployees')->with('failed',"operation failed");
            }else{
                DB::delete('DELETE FROM employees WHERE EM_ID = ?',[$id]);
                return redirect('AD_ManageEmployees')->with('status',"Employee details has been deleted!");
            }
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
                return redirect('AD_ManageEmployees')->with('failed',"operation failed");
            }else {
    
                if($action == 0){
                    DB::update('UPDATE employees SET EM_STATUS = ? WHERE EM_ID = ?',[$action,$id]);
                    return redirect('AD_ManageEmployees')->with('status',"Employee has been Disabled!"); 
                   
                }else if($action == 1){
                    DB::update('UPDATE employees SET EM_STATUS = ? WHERE EM_ID = ?',[$action,$id]);
                    return redirect('AD_ManageEmployees')->with('status',"Employee has been Activated!"); 
                }else{
                    return redirect('AD_ManageEmployees')->with('failed',"operation failed");
                }
                
            }
        }

    }



}
