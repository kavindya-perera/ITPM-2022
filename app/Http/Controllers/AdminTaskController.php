<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Employee;
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

class AdminTaskController extends Controller
{
        //add task view
        public function addTask(){
            if(islog() == 1){
                $Employees = DB::select('SELECT EM_ID,EM_NUMBER,EM_FirstName,EM_LastName FROM employees WHERE EM_STATUS=1 ORDER BY EM_ID DESC');
                $RandomNumber = "T".rand(10,99).rand(10,99);
                $invalidTaskNumber = DB::select('SELECT * FROM tasks WHERE T_NUMBER =? LIMIT 1',[$RandomNumber]);
                if($invalidTaskNumber == TRUE){
                    return redirect('AD_AddTask');
                }else{
                    return view('Admin/AddTask',['Employees'=>$Employees,'TaskNumber'=>$RandomNumber]);
                }
            }else{
                return redirect('Logout')->with('failed',"operation failed");
            }
    
        }



        // create new task
    public function insert(Request $request){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $rules = [
                'TASK_NUMBER' => 'required|string|min:3|max:50',
                'TASK_NAME' => 'required|string|min:3|max:100',
                'TASK_EMPLOYEE' => 'required|numeric',
                'TASK_DESCRIPTION' => 'string|min:1|max:501',
                'TASK_FROM' => 'required',
                'TASK_TO' => 'required'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return redirect('AD_AddTask')->with('failed',"operation failed");
            }else{
                $data = $request->input();
                $T_NUMBER = test_input($data['TASK_NUMBER']);
                $invalidTask_Number = DB::select('SELECT T_ID FROM tasks WHERE T_NUMBER = ? LIMIT 1',[$T_NUMBER]);
                if($invalidTask_Number == TRUE){
                    return redirect('AD_AddTask')->with('failed',"Invalid Task Number. Try Again");
                }else{

                    
                    if($data['TASK_FROM'] > $data['TASK_TO']){
                        return Redirect::back()->with('failed','The Task time duration is invalid!');
                    }else{

                        try{

                            date_default_timezone_set('Asia/Colombo');
                            $Task = new Tasks;
                            $Task->T_NUMBER = test_input($data['TASK_NUMBER']);
                            $Task->T_CREATED_EMPLOYEE = Session::get('AdminID');
                            $Task->T_ASIGN_ID = test_input($data['TASK_EMPLOYEE']);
                            $Task->T_NAME = test_input($data['TASK_NAME']);
                            $Task->T_DESCRIPTION = test_input($data['TASK_DESCRIPTION']);
                            $Task->T_STATUS = "CREATED";
                            $Task->T_CREATED_DATE = date('Y-m-d');
                            $Task->T_CREATED_TIME = date("h:i:sa");
                            $Task->T_PROCESS_STATUS = 0;
                            $Task->T_COMPLETE_STATUS = 0;
                            $Task->T_TIME_FROM = test_input($data['TASK_FROM']);
                            $Task->T_TIME_TO = test_input($data['TASK_TO']);

                            if($Task->save()){
                                return redirect('AD_AddTask')->with('status',"New Task has been created.");
                            }else{
                                return redirect('AD_AddTask ')->with('failed',"operation failed");
                            }
            
                        }
                        catch(Exception $e){
                            return redirect('AD_AddTask ')->with('failed',"operation failed");
                        }


                    }


                       
                }

            }
        }

    }


    //Manage Tasks
    public function index(){
        if(islog() == 1){
            $Tasks = DB::select('SELECT * FROM tasks,employees WHERE tasks.T_ASIGN_ID = employees.EM_ID  ORDER BY T_ID DESC');
            return view('Admin/ManageTasks',['Tasks'=>$Tasks]);
        }else{
            return redirect('Logout')->with('failed',"operation failed");
        }
    
    }



        //Tasks Edit View 
        public function show($id) {
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $id = test_input($id);
                $validator = Validator::make(['id' => $id], [
                    'id' => 'required|numeric'
                ]);
                if ($validator->fails()) {
                    return redirect('AD_ManageTasks')->with('failed',"operation failed");
                }else {
                    $Data = DB::select('SELECT * FROM tasks WHERE T_ID  = ? LIMIT 1',[$id]);
                    if($Data == TRUE){
                        return view('Admin/EditTask',['Task'=>$Data]);
                    }else{
                        return redirect('AD_ManageTasks')->with('failed',"operation failed");
                    }
                }
            }
            
        }



        
    //task edit action
    public function edit(Request $request,$id) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('AD_ManageTasks')->with('failed',"operation failed");
            }else {
                $rules = [
                    'TASK_NAME' => 'required|string|min:3|max:100',
                    'TASK_DESCRIPTION' => 'string|min:1|max:501',
                    'TASK_FROM' => 'required',
                    'TASK_TO' => 'required'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{


                        $TASK_NAME = $request->input('TASK_NAME');
                        $TASK_DESCRIPTION = $request->input('TASK_DESCRIPTION');
                        $TASK_FROM = $request->input('TASK_FROM');
                        $TASK_TO = $request->input('TASK_TO');
                
                        $TASK_NAME = test_input($TASK_NAME);
                        $TASK_DESCRIPTION = test_input($TASK_DESCRIPTION);
                        $TASK_FROM = test_input($TASK_FROM);
                        $TASK_TO = test_input($TASK_TO);

                        if($TASK_FROM > $TASK_TO){
                            return Redirect::back()->with('failed','The Task time duration is invalid!');
                        }else{

                            DB::update('UPDATE tasks SET 
                                T_NAME = ?, 
                                T_DESCRIPTION=?, 
                                T_TIME_FROM=?,
                                T_TIME_TO=? 
                            WHERE T_ID = ?',[
                                $TASK_NAME,
                                $TASK_DESCRIPTION,
                                $TASK_FROM,
                                $TASK_TO,
                                $id
                            ]);
                            
                            return redirect('AD_ManageTasks')->with('status',"Task details have been Updated!");
                        
                        }
                    
                }
            }
        }
    }


        //task Delete action
        public function destroy($id) {
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $id = test_input($id);
                $validator = Validator::make(['id' => $id], [
                    'id' => 'required|numeric'
                ]);
                if ($validator->fails()) {
                    return redirect('AD_ManageTasks')->with('failed',"operation failed");
                }else{
                    DB::delete('DELETE FROM tasks WHERE T_ID = ?',[$id]);
                    return redirect('AD_ManageTasks')->with('status',"Task details have been deleted!");
                }
            }
        }


        //task View
        public function view($id) { 

            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $id = test_input($id);
                $validator = Validator::make(['id' => $id], [
                    'id' => 'required|numeric'
                ]);
                if ($validator->fails()) {
                    return redirect('AD_ManageTasks')->with('failed',"operation failed");
                }else {
                    $Data1 = DB::select('SELECT * FROM tasks,employees WHERE employees.EM_ID=tasks.T_CREATED_EMPLOYEE AND tasks.T_ID  = ? LIMIT 1',[$id]);
                    $Data2 = DB::select('SELECT employees.EM_NUMBER,employees.EM_FirstName,employees.EM_LastName FROM tasks,employees WHERE employees.EM_ID=tasks.T_ASIGN_ID AND tasks.T_ID  = ? LIMIT 1',[$id]);
                    $Data3 = DB::select('SELECT employees.EM_NUMBER,employees.EM_FirstName,employees.EM_LastName FROM tasks,employees WHERE employees.EM_ID=tasks.CHECKED_BY AND tasks.T_ID  = ? LIMIT 1',[$id]);
                    $Data4 = DB::select('SELECT employees.EM_NUMBER,employees.EM_FirstName,employees.EM_LastName FROM tasks,employees WHERE employees.EM_ID=tasks.CANCEL_BY AND tasks.T_ID  = ? LIMIT 1',[$id]);
                    if($Data1 == TRUE && $Data2 == TRUE){
                        return view('Admin/ViewTask',['Task1'=>$Data1,'Task2'=>$Data2,'Task3'=>$Data3,'Task4'=>$Data4]);
                    }else{
                        return redirect('AD_ManageTasks')->with('failed',"operation failed");
                    }
                }
            }

        }



        //task check
        public function check($id) { 
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $validator = Validator::make(['id' => $id], [
                    'id' => 'required|numeric'
                ]);
                if ($validator->fails()) {
                    return redirect('AD_ManageTasks')->with('failed',"operation failed");
                }else{  
                    date_default_timezone_set('Asia/Colombo');
                    DB::update('UPDATE tasks SET 
                        CHECK_STATUS=?,
                        CHECKED_BY = ?,
                        CHECK_DATE = ?,
                        CHECK_TIME =?
                    WHERE T_ID = ?',[
                        1,
                        Session::get('AdminID'),
                        date('Y-m-d'),
                        date("h:i:sa"),
                        $id
                    ]);
                    return Redirect::back()->with('status','Operation Successful !');

                }
            }
        }


        //task uncheck
        public function uncheck($id) { 
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $validator = Validator::make(['id' => $id], [
                    'id' => 'required|numeric'
                ]);
                if ($validator->fails()) {
                    return redirect('AD_ManageTasks')->with('failed',"operation failed");
                }else{  
                            
                    DB::update('UPDATE tasks SET 
                        CHECK_STATUS=?,
                        CHECKED_BY = ?,
                        CHECK_DATE = ?,
                        CHECK_TIME =?
                    WHERE T_ID = ?',[
                        0,
                        NULL,
                        NULL,
                        NULL,
                        $id
                    ]);
                    return Redirect::back()->with('status','Operation Successful !');
        
                }
            }
        }




               


            //Manage Tasks
    public function myTask(){
        if(islog() == 1){
            $Tasks = DB::select('SELECT * FROM tasks,employees WHERE tasks.T_ASIGN_ID = ? AND tasks.T_CREATED_EMPLOYEE=employees.EM_ID ORDER BY T_ID DESC',[(int)Session::get('AdminID')]);
            return view('Admin/MyManageTasks',['Tasks'=>$Tasks]);
        }else{
            return redirect('Logout')->with('failed',"operation failed");
        }
    
    }




    
        //task View
        public function MyTaskView($id) { 

            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $id = test_input($id);
                $validator = Validator::make(['id' => $id], [
                    'id' => 'required|numeric'
                ]);
                if ($validator->fails()) {
                    return redirect('AD_MyManageTasks')->with('failed',"operation failed");
                }else {
                    $Data1 = DB::select('SELECT * FROM tasks,employees WHERE employees.EM_ID=tasks.T_CREATED_EMPLOYEE AND tasks.T_ID  = ? AND tasks.T_ASIGN_ID  = ? LIMIT 1',[$id,(int)Session::get('AdminID')]);
                    $Data2 = DB::select('SELECT employees.EM_NUMBER,employees.EM_FirstName,employees.EM_LastName FROM tasks,employees WHERE employees.EM_ID=tasks.T_ASIGN_ID AND tasks.T_ID  = ? AND tasks.T_ASIGN_ID  = ? LIMIT 1',[$id,(int)Session::get('AdminID')]);
                    $Data3 = DB::select('SELECT employees.EM_NUMBER,employees.EM_FirstName,employees.EM_LastName FROM tasks,employees WHERE employees.EM_ID=tasks.CHECKED_BY AND tasks.T_ID  = ? AND tasks.T_ASIGN_ID  = ? LIMIT 1',[$id,(int)Session::get('AdminID')]);
                    $Data4 = DB::select('SELECT employees.EM_NUMBER,employees.EM_FirstName,employees.EM_LastName FROM tasks,employees WHERE employees.EM_ID=tasks.CANCEL_BY AND tasks.T_ID  = ? AND tasks.T_ASIGN_ID  = ? LIMIT 1',[$id,(int)Session::get('AdminID')]);
                    if($Data1 == TRUE && $Data2 == TRUE){
                        return view('Admin/ViewMyTask',['Task1'=>$Data1,'Task2'=>$Data2,'Task3'=>$Data3,'Task4'=>$Data4]);
                    }else{
                        return redirect('AD_MyManageTasks')->with('failed',"operation failed");
                    }
                }
            }

        }



                //task View
                public function cancel($id) { 

                    if(islog() != 1){
                        return redirect('Logout')->with('failed',"operation failed");
                    }else{
                        $id = test_input($id);
                        $validator = Validator::make(['id' => $id], [
                            'id' => 'required|numeric'
                        ]);
                        if ($validator->fails()) {
                            return redirect('AD_MyManageTasks')->with('failed',"operation failed");
                        }else {

                            date_default_timezone_set('Asia/Colombo');  
                            DB::update('UPDATE tasks SET 
                                T_STATUS=?,
                                CANCEL_DATE=?,
                                CANCEL_TIME = ?,
                                CANCEL_BY = ?
                            WHERE T_ID = ?',[
                                "CANCEL",
                                date('Y-m-d'),
                                date("h:i:sa"),
                                Session::get('AdminID'),
                                $id
                            ]);
                            return Redirect::back()->with('status','Operation Successful !');

                        }
                    }
        
                }



                                //task View
                                public function process($id) { 

                                    if(islog() != 1){
                                        return redirect('Logout')->with('failed',"operation failed");
                                    }else{
                                        $id = test_input($id);
                                        $validator = Validator::make(['id' => $id], [
                                            'id' => 'required|numeric'
                                        ]);
                                        if ($validator->fails()) {
                                            return redirect('AD_MyManageTasks')->with('failed',"operation failed");
                                        }else {
                
                                            date_default_timezone_set('Asia/Colombo');  
                                            DB::update('UPDATE tasks SET 
                                                T_PROCESS_STATUS=?,
                                                T_PROCESS_DATE=?,
                                                T_PROCESS_TIME = ?
                                            WHERE T_ID = ?',[
                                                1,
                                                date('Y-m-d'),
                                                date("h:i:sa"),
                                                $id
                                            ]);
                                            return Redirect::back()->with('status','Operation Successful !');
                
                                        }
                                    }
                        
                                }



                                
                //task View
                public function complete($id) { 

                    if(islog() != 1){
                        return redirect('Logout')->with('failed',"operation failed");
                    }else{
                        $id = test_input($id);
                        $validator = Validator::make(['id' => $id], [
                            'id' => 'required|numeric'
                        ]);
                        if ($validator->fails()) {
                            return redirect('AD_MyManageTasks')->with('failed',"operation failed");
                        }else {

                            date_default_timezone_set('Asia/Colombo');  
                            DB::update('UPDATE tasks SET 
                                T_STATUS=?,
                                T_COMPLETE_STATUS=?,
                                T_COMPLETE_DATE = ?,
                                T_COMPLETE_TIME = ?
                            WHERE T_ID = ?',[
                                "COMPLETED",
                                1,
                                date('Y-m-d'),
                                date("h:i:sa"),
                                $id
                            ]);
                            return Redirect::back()->with('status','Operation Successful !');

                        }
                    }
        
                }



                    //task edit action
    public function ReOpen1(Request $request,$id) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('AD_ManageTasks')->with('failed',"operation failed");
            }else {
                $rules = [
                    'TASK_FROM' => 'required',
                    'TASK_TO' => 'required'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return redirect('AD_ManageTasks')->with('failed',"operation failed");
                }else{

                        $TASK_FROM = $request->input('TASK_FROM');
                        $TASK_TO = $request->input('TASK_TO');

                        if($TASK_FROM > $TASK_TO){
                            return Redirect::back()->with('failed','Re-Open task time duration is invalid!');
                        }else{

                            $TASK_FROM = test_input($TASK_FROM);
                            $TASK_TO = test_input($TASK_TO);
                            
                            DB::update('UPDATE tasks SET 
                                T_STATUS=?,
                                T_CREATED_DATE = ?,
                                T_CREATED_TIME = ?,
                                T_PROCESS_STATUS =?,
                                T_PROCESS_DATE = ?,
                                T_PROCESS_TIME = ?,
                                T_COMPLETE_STATUS = ?,
                                T_COMPLETE_DATE = ?,
                                T_COMPLETE_TIME = ?,
                                CHECK_STATUS = ?,
                                CHECKED_BY = ?,
                                CHECK_DATE = ?,
                                CHECK_TIME = ?,
                                CANCEL_DATE = ?,
                                CANCEL_TIME = ?,
                                CANCEL_BY = ?
                            WHERE T_ID = ?',[
                                "CREATED",
                                $TASK_FROM,
                                $TASK_TO,
                                0,
                                NULL,
                                NULL,
                                0,
                                NULL,
                                NULL,
                                0,
                                NULL,
                                NULL,
                                NULL,
                                NULL,
                                NULL,
                                NULL,
                                $id
                            ]);
                            return Redirect::back()->with('status','The task was successfully re-opened.');

                        }
                

                    
                }
            }
        }
    }





}
