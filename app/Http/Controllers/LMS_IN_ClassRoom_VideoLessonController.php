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

class LMS_IN_ClassRoom_VideoLessonController extends Controller
{

    
    public function AddLesson($class){
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
                return view('Admin/LMS_InClassRoom/class_EmbedVideo',['classroom'=>$classroom]);
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
                    'V_SUBJECT' => 'required|string|min:3|max:100',
                    'V_CHAPTER' => 'required|string|min:3|max:100',
                    'V_NAME' => 'required|string|min:3|max:200',
                    'V_CODE' => 'required|string|min:3|max:10000',
                    'V_DESCRIPTION' => 'required|string|min:3|max:200'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{
    
                    $data = $request->input();
                    try{
                        $VideoLesson = new VideoLesson;
                        $VideoLesson->CLASS_ID = test_input($class);
                        $VideoLesson->V_SUBJECT = test_input($data['V_SUBJECT']);
                        $VideoLesson->V_CHAPTER = test_input($data['V_CHAPTER']);
                        $VideoLesson->V_NAME = test_input($data['V_NAME']);
                        $VideoLesson->V_CODE = $data['V_CODE'];
                        $VideoLesson->V_DESCRIPTION = test_input($data['V_DESCRIPTION']);
                        $VideoLesson->V_EMBED_BY = Session::get('AdminID');
                        if($VideoLesson->save()){
                            return Redirect::back()->with('status',"New Video Lesson has been embedded.");
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




    public function manageVideos($class){
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
                $videos = DB::select('SELECT * FROM video_lessons WHERE CLASS_ID = ?',[$class]);
                return view('Admin/LMS_InClassRoom/class_ManageVideo',['videos'=>$videos,'classroom'=>$classroom]);
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
                $video = DB::select('SELECT * FROM video_lessons WHERE V_ID = ? AND CLASS_ID = ? LIMIT 1',[$id,$class]);
                return view('Admin/LMS_InClassRoom/class_EditVideo',['video'=>$video,'classroom'=>$classroom]);
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
                    'V_SUBJECT' => 'required|string|min:3|max:100',
                    'V_CHAPTER' => 'required|string|min:3|max:100',
                    'V_NAME' => 'required|string|min:3|max:200',
                    'V_CODE' => 'required|string|min:3|max:10000',
                    'V_DESCRIPTION' => 'required|string|min:3|max:200'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                    $V_SUBJECT = $request->input(test_input('V_SUBJECT'));
                    $V_CHAPTER = $request->input(test_input('V_CHAPTER'));
                    $V_NAME = $request->input(test_input('V_NAME'));
                    $V_DESCRIPTION = $request->input(test_input('V_DESCRIPTION'));
                    $V_CODE = $request->input('V_CODE');
                        
                    DB::update('UPDATE video_lessons SET 
                        V_SUBJECT = ?, 
                        V_CHAPTER=?,
                        V_NAME=?,
                        V_DESCRIPTION=?,
                        V_CODE=?
                    WHERE V_ID = ?',[
                        $V_SUBJECT,
                        $V_CHAPTER,
                        $V_NAME,
                        $V_DESCRIPTION,
                        $V_CODE,
                        $id
                    ]);
                    return redirect('class_manageVideos/'.$class)->with('status',"Video lesson have been Updated!");
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
                DB::delete('DELETE FROM  video_lessons WHERE V_ID = ? AND CLASS_ID = ?',[$id,$class]);
                return Redirect::back()->with('status',"Video lesson have been deleted!");
            }  
        }
    }


    public function play($id,$class){
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
                $video = DB::select('SELECT * FROM video_lessons,employees WHERE employees.EM_ID = video_lessons.V_EMBED_BY AND video_lessons.V_ID = ? AND video_lessons.CLASS_ID = ? LIMIT 1',[$id,$class]);
                return view('Admin/LMS_InClassRoom/class_PlayVideo',['video'=>$video,'classroom'=>$classroom]);
            }  
        }
    }


}
