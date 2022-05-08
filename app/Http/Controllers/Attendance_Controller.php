<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPayment;
use App\Models\OtherPayments;
use App\Models\Attendance;
use App\Models\Expenses;
use App\Models\Student;
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

class Attendance_Controller extends Controller
{

    protected $payment;
    protected $paymentOther;
    public function __construct(){
        $this->payment = new StudentPayment();
        $this->paymentOther = new OtherPayments();
    }

    public function index(Request $request){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $rules = [
                'STUDENT_NUMBER' => 'required|string|min:3|max:100' 
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{
                $data = $request->input();
                $S_ID = test_input($data['STUDENT_NUMBER']);
                $checkStudentID = $this->payment->CheckCorrectStudentID($S_ID);

                $InvoiceNumber = rand(10,99).rand(10,99).rand(10,99).rand(10,99);
                $invalidInvoiceNumber= DB::select('SELECT * FROM student_payments WHERE SP_INVOICE_NO =? LIMIT 1',[$InvoiceNumber]);

                if($invalidInvoiceNumber == TRUE){
                    return Redirect::back()->with('failed',"Somthing went wrong. Please Try Again!");
                }else{
                    if($checkStudentID == TRUE){
                        return Redirect::back()->with('failed',"operationss failed");
                    }else{
                        $details = DB::select('SELECT * FROM student_payments,students,classrooms WHERE classrooms.C_ID=students.S_CLASS_ROOM_ID AND student_payments.SP_S_ID=students.S_ID AND students.S_NUMBER=? ORDER BY SP_ID DESC',[$S_ID]);
                        if($details == TRUE){
                            return view('Attendance/AttendancePage',['details'=>$details,'InvoiceNumber'=>$InvoiceNumber,]);
                        }else{
                            $details = DB::select('SELECT * FROM students,classrooms WHERE classrooms.C_ID=students.S_CLASS_ROOM_ID  AND students.S_NUMBER=? ORDER BY students.S_ID DESC',[$S_ID]);
                            return view('Attendance/AttendancePage',['details'=>$details,'InvoiceNumber'=>$InvoiceNumber,]);
                        }
                        
                    }
                }

       
            }
        }
    }








                    //GetPaymentPortal
                public function PlacePayment(Request $request){
                    if(islog() != 1){
                        return redirect('Logout')->with('failed',"operation failed");
                    }else{
                        
                        $rules = [
                            'P_INVOICE' => 'required|numeric',
                            'S_ID' => 'required|numeric',
                            'P_YEAR' => 'required|numeric|digits:4',
                            'P_MONTH' => 'required|numeric|digits:2',
                            'P_DATE' => 'required|numeric|digits:2',
                            'P_FOR' => 'required|string|min:3|max:100',
                            'P_AMOUNT' => 'required|numeric'
                        ];
                        $validator = Validator::make($request->all(),$rules);
                        if ($validator->fails()) {
                            return Redirect::back()->with('failed',"operation failed");
                        }else{
                            
                            $data = $request->input();
                            $S_ID = test_input($data['S_ID']);
                            $checkStudentID = $this->payment->CheckCorrectStudentID($S_ID);
                            
                            if($checkStudentID == FALSE){
                                return Redirect::back()->with('failed',"Invalid Student ID. Try Again!");
                            }else{

                                if(isset($data['PayOnly'])){
                                    try{
                                        $StudentPayment = new StudentPayment;
                                        $StudentPayment->SP_S_ID = test_input($data['S_ID']);
                                        $StudentPayment->SP_INVOICE_NO = test_input($data['P_INVOICE']);
                                        $StudentPayment->SP_YEAR = test_input($data['P_YEAR']);
                                        $StudentPayment->SP_MONTH = test_input($data['P_MONTH']);
                                        $StudentPayment->SP_DATE = test_input($data['P_DATE']);
                                        $StudentPayment->SP_FOR = test_input($data['P_FOR']);
                                        $StudentPayment->SP_AMOUNT = test_input($data['P_AMOUNT']);
                                        $StudentPayment->SP_REMARK = test_input($data['P_REMARK']);
                                        $StudentPayment->EM_NUMBER = Session::get('AdminEmNumber');
                                        if($StudentPayment->save()){
                                            return redirect('AttendanceSelector')->with('status',"Student Payment has been successfully placed.");
                                        }else{
                                            return Redirect::back()->with('failed',"operation failed");
                                        }
                                
                                    }
                                    catch(Exception $e){
                                        return Redirect::back()->with('failed',"operation failed");
                                    }
                                }

                                if(isset($data['PayAttend'])){
                                    try{
                                        $StudentPayment = new StudentPayment;
                                        $StudentPayment->SP_S_ID = test_input($data['S_ID']);
                                        $StudentPayment->SP_INVOICE_NO = test_input($data['P_INVOICE']);
                                        $StudentPayment->SP_YEAR = test_input($data['P_YEAR']);
                                        $StudentPayment->SP_MONTH = test_input($data['P_MONTH']);
                                        $StudentPayment->SP_DATE = test_input($data['P_DATE']);
                                        $StudentPayment->SP_FOR = test_input($data['P_FOR']);
                                        $StudentPayment->SP_AMOUNT = test_input($data['P_AMOUNT']);
                                        $StudentPayment->SP_REMARK = test_input($data['P_REMARK']);
                                        $StudentPayment->EM_NUMBER = Session::get('AdminEmNumber');
                                        if($StudentPayment->save()){
                                            try{
                                                date_default_timezone_set('Asia/Colombo');
                                                $Attendance = new Attendance;
                                                $Attendance->A_S_ID = test_input($data['S_ID']);
                                                $Attendance->A_DATE = date('Y-m-d');
                                                $Attendance->A_TIME = date('h:i:sa');
                                                $Attendance->A_EM_NO = Session::get('AdminEmNumber');
                                                if($Attendance->save()){
                                                    return redirect('AttendanceSelector')->with('status',"Student Payment has been successfully placed and Student Attened.");
                                                }else{
                                                    return Redirect::back()->with('failed',"operation failed");
                                                }
                                        
                                            }
                                            catch(Exception $e){
                                                return Redirect::back()->with('failed',"operation failed");
                                            }
                                            
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
                }






        
                public function MarkAttend($id){
                    if(islog() != 1){
                        return redirect('Logout')->with('failed',"operation failed");
                    }else{
                        $validator = Validator::make(['id' => $id], [
                            'id' => 'required|numeric'
                        ]);
                        if ($validator->fails()) {
                            return Redirect::back()->with('failed',"operation failed");
                        }else{ 

                            $S_ID = test_input($id);
                            $checkStudentID = $this->payment->CheckCorrectStudentID($S_ID);
                            
                            if($checkStudentID == FALSE){
                                return Redirect::back()->with('failed',"Invalid Student ID. Try Again!");
                            }else{

                              
                                    try{
                                        date_default_timezone_set('Asia/Colombo');
                                        $Attendance = new Attendance;
                                        $Attendance->A_S_ID = $S_ID;
                                        $Attendance->A_DATE = date('Y-m-d');
                                        $Attendance->A_TIME = date('h:i:sa');
                                        $Attendance->A_EM_NO = Session::get('AdminEmNumber');
                                        if($Attendance->save()){
                                            return redirect('AttendanceSelector')->with('status',"Student Attended.");
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






                    
    public function manage (Request $request){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed"); 
        }else{
                $rules = [
                    'Date_From' => 'required|string',
                    'Date_To' => 'required|string'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{
                    $data = $request->input();

                    $Date_From = date_create($data['Date_From']);
                    $Date_To = date_create($data['Date_To']);

                    if($Date_From > $Date_To){
                        return Redirect::back()->with('failed',"Invalid Date Range");
                    }else{

                        $s_year = date_format($Date_From,"Y");
                        $s_month = date_format($Date_From,"m");
                        $s_date = date_format($Date_From,"d");

                        $t_year = date_format($Date_To,"Y");
                        $t_month = date_format($Date_To,"m");
                        $t_date = date_format($Date_To,"d");

                        $Attendance = DB::select('SELECT * FROM attendances,students
                                                    WHERE 
                                                        attendances.A_S_ID = students.S_ID AND 
                                                        attendances.A_DATE BETWEEN ? AND ?
                                                        ORDER BY attendances.A_DATE DESC'
                                                    ,[$Date_From,$Date_To]);

                        return view('Attendance/ManageAttendance',['Attendance'=>$Attendance]);
                    }
                }

  
        }
    }



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
                DB::delete('DELETE FROM attendances WHERE A_ID = ?',[$id]);
                return Redirect::back()->with('status',"Item has been deleted!");
            }
        }
    }



}
