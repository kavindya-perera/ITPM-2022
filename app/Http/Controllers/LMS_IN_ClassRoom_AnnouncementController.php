<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Announcement;
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
    

class LMS_IN_ClassRoom_AnnouncementController extends Controller
{
    

    public function AddAnnouncement($class){
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
                return view('Admin/LMS_InClassRoom/class_AddAnnouncement',['classroom'=>$classroom]);
            }  
        }
    }



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
                    'A_TITLE' => 'required|string|min:3|max:100',
                    'A_CONTENT' => 'required|string|min:3|max:500'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{
    
                    $data = $request->input();
                    try{
                        $Announcement = new Announcement;
                        $Announcement->A_CLASSROOM_ID = test_input($class);
                        $Announcement->A_TITLE = test_input($data['A_TITLE']);
                        $Announcement->A_CONTENT = test_input($data['A_CONTENT']);
                        $Announcement->A_CREATE_BY = Session::get('AdminID');
                        $Announcement->A_CREATE_DATE = date('Y-m-d');
                        if($Announcement->save()){
                            return Redirect::back()->with('status',"Announcement has been Sent.");
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


    // class_ManageAnnouncement
    public function manageAnnouncements ($class){
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
                $announcements = DB::select('SELECT * FROM announcements WHERE A_CLASSROOM_ID = ?',[$class]);
                return view('Admin/LMS_InClassRoom/class_ManageAnnouncement',['announcements'=>$announcements,'classroom'=>$classroom]);
            }  
        }
    }



    public function show($id,$class){
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
                $classroom = DB::select('SELECT * FROM classrooms WHERE C_ID = ? LIMIT 1',[$class]);
                $announcement = DB::select('SELECT * FROM announcements WHERE A_ID = ? AND A_CLASSROOM_ID = ? LIMIT 1',[$id,$class]);
                return view('Admin/LMS_InClassRoom/class_EditAnnouncement',['announcement'=>$announcement,'classroom'=>$classroom]);
            }  
        }
    }




    public function edit(Request $request,$id,$class) {
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

                $rules = [
                    'A_TITLE' => 'required|string|min:3|max:100',
                    'A_CONTENT' => 'required|string|min:3|max:500'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                    $A_TITLE = $request->input(test_input('A_TITLE'));
                    $A_CONTENT = $request->input(test_input('A_CONTENT'));
                        
                    DB::update('UPDATE announcements SET 
                        A_TITLE = ?, 
                        A_CONTENT=?
                    WHERE A_ID = ?',[
                        $A_TITLE,
                        $A_CONTENT,
                        $id
                    ]);
                    return redirect('class_manageAnnouncements/'.$class)->with('status',"Announcement have been Updated!");
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
                DB::delete('DELETE FROM  announcements WHERE A_ID = ? AND A_CLASSROOM_ID = ?',[$id,$class]);
                return Redirect::back()->with('status',"Video lesson have been deleted!");
            }  
        }
    }


    


}
