<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\LiveClass;
use App\Models\Announcement;
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
    

class LMS_IN_ClassRoom_LiveClass extends Controller
{

    public function insert(Request $request,$class){
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

                $rules = [
                    'L_TITLE' => 'required|string|min:3|max:50',
                    'L_LINK' => 'required|string|min:3|max:500'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{
    
                    $data = $request->input();
                    try{
                        $LiveClass = new LiveClass;
                        $LiveClass->LC_CLASS_ID = test_input($class);
                        $LiveClass->LC_LESSON = test_input($data['L_TITLE']);
                        $LiveClass->LC_LINK = test_input($data['L_LINK']);
                        if($LiveClass->save()){
                            return Redirect::back()->with('status',"Live lecture has been Sent.");
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
    }



    
    public function destroy($id,$class){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed"); 
        }else{
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            $validator2 = Validator::make(['class' => $class], [
                'class' => 'required|numeric'
            ]);
            if ($validator->fails() || $validator2->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else if(0 == validClass($class)){
                return Redirect::back()->with('failed',"operation failed");
            }else{
                DB::delete('DELETE FROM  live_classes WHERE LC_ID = ? AND LC_CLASS_ID = ?',[$id,$class]);
                return Redirect::back()->with('status',"Live Lecture has been end!");
            }  
        }
    }



}
