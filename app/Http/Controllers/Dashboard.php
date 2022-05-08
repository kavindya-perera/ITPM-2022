<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPayment;
use App\Models\OtherPayments;
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

class Dashboard extends Controller 
{
    protected $payment;
    public function __construct(){
        $this->payment = new StudentPayment();
    }

    public function index(){
        if(islog() == 1){
            date_default_timezone_set('Asia/Colombo');
            $student = DB::select('SELECT COUNT(S_ID) AS studentCount FROM students');
            $Disablestudent = DB::select('SELECT COUNT(S_ID) AS studentCount FROM students WHERE S_STATUS=?',[0]);
            $Video = DB::select('SELECT COUNT(V_ID) AS videoCount FROM video_lessons');
            $TodayAttendance = DB::select('SELECT COUNT(A_ID) AS attendanceCount FROM attendances WHERE A_DATE = ?',[date('Y-m-d')]);
            $Employee = DB::select('SELECT COUNT(EM_ID) AS employeecount FROM employees');

            $TodayPayment1 = DB::select('SELECT SUM(SP_AMOUNT) AS todaypayment FROM student_payments WHERE SP_DATE=?',[date('Y-m-d')]);
            $TodayPayment2 = DB::select('SELECT SUM(OP_AMOUNT) AS todaypayment FROM other_payments WHERE OP_DATE=?',[date('Y-m-d')]);
            $TodayExpenses = DB::select('SELECT SUM(E_AMOUNT) AS todayexpenses FROM expenses WHERE E_DATE=?',[date('Y-m-d')]);

            $MonthPayment1 = DB::select('SELECT SUM(SP_AMOUNT) AS monthpayment FROM student_payments WHERE SP_DATE BETWEEN ? AND ?',[date('Y-m')."-1",date('Y-m')."-31"]);
            $MonthPayment2 = DB::select('SELECT SUM(OP_AMOUNT) AS monthpayment FROM other_payments WHERE OP_DATE BETWEEN ? AND ?',[date('Y-m')."-1",date('Y-m')."-31"]);
            $MonthExpenses = DB::select('SELECT SUM(E_AMOUNT) AS monthexpenses FROM expenses WHERE E_DATE BETWEEN ? AND ?',[date('Y-m')."-1",date('Y-m')."-31"]);

            $month = date('m');
            if($month == 1){
                $pre1 = 12;
                $pre2 = 11;
            }elseif($month == 2){
                $pre1 = 11;
                $pre2 = 10;
            }else{
                $pre1 = $month-1;
                $pre2 = $month-2;
            }
        
            $PreMonthPayment1 = DB::select('SELECT SUM(SP_AMOUNT) AS monthpayment FROM student_payments WHERE SP_DATE BETWEEN ? AND ?',[(date('Y')."-".(date('m')-1)."-1"), (date('Y')."-".(date('m')-1)."-31")]);
            $PreMonthPayment2 = DB::select('SELECT SUM(OP_AMOUNT) AS monthpayment FROM other_payments WHERE OP_DATE BETWEEN ? AND ?',[(date('Y')."-".(date('m')-1)."-1"), (date('Y')."-".(date('m')-1)."-31")]);
            $PreMonthExpenses = DB::select('SELECT SUM(E_AMOUNT) AS monthexpenses FROM expenses WHERE E_DATE BETWEEN ? AND ?',[(date('Y')."-".(date('m')-1)."-1"), (date('Y')."-".(date('m')-1)."-31")]);

            $Pre1MonthPayment1 = DB::select('SELECT SUM(SP_AMOUNT) AS monthpayment FROM student_payments WHERE SP_DATE BETWEEN ? AND ?',[(date('Y')."-".$pre1."-1"),(date('Y')."-".$pre1."-31")]);
            $Pre1MonthPayment2 = DB::select('SELECT SUM(OP_AMOUNT) AS monthpayment FROM other_payments WHERE OP_DATE BETWEEN ? AND ?',[(date('Y')."-".$pre1."-1"),(date('Y')."-".$pre1."-31")]);
            $Pre1MonthExpenses = DB::select('SELECT SUM(E_AMOUNT) AS monthexpenses FROM expenses WHERE E_DATE BETWEEN ? AND ?',[(date('Y')."-".$pre1."-1"),(date('Y')."-".$pre1."-31")]);

            $Pre2MonthPayment1 = DB::select('SELECT SUM(SP_AMOUNT) AS monthpayment FROM student_payments WHERE SP_DATE BETWEEN ? AND ?',[(date('Y')."-".$pre2."-1"),(date('Y')."-".$pre2."-31")]);
            $Pre2MonthPayment2 = DB::select('SELECT SUM(OP_AMOUNT) AS monthpayment FROM other_payments WHERE OP_DATE BETWEEN ? AND ?',[(date('Y')."-".$pre2."-1"),(date('Y')."-".$pre2."-31")]);
            $Pre2MonthExpenses = DB::select('SELECT SUM(E_AMOUNT) AS monthexpenses FROM expenses WHERE E_DATE BETWEEN ? AND ?',[(date('Y')."-".$pre2."-1"),(date('Y')."-".$pre2."-31")]);

            $stok = DB::select('SELECT stock_manages.SM_ITEM_QTY,stocks.ITEM_CODE,stocks.ITEM_NAME FROM stocks,stock_manages WHERE stocks.ITEM_ID = stock_manages.SM_ITEM_ID ORDER BY stock_manages.SM_ITEM_QTY ASC LIMIT 5');

            $STYearPayment = DB::select('SELECT SUM(SP_AMOUNT) AS yearpayment FROM student_payments WHERE SP_DATE BETWEEN ? AND ?',[(date('Y')."-1-1"), (date('Y')."-12-31")]);
            $OtherYearPayment = DB::select('SELECT SUM(OP_AMOUNT) AS yearpayment FROM other_payments WHERE OP_DATE BETWEEN ? AND ?',[(date('Y')."-1-1"), (date('Y')."-12-31")]);
            $YearExpenses = DB::select('SELECT SUM(E_AMOUNT) AS yearexpenses FROM expenses WHERE E_DATE BETWEEN ? AND ?',[(date('Y')."-1-1"), (date('Y')."-12-31")]);
      
            return view('/Admin/dashboard',[
                'student'=>$student,
                'Disablestudent'=>$Disablestudent,
                'Video'=>$Video,
                'TodayAttendance'=>$TodayAttendance,
                'TodayPayment1'=>$TodayPayment1,
                'TodayPayment2'=>$TodayPayment2,
                'TodayExpenses'=>$TodayExpenses,
                'MonthPayment1'=>$MonthPayment1,
                'MonthPayment2'=>$MonthPayment2,
                'MonthExpenses'=>$MonthExpenses,
                'Employee'=>$Employee,
        
                'Pre1MonthPayment1'=>$Pre1MonthPayment1,
                'Pre1MonthPayment2'=>$Pre1MonthPayment2,
                'Pre1MonthExpenses'=>$Pre1MonthExpenses,

                'Pre2MonthPayment1'=>$Pre2MonthPayment1,
                'Pre2MonthPayment2'=>$Pre2MonthPayment2,
                'Pre2MonthExpenses'=>$Pre2MonthExpenses,

                'stok'=>$stok,


                'STYearPayment'=>$STYearPayment,
                'OtherYearPayment'=>$OtherYearPayment,
                'YearExpenses'=>$YearExpenses
            ]);
        }else{
            return redirect('Logout')->with('failed',"operation failed");
        }
    }


}
