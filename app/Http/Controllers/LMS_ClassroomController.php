<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Classroom;
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

class LMS_ClassroomController extends Controller
{
    // create new classroom
    public function insert(Request $request){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $rules = [
                'CLASSROOM_NAME' => 'required|string|min:3|max:100',
                'CLASSROOM_DESCRIPTION' => 'required|string|min:3|max:500'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{

                $data = $request->input();
                try{
                    $classroom = new Classroom;
                    $classroom->C_NAME = test_input($data['CLASSROOM_NAME']);
                    $classroom->C_DESCRIPTION = test_input($data['CLASSROOM_DESCRIPTION']);
                    if($classroom->save()){
                        return redirect('AD_AddClassRoom')->with('status',"New Classroom has been created.");
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


    //Manage classroom
    public function index(){
        if(islog() == 1){
            $Classrooms = DB::select('SELECT * FROM classrooms ORDER BY C_ID DESC');
            return view('Admin/ManageClassrooms',['Classrooms'=>$Classrooms]);
        }else{
            return redirect('Logout')->with('failed',"operation failed");
        }
    }

        //Manage classroom
        public function classManager(){
            if(islog() == 1){
                $Classrooms = DB::select('SELECT * FROM classrooms ORDER BY C_ID DESC');
                return view('Admin/ClassRooms',['Classrooms'=>$Classrooms]);
            }else{
                return redirect('Logout')->with('failed',"operation failed");
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
                    $Data = DB::select('SELECT * FROM classrooms WHERE C_ID  = ? LIMIT 1',[$id]);
                    if($Data == TRUE){
                        return view('Admin/EditClassRoom',['Classroom'=>$Data]);
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
                    'CLASSROOM_NAME' => 'required|string|min:3|max:100',
                    'CLASSROOM_DESCRIPTION' => 'required|string|min:3|max:100'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                    $CLASSROOM_NAME = $request->input('CLASSROOM_NAME');
                    $CLASSROOM_DESCRIPTION = $request->input('CLASSROOM_DESCRIPTION');
                
                    $CLASSROOM_NAME = test_input($CLASSROOM_NAME);
                    $CLASSROOM_DESCRIPTION = test_input($CLASSROOM_DESCRIPTION);
                        
                    DB::update('UPDATE classrooms SET 
                        C_NAME = ?, 
                        C_DESCRIPTION=? 
                    WHERE C_ID = ?',[
                        $CLASSROOM_NAME,
                        $CLASSROOM_DESCRIPTION,
                        $id
                    ]);
                    return redirect('AD_ManageClassRoom')->with('status',"Classroom details have been Updated!");
                }
            }
        }
    }




            //classroom Delete action
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
                        DB::delete('DELETE FROM classrooms WHERE C_ID = ?',[$id]);
                        return Redirect::back()->with('status',"Task details have been deleted!");
                    }
                }
            }



}
