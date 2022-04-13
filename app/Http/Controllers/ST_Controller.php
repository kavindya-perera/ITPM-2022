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

class ST_Controller extends Controller
{
    public function manageVideos(){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $videos = DB::select('SELECT * FROM video_lessons WHERE CLASS_ID = ? ORDER BY V_ID DESC',[Session::get('S_CLASS_ROOM_ID')]);
            return view('student/VideoLessons',['videos'=>$videos]);
        } 
    }


    public function play($id){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed"); 
        }else{
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed', "operation failed");
            } else {
                $video = DB::select('SELECT * FROM video_lessons WHERE V_ID = ? AND CLASS_ID = ? LIMIT 1', [$id,Session::get('S_CLASS_ROOM_ID')]);
                if($video == TRUE){
                    return view('student/PlayVideo', ['video'=>$video]);
                }else{
                    return Redirect::back()->with('failed', "operation failed");
                }
                
            }
        }
    }


    public function payments(){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $payments = DB::select('SELECT * FROM student_payments WHERE SP_S_ID = ? ORDER BY SP_ID DESC',[Session::get('S_ID')]);
            return view('student/MyPayments',['payments'=>$payments]);
        } 
    }


    public function dashboard(){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $videos = DB::select('SELECT COUNT(V_ID) AS videoCount FROM video_lessons WHERE CLASS_ID = ?',[Session::get('S_CLASS_ROOM_ID')]);
            $videoLessons = DB::select('SELECT * FROM video_lessons WHERE CLASS_ID = ? ORDER BY V_ID DESC LIMIT 5',[Session::get('S_CLASS_ROOM_ID')]);
            $announcements = DB::select('SELECT * FROM announcements WHERE A_CLASSROOM_ID = ? ORDER BY A_ID DESC LIMIT 5',[Session::get('S_CLASS_ROOM_ID')]);
            $payment = DB::select('SELECT *  FROM student_payments WHERE SP_S_ID = ? AND SP_YEAR =? AND SP_MONTH =? ORDER BY SP_ID DESC',[Session::get('S_ID'),date('Y'),date('m')]);
            $live = DB::select('SELECT * FROM live_classes WHERE LC_CLASS_ID = ? LIMIT 1',[Session::get('S_CLASS_ROOM_ID')]);
            
            return view('student/Dashboard',[
                'videos'=>$videos,
                'live'=>$live,
                'payment'=>$payment,
                'announcements'=>$announcements,
                'videoLessons'=>$videoLessons,
            ]);
        } 
    }


    public function Profile(){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $student = DB::select('SELECT * FROM students,classrooms WHERE students.S_CLASS_ROOM_ID = classrooms.C_ID AND students.S_ID = ? LIMIT 1',[Session::get('S_ID')]);
            return view('student/MyProfile',['student'=>$student]);
        } 
    }

    public function changePassword(Request $request){
        if(islog() != 1){
            return redirect('LogoutST')->with('failed',"operation failed"); 
        }else{
            $rules = [
                'C_PASSWORD' => 'required|string|min:3|max:50',
                'N_PASSWORD' => 'required|string|min:3|max:50',
                'RN_PASSWORD' => 'required|string|min:3|max:50'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{
                
                $C_PASSWORD = $request->input('C_PASSWORD');
                $N_PASSWORD = $request->input('N_PASSWORD');
                $RN_PASSWORD = $request->input('RN_PASSWORD');
                
                $C_PASSWORD = test_input($C_PASSWORD);
                $N_PASSWORD = test_input($N_PASSWORD);
                $RN_PASSWORD = test_input($RN_PASSWORD);

                $student = DB::select('SELECT * FROM students,classrooms WHERE students.S_CLASS_ROOM_ID = classrooms.C_ID AND students.S_ID = ? AND students.S_PASSWORD=? LIMIT 1',[Session::get('S_ID'), sha1($C_PASSWORD)]);
                if($student == FALSE){
                    return Redirect::back()->with('failed',"Current password is invalid!");
                }else{
                    if($N_PASSWORD ==  $RN_PASSWORD){
                        DB::update('UPDATE students SET S_PASSWORD = ? WHERE S_ID = ?',[sha1($N_PASSWORD),Session::get('S_ID')]);
                        echo ("<script>alert('Password has been changed!');</script>");
                        return redirect('StudentLogin')->with('status',"Password has been changed!");
                    }else{
                        return Redirect::back()->with('failed',"Passwords did not match!");
                    }
                   
                }
            }
        } 
    }


}
