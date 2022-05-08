<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\VideoLesson;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use \Exception;

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

class System_Assign extends Controller
{
    public function addPage(){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $systems = DB::select('SELECT * FROM systems');
            return view('Admin/SystemAssign',['systems'=>$systems]);
        } 
    }



    public function Assign(Request $request){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $rules = [
                'Employee_ID' => 'required|string|min:3|max:50',
                'systems' => 'required'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{

                $data = $request->input();
                $EM_ID = test_input($data['Employee_ID']);
                $employee = DB::select('SELECT * FROM employees WHERE EM_NUMBER=?',[$EM_ID]);
                
                if($employee == FALSE){
                    return Redirect::back()->with('failed',"Invalid Employee Number");
                }else{
                    $EM_ID = test_input($data['Employee_ID']);
                    $systems = $data['systems'];
                    $N = count($systems);

                    for($i=0; $i < $N; $i++){
                        $invalid = DB::select('SELECT ES_ID FROM employee_system WHERE ES_SYSTEM=? AND ES_EMPLOYEE=?',[$EM_ID,$systems[$i]]);
                        if($invalid == FALSE){
                            DB::insert('INSERT INTO employee_system(ES_SYSTEM, ES_EMPLOYEE) values (?, ?)',[$systems[$i],$EM_ID]);
                        }
                    }
                    return Redirect::back()->with('status',"Process has been successful!");
                 
                }

            }
        } 
    }



    public function ManageSystems(){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $Employee = DB::select('SELECT * FROM employees ORDER BY EM_ID DESC');
            return view('Admin/ManageSystems',['Employee'=>$Employee]);
        } 
    }

    
    public function EditSystems($id){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else {
                $emSystem = array();
                $Employee = DB::select('SELECT * FROM employees WHERE EM_ID = ? LIMIT 1',[$id]);
                $EmployeeSystems = DB::select('SELECT ES_SYSTEM FROM employee_system WHERE ES_EMPLOYEE = ?',[$Employee[0]->EM_NUMBER]);
                foreach($EmployeeSystems AS $EmployeeSystem){
                    array_push($emSystem,$EmployeeSystem->ES_SYSTEM);
                }
                $systems = DB::select('SELECT * FROM systems');
                return view('Admin/EditSystems', ['Employee'=>$Employee,'systems'=>$systems,'emSystem'=>$emSystem]);
            }
        } 
    }



    public function AssignEdit(Request $request){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $rules = [
                'Employee_ID' => 'required|string|min:3|max:50'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{

                $data = $request->input();
                $EM_ID = test_input($data['Employee_ID']);
                $employee = DB::select('SELECT * FROM employees WHERE EM_NUMBER=?',[$EM_ID]);
                
                if($employee == FALSE){
                    return Redirect::back()->with('failed',"Invalid Employee Number");
                }else{
                    $EM_ID = test_input($data['Employee_ID']);
                    DB::delete('DELETE FROM employee_system WHERE ES_EMPLOYEE = ?',[$EM_ID]);
                    if(isset($data['systems'])){
                        $systems = $data['systems'];
                        $N = count($systems);
    
                        for($i=0; $i < $N; $i++){
                            $invalid = DB::select('SELECT ES_ID FROM employee_system WHERE ES_SYSTEM=? AND ES_EMPLOYEE=?',[$EM_ID,$systems[$i]]);
                            if($invalid == FALSE){
                                DB::insert('INSERT INTO employee_system(ES_SYSTEM, ES_EMPLOYEE) values (?, ?)',[$systems[$i],$EM_ID]);
                            }
                        }
                        return Redirect::back()->with('status',"Process has been successful!");
                    }
                    return Redirect::back()->with('status',"Process has been successful!");
                 
                }

            }
        } 
    }



}
