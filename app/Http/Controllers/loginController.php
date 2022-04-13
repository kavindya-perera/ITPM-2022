<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Session;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

class loginController extends Controller
{
    public function check(Request $request){
        $rules = [
			'email' => 'required|email',
			'password' => 'required|string|min:3'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('login')->with('failed',"login operation failed");
		}else{

            $data = $request->input();
            $email = test_input($data['email']);
            $password = test_input($data['password']); 
            $h_upass = sha1($password);

            $users = DB::select('SELECT * FROM employees WHERE EM_Email=? AND EM_Password=? AND EM_STATUS = 1 LIMIT 1',[$email,$h_upass]);

            if($users == TRUE){
                foreach ($users as $user){ 
                    Session::put('AdminSystemRole', $user->EM_SystemRole);
                    Session::put('AdminID', $user->EM_ID);
                    Session::put('AdminEmNumber', $user->EM_NUMBER);
                    Session::put('AdminFirstName', $user->EM_FirstName);
                    Session::put('AdminLastName', $user->EM_LastName);
                    Session::put('AdminDesignation',$user->EM_Designation);
                    Session::put('AdminContactNumber',$user->EM_ContactNumber);
                    Session::put('AdminAddress',$user->EM_Address);
                    Session::put('image',$user->EM_IMAGE);
                    Session::save();

                    $empSystems = array();
                    $EmployeeSystems = DB::select('SELECT ES_SYSTEM FROM employee_system WHERE ES_EMPLOYEE = ?',[Session::get('AdminEmNumber')]);
                    foreach($EmployeeSystems AS $EmployeeSystem){
                        array_push($empSystems,$EmployeeSystem->ES_SYSTEM);
                    }
                    Session::put('empSys',$empSystems);
                    Session::save();
                    return redirect('AD_MyManageTasks')->with('status',"You was successfuly login as a Administrator!");
                }
            }else{
                return redirect('login')->with('failed',"login operation failed!");
            }

        }
    }

    public function DoLogout(){ 

        Session::flush();
        return redirect('login')->with('status',"You was successfuly logout!");
    }



    public function STcheck(Request $request){
        $rules = [
			'email' => 'required|string|min:3',
			'password' => 'required|string|min:3'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('StudentLogin')->with('failed',"login operation failed");
		}else{

            $data = $request->input();
            $email = test_input($data['email']);
            $password = test_input($data['password']); 
            $h_upass = sha1($password);

            $users = DB::select('SELECT * FROM students WHERE S_USERNAME=? AND S_PASSWORD=? AND S_STATUS = 1 LIMIT 1',[$email,$h_upass]);

            if($users == TRUE){
                foreach ($users as $user){ 
                    Session::put('S_ID', $user->S_ID);
                    Session::put('S_NUMBER', $user->S_NUMBER); 
                    Session::put('S_FIRST_NAME', $user->S_FIRST_NAME);
                    Session::put('S_LAST_NAME', $user->S_LAST_NAME);
                    Session::put('S_FULL_NAME', $user->S_FULL_NAME);
                    Session::put('S_NIC', $user->S_NIC);
                    Session::put('S_AGE',$user->S_AGE);
                    Session::put('S_BIRTHDAY',$user->S_BIRTHDAY);
                    Session::put('S_CONTACT_NUMBER_1',$user->S_CONTACT_NUMBER_1);
                    Session::put('S_CONTACT_NUMBER_2',$user->S_CONTACT_NUMBER_2);
                    Session::put('S_WHATSAPP_NUMBER',$user->S_WHATSAPP_NUMBER);
                    Session::put('S_EMAIL',$user->S_EMAIL);
                    Session::put('S_ADDRESS',$user->S_ADDRESS);
                    Session::put('S_CLASS_ROOM_ID',$user->S_CLASS_ROOM_ID);
                    Session::put('imageST',"1644748371.jpg");
                    Session::save();
                    return redirect('ST_Dashboard')->with('status',"You was successfuly login as a Student!");
                }
            }else{
                return redirect('StudentLogin')->with('failed',"Invalid Username or Password!");
            }

        }
    }




    public function logout(Request $request){

    
         $request->session()->invalidate();
    
         $request->session()->regenerateToken();
    
         return redirect('/login')->with('failed',"logOut");
    }

    public function LogoutST(Request $request){

    
        $request->session()->invalidate();
   
        $request->session()->regenerateToken();
   
        return redirect('/StudentLogin');
   }



}
