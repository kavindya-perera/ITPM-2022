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

class Finance_Controller extends Controller
{


        protected $payment;
        protected $paymentOther;
        public function __construct(){
            $this->payment = new StudentPayment();
            $this->paymentOther = new OtherPayments(); 
        }

   



        //GetPaymentPortal
        public function GetPaymentPortal(Request $request){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                
                $rules = [
                    'STUDENT_NUMBER' => 'required|string|min:3|max:10'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{
                    
                    $data = $request->input();
                    $StudentNumber = test_input($data['STUDENT_NUMBER']);
                    $StudentDetails = DB::select('SELECT * FROM students s,classrooms c WHERE s.S_CLASS_ROOM_ID = c.C_ID AND s.S_NUMBER =? LIMIT 1',[$StudentNumber]);

                    if($StudentDetails != NULL){

                        $StudentID = $StudentDetails[0]->S_ID;
                        $PaymentDetails = DB::select('SELECT * FROM student_payments WHERE SP_S_ID =? ',[$StudentID]);
    
                        $InvoiceNumber = rand(10,99).rand(10,99).rand(10,99).rand(10,99);
                        $invalidInvoiceNumber= DB::select('SELECT * FROM student_payments WHERE SP_INVOICE_NO =? LIMIT 1',[$InvoiceNumber]);
    
                        if($invalidInvoiceNumber == TRUE){
                            return Redirect::back()->with('failed',"Somthing went wrong. Please Try Again!");
                        }else{
                           
                            return view('Finance/StudentPayment_PaymentPortal',[
                                'Student'=>$StudentDetails,
                                'InvoiceNumber'=>$InvoiceNumber,
                                'PaymentDetails'=>$PaymentDetails
                            ]);
                            
                        }

                    }else{
                        return Redirect::back()->with('failed',"Invalid Student Number");
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

                                try{
                                    $StudentPayment = new StudentPayment;
                                    $StudentPayment->SP_S_ID = test_input($data['S_ID']);
                                    $StudentPayment->SP_INVOICE_NO = test_input($data['P_INVOICE']);
                                    $StudentPayment->SP_DATE = test_input($data['P_YEAR']."-".$data['P_MONTH']."-".$data['P_DATE']);
                                    $StudentPayment->SP_FOR = test_input($data['P_FOR']);
                                    $StudentPayment->SP_AMOUNT = test_input($data['P_AMOUNT']);
                                    $StudentPayment->SP_REMARK = test_input($data['P_REMARK']);
                                    $StudentPayment->EM_NUMBER = Session::get('AdminEmNumber');
                                    if($StudentPayment->save()){
                                        return redirect('Get_Student_Payment')->with('status',"Student Payment has been successfully placed.");
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


 

                public function Invoice_Download($invoiceNumber) {
                    $Data = DB::select('SELECT * FROM students s, student_payments sp WHERE s.S_ID = sp.SP_S_ID AND sp.SP_INVOICE_NO = ?  LIMIT 1',[$invoiceNumber]);
                    return view('Download/DownloadInvoice',['PaymentDetails'=>$Data]);
            
                }


        //Manage payments
        public function index(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $Payments = DB::select('SELECT * FROM student_payments,students WHERE student_payments.SP_S_ID=students.S_ID  ORDER BY student_payments.SP_ID DESC LIMIT 50');
                return view('Finance/StudentPayment_ManageStudentPayments',['Payments'=>$Payments]);
            }
        }



                //payment Delete action
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
                            DB::delete('DELETE FROM student_payments WHERE SP_ID = ?',[$id]);
                            return Redirect::back()->with('status',"Payment Details have been deleted!");
                        }
                    }
                }



 
            //payment Edit View 
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
                        $Data = DB::select('SELECT * FROM student_payments WHERE SP_ID  = ? LIMIT 1',[$id]);
                        if($Data == TRUE){
                            return view('Finance/StudentPayment_StudentPayment_EditForm',['payment'=>$Data]);
                        }else{
                            return Redirect::back()->with('failed',"operation failed");
                        }
                    }
                }
                
            }





                //paymments edit action
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
                    'P_YEAR' => 'required|numeric|digits:4',
                    'P_MONTH' => 'required|numeric',
                    'P_DATE' => 'required|numeric',
                    'P_FOR' => 'required|string|min:3|max:100',
                    'P_AMOUNT' => 'required|numeric'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                        $P_YEAR = $request->input('P_YEAR');
                        $P_MONTH = $request->input('P_MONTH');
                        $P_DATE = $request->input('P_DATE');
                        $P_FOR = $request->input('P_FOR');
                        $P_AMOUNT = $request->input('P_AMOUNT');
                        $P_REMARK = $request->input('P_REMARK');
                
                        $P_YEAR = test_input($P_YEAR);
                        $P_MONTH = test_input($P_MONTH);
                        $P_DATE = test_input($P_DATE);
                        $P_FOR = test_input($P_FOR);
                        $P_AMOUNT = test_input($P_AMOUNT);
                        $P_REMARK = test_input($P_REMARK);

                   

                            DB::update('UPDATE student_payments SET 
                                SP_DATE=? ,
                                SP_FOR=? ,
                                SP_AMOUNT=? ,
                                SP_REMARK=? 
                            WHERE SP_ID = ?',[
                                $P_YEAR."-".$P_MONTH."-".$P_DATE,
                                $P_FOR,
                                $P_AMOUNT,
                                $P_REMARK,
                                $id
                            ]);
                            
                            return redirect('Manage_Student_Payments')->with('status',"Payment details have been Updated!");
                 
                    
                }
            }
        }
    }




            //Manage payments
            public function index_filter(Request $request,$filter){
                if(islog() != 1){
                    return redirect('Logout')->with('failed',"operation failed");
                }else{
                    if($filter == 'StudentBy'){
                        $rules = [
                            'STUDENT_NUMBER' => 'required|string|min:3|max:10'
                        ];
                        $validator = Validator::make($request->all(),$rules);
                        if ($validator->fails()) {
                            return Redirect::back()->with('failed',"operation failed");
                        }else{
                            $data = $request->input();
                            $StudentNumber = test_input($data['STUDENT_NUMBER']);
                            $student = DB::select('SELECT S_ID FROM students  WHERE  S_NUMBER =? LIMIT 1',[$StudentNumber]);
                            
                            if($student == NULL){
                                return Redirect::back()->with('failed',"operation failed");
                            }else{
                                $S_ID = $student[0]->S_ID;
                                $Payments = DB::select('SELECT * FROM student_payments,students WHERE student_payments.SP_S_ID=students.S_ID AND student_payments.SP_S_ID = ?',[$S_ID]);
                                return view('Finance/StudentPayment_ManageStudentPayments',['Payments'=>$Payments]);
                            }
                        }
                    }


                        if($filter == 'DateBy'){
                            $rules = [
                                'Date_Since' => 'required|string',
                                'Date_To' => 'required|string'
                            ];
                            $validator = Validator::make($request->all(),$rules);
                            if ($validator->fails()) {
                                return Redirect::back()->with('failed',"operation failed");
                            }else{
                                $data = $request->input();

                                $Date_Since = date_create($data['Date_Since']);
                                $Date_To = date_create($data['Date_To']);

                                if($Date_Since > $Date_To){
                                    return redirect('Manage_Student_Payments')->with('failed',"Invalid Date Range");
                                }else{

                                    
                                    $Payments = DB::select('SELECT * FROM student_payments,students
                                                                WHERE 
                                                                    student_payments.SP_S_ID=students.S_ID AND 
                                                                    (student_payments.SP_DATE BETWEEN ? AND ?)
                                                                    ORDER BY student_payments.SP_DATE DESC'
                                                            ,[$Date_Since,$Date_To]);
                                    if($Payments == TRUE){
                                        return view('Finance/StudentPayment_ManageStudentPayments',['Payments'=>$Payments]);
                                    }else{
                                        return redirect('Manage_Student_Payments')->with('failed',"No data!");
                                    }

                                }  
                            }
                        }

        
                    
                }
            }



                    //Manage payments
        public function index_filter_today(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                date_default_timezone_set('Asia/Colombo');
                $Payments = DB::select('SELECT * FROM student_payments,students WHERE student_payments.SP_S_ID=students.S_ID AND student_payments.SP_DATE=?  ORDER BY student_payments.SP_ID DESC',[date('Y-m-d')]);
                return view('Finance/StudentPayment_ManageStudentPayments',['Payments'=>$Payments]);
            }
        }





        
        //GetPaymentPortal
        public function other_income_form(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
              
                $InvoiceNumber = rand(10,99).rand(10,99).rand(10,99).rand(10,99);
                $invalidInvoiceNumber= DB::select('SELECT * FROM other_payments WHERE OP_INVOICE_NO =? LIMIT 1',[$InvoiceNumber]);
    
                if($invalidInvoiceNumber == TRUE){
                    return redirect('Get_Other_Income');
                }else{
                           
                    return view('Finance/OtherPayments_GetIncomeForm',['InvoiceNumber'=>$InvoiceNumber]);
                            
                }

                

            }
        }




                //GetPaymentPortal
                public function PlaceOtherIncome(Request $request){
                    if(islog() != 1){
                        return redirect('Logout')->with('failed',"operation failed");
                    }else{
                        
                        $rules = [
                            'O_INVOICE' => 'required|numeric',
                            'O_YEAR' => 'required|numeric|digits:4',
                            'O_MONTH' => 'required|numeric|digits:2',
                            'O_DATE' => 'required|numeric|digits:2',
                            'O_FOR' => 'required|string|min:3|max:150',
                            'O_AMOUNT' => 'required|numeric',
                            'O_CUSTOMER_NAME' => 'required|string|min:3|max:150',
                            'O_CUSTOMER_CONTACT' => 'required|numeric|digits:10',
                            'O_CUSTOMER_ADDRESS' => 'required|string|min:3|max:255',

                        ];
                        $validator = Validator::make($request->all(),$rules);
                        if ($validator->fails()) {
                            return Redirect::back()->with('failed',"operation failed");
                        }else{
                            
                            $data = $request->input();
                            try{
                                $OtherPayment = new OtherPayments;
                                $OtherPayment->OP_CUSTOMER_NAME = test_input($data['O_CUSTOMER_NAME']);
                                $OtherPayment->OP_CUSTOMER_ADDRESS = test_input($data['O_CUSTOMER_ADDRESS']);
                                $OtherPayment->OP_CUSTOMER_CONTACT = test_input($data['O_CUSTOMER_CONTACT']);
                                $OtherPayment->OP_INVOICE_NO = test_input($data['O_INVOICE']);
                                $OtherPayment->OP_DATE = test_input($data['O_YEAR']."-".$data['O_MONTH']."-".$data['O_DATE']);
                                $OtherPayment->OP_FOR = test_input($data['O_FOR']);
                                $OtherPayment->OP_AMOUNT = test_input($data['O_AMOUNT']);
                                $OtherPayment->OP_REMARK = test_input($data['O_REMARK']);
                                $OtherPayment->EM_NUMBER = Session::get('AdminEmNumber');
                                if($OtherPayment->save()){
                                    return Redirect::back()->with('status',"Payment has been successfully placed.");
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



        //Manage payments
        public function indexOther(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $Payments = DB::select('SELECT * FROM other_payments ORDER BY OP_ID DESC LIMIT 50');
                return view('Finance/OtherPayments_Manage',['Payments'=>$Payments]);
            }
        }

         //Manage payments
        public function indexOther_filter_today(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                date_default_timezone_set('Asia/Colombo');
                $Payments = DB::select('SELECT * FROM other_payments WHERE  OP_DATE=?  ORDER BY OP_ID DESC',[date('Y-m-d')]);
                return view('Finance/OtherPayments_Manage',['Payments'=>$Payments]);
            }
        }




                    //Manage payments
            public function indexOther_filter(Request $request,$filter){
                if(islog() != 1){
                    return redirect('Logout')->with('failed',"operation failed");
                }else{

                        if($filter == 'DateBy'){
                            $rules = [
                                'Date_Since' => 'required|string',
                                'Date_To' => 'required|string'
                            ];
                            $validator = Validator::make($request->all(),$rules);
                            if ($validator->fails()) {
                                return Redirect::back()->with('failed',"operation failed");
                            }else{
                                $data = $request->input();

                                $Date_Since = date_create($data['Date_Since']);
                                $Date_To = date_create($data['Date_To']);

                                if($Date_Since > $Date_To){
                                    return Redirect::back()->with('failed',"Invalid Date Range");
                                }else{
                                    
                                    $Payments = DB::select('SELECT * FROM other_payments
                                                                WHERE 
                                                                    (OP_DATE BETWEEN ? AND ?)
                                                                    ORDER BY OP_ID DESC'
                                                            ,[$Date_Since,$Date_To]);
                                    if($Payments == TRUE){
                                        return view('Finance/OtherPayments_Manage',['Payments'=>$Payments]);
                                    }else{
                                        return redirect('Manage_Other_Incomes')->with('failed',"No data!");
                                    }

                                }  
                            }
                        }
                    
                }
            }





                        //payment Edit View 
            public function showOther($id) {
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
                        $Data = DB::select('SELECT * FROM other_payments WHERE OP_ID  = ? LIMIT 1',[$id]);
                        if($Data == TRUE){
                            return view('Finance/OtherPayment_EditForm',['payment'=>$Data]);
                        }else{
                            return Redirect::back()->with('failed',"operation failed");
                        }
                    }
                }
                
            }




            
                //paymments edit action
    public function editOther(Request $request,$id) {
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
                    'O_YEAR' => 'required|numeric|digits:4',
                    'O_MONTH' => 'required|numeric',
                    'O_DATE' => 'required|numeric',
                    'O_FOR' => 'required|string|min:3|max:150',
                    'O_AMOUNT' => 'required|numeric',
                    'O_CUSTOMER_NAME' => 'required|string|min:3|max:150',
                    'O_CUSTOMER_CONTACT' => 'required|numeric|digits:10',
                    'O_CUSTOMER_ADDRESS' => 'required|string|min:3|max:255',
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                        $O_CUSTOMER_NAME = $request->input('O_CUSTOMER_NAME');
                        $O_CUSTOMER_CONTACT = $request->input('O_CUSTOMER_CONTACT');
                        $O_CUSTOMER_ADDRESS = $request->input('O_CUSTOMER_ADDRESS');
                        $O_YEAR = $request->input('O_YEAR');
                        $O_MONTH = $request->input('O_MONTH');
                        $O_DATE = $request->input('O_DATE');
                        $O_FOR = $request->input('O_FOR');
                        $O_AMOUNT = $request->input('O_AMOUNT');
                        $O_REMARK = $request->input('O_REMARK');
                
                        $O_CUSTOMER_NAME = test_input($O_CUSTOMER_NAME);
                        $O_CUSTOMER_CONTACT = test_input($O_CUSTOMER_CONTACT);
                        $O_CUSTOMER_ADDRESS = test_input($O_CUSTOMER_ADDRESS);
                        $O_YEAR = test_input($O_YEAR);
                        $O_MONTH = test_input($O_MONTH);
                        $O_DATE = test_input($O_DATE);
                        $O_FOR = test_input($O_FOR);
                        $O_AMOUNT = test_input($O_AMOUNT);
                        $O_REMARK = test_input($O_REMARK);

                   

                            DB::update('UPDATE other_payments SET 
                                OP_CUSTOMER_NAME=?,
                                OP_CUSTOMER_ADDRESS=?,
                                OP_CUSTOMER_CONTACT=?,
                                OP_DATE=? ,
                                OP_FOR=? ,
                                OP_AMOUNT=? ,
                                OP_REMARK=? 
                            WHERE OP_ID = ?',[
                                $O_CUSTOMER_NAME,
                                $O_CUSTOMER_ADDRESS,
                                $O_CUSTOMER_CONTACT,
                                $O_YEAR."-".$O_MONTH."-".$O_DATE,
                                $O_FOR,
                                $O_AMOUNT,
                                $O_REMARK,
                                $id
                            ]);
                            
                            return redirect('Manage_Other_Incomes')->with('status',"Payment details have been Updated!");
                 
                    
                }
            }
        }
    }




                    //payment Delete action
                public function destroyOther($id) {
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
                            DB::delete('DELETE FROM other_payments WHERE OP_ID = ?',[$id]);
                            return Redirect::back()->with('status',"Payment Details have been deleted!");
                        }
                    }
                }



                
                public function Invoice_Other_Download($invoiceNumber) {
                    $Data = DB::select('SELECT * FROM other_payments WHERE  OP_INVOICE_NO = ?  LIMIT 1',[$invoiceNumber]);
                    return view('Download/DownloadOtherInvoice',['PaymentDetails'=>$Data]);
            
                }










                //GetPaymentPortal
                public function insertExpenses(Request $request){
                    if(islog() != 1){
                        return redirect('Logout')->with('failed',"operation failed");
                    }else{
                        
                        $rules = [
                            'E_YEAR' => 'required|numeric|digits:4',
                            'E_MONTH' => 'required|numeric|digits:2',
                            'E_DATE' => 'required|numeric|digits:2',
                            'E_AMOUNT' => 'required|numeric',
                            'E_FOR' => 'required|string|min:3|max:255',
                            'E_DESCRIPTION' => 'required|string|min:3|max:255'
                        ];
                        $validator = Validator::make($request->all(),$rules);
                        if ($validator->fails()) {
                            return Redirect::back()->with('failed',"operation failed");
                        }else{
                            
                            $data = $request->input();

                                try{
                                    $Expenses = new Expenses;
                                    $Expenses->E_DATE = test_input($data['E_YEAR']."-".$data['E_MONTH']."-".$data['E_DATE']);
                                    $Expenses->E_FOR = test_input($data['E_FOR']);
                                    $Expenses->E_AMOUNT	= test_input($data['E_AMOUNT']);
                                    $Expenses->E_DESCRIPTION	 = test_input($data['E_DESCRIPTION']);
                                    $Expenses->E_EMP_NUMBER = Session::get('AdminEmNumber');
                                    if($Expenses->save()){
                                        return redirect('Add_Expenses')->with('status',"Expenses has been successfully placed.");
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



                        //Manage payments
        public function indexExpenses(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $Expenses = DB::select('SELECT * FROM expenses  ORDER BY E_ID DESC LIMIT 50');
                return view('Finance/Manage_Expenses',['Expenses'=>$Expenses]);
            }
        }

         //Manage payments
        public function indexExpenses_filter_today(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                date_default_timezone_set('Asia/Colombo');
                $Expenses = DB::select('SELECT * FROM expenses WHERE E_DATE=?  ORDER BY E_ID DESC',[date('Y-m-d')]);
                return view('Finance/Manage_Expenses',['Expenses'=>$Expenses]);
            }
        }


                           //Manage payments
            public function indexExpenses_filter(Request $request,$filter){
                if(islog() != 1){
                    return redirect('Logout')->with('failed',"operation failed");
                }else{

                        if($filter == 'DateBy'){
                            $rules = [
                                'Date_Since' => 'required|string',
                                'Date_To' => 'required|string'
                            ];
                            $validator = Validator::make($request->all(),$rules);
                            if ($validator->fails()) {
                                return Redirect::back()->with('failed',"operation failed");
                            }else{
                                $data = $request->input();

                                $Date_Since = date_create($data['Date_Since']);
                                $Date_To = date_create($data['Date_To']);

                                if($Date_Since > $Date_To){
                                    return Redirect::back()->with('failed',"Invalid Date Range");
                                }else{

                
                                    $Expenses = DB::select('SELECT * FROM expenses
                                                                WHERE 
                                                                    (E_DATE BETWEEN ? AND ?)
                                                                    ORDER BY E_ID DESC'
                                                            ,[$Date_Since,$Date_To]);
                                    if($Expenses == TRUE){
                                        return view('Finance/Manage_Expenses',['Expenses'=>$Expenses]);
                                    }else{
                                        return redirect('Manage_Expenses')->with('failed',"No data!");
                                    }

                                }  
                            }
                        }
                    
                }
            }




            public function showExpensesEditView($id) {
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
                        $Data = DB::select('SELECT * FROM expenses WHERE E_ID  = ? LIMIT 1',[$id]);
                        if($Data == TRUE){
                            return view('Finance/Edit_Expenses',['expenses'=>$Data]);
                        }else{
                            return Redirect::back()->with('failed',"operation failed");
                        }
                    }
                }
                
            }





    public function updateExpenses(Request $request,$id) {
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
                    'E_YEAR' => 'required|numeric',
                    'E_MONTH' => 'required|numeric',
                    'E_DATE' => 'required|numeric',
                    'E_AMOUNT' => 'required|numeric',
                    'E_FOR' => 'required|string|min:3|max:255',
                    'E_DESCRIPTION' => 'required|string|min:3|max:255'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                        $E_YEAR = $request->input('E_YEAR');
                        $E_MONTH = $request->input('E_MONTH');
                        $E_DATE = $request->input('E_DATE');
                        $E_AMOUNT = $request->input('E_AMOUNT');
                        $E_FOR = $request->input('E_FOR');
                        $E_DESCRIPTION = $request->input('E_DESCRIPTION');
                
                        $E_YEAR = test_input($E_YEAR);
                        $E_MONTH = test_input($E_MONTH);
                        $E_DATE = test_input($E_DATE);
                        $E_AMOUNT = test_input($E_AMOUNT);
                        $E_FOR = test_input($E_FOR);
                        $E_DESCRIPTION = test_input($E_DESCRIPTION);

                            DB::update('UPDATE expenses SET 
                                E_DATE=?,
                                E_AMOUNT=?, 
                                E_FOR=?,
                                E_DESCRIPTION=? 
                            WHERE E_ID = ?',[
                                $E_YEAR."-".$E_MONTH."-".$E_DATE,
                                $E_AMOUNT,
                                $E_FOR,
                                $E_DESCRIPTION,
                                $id
                            ]);
                            
                            return redirect('Manage_Expenses')->with('status',"Expenses details have been Updated!");
                 
                    
                }
            }
        }
    }



    public function destroyExpenses($id) {
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
                DB::delete('DELETE FROM expenses WHERE E_ID = ?',[$id]);
                return Redirect::back()->with('status',"Expenses Details have been deleted!");
            }
        }
    }


    public function reports(Request $request,$type) {
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $type = test_input($type);
            $validator = Validator::make(['type' => $type], [
                'type' => 'required'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{

                $FROM = $request->input('FROM_DATE');
                $TO = $request->input('TO_DATE');
                $FROM = test_input($FROM);
                $TO = test_input($TO);


                if($type == 'StudentPaymentReport'){
                    $Datas = DB::select('SELECT * FROM student_payments WHERE SP_DATE BETWEEN ? AND ?',[$FROM,$TO]);

                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="Student Payment Report ('.$FROM.' - '.$TO.').xls"');
                    header('Cache-Control: max-age=0');
                    header('Cache-Control: max-age=1');
                    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header ('Pragma: public'); // HTTP/1.0

                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th colspan='6'>Student Payment Report (".$FROM." - ".$TO.")</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th>Date</th>";
                    echo "<th>Enterd By</th>";
                    echo "<th>Inoice No</th>";
                    echo "<th>Description</th>";
                    echo "<th>Amount (LKR)</th>";
                    echo "</tr>";

                    $count = 1;
                    $total = 0;
                    foreach($Datas as $data){
                        echo "<tr>";
                        echo "<td>".$count."</td>";
                        echo "<td>".$data->SP_DATE."</td>";
                        echo "<td>".$data->EM_NUMBER."</td>";
                        echo "<td>".$data->SP_INVOICE_NO."</td>";
                        echo "<td>".$data->SP_FOR."</td>";
                        echo "<td>".number_format($data->SP_AMOUNT,2)."</td>";
                        echo "</tr>";
                        $count++;
                        $total = $total + $data->SP_AMOUNT;
                    }

                    echo "<tr>";
                    echo "<th colspan='5' style='text-align:right'>Total Amount</th>";
                    echo "<th style='text-align:right'>".number_format($total,2)."</th>";
                    echo "</tr>";
                    echo "</table>";
                   
                }


                if($type == 'OtherIncomeReport'){
                    $Datas = DB::select('SELECT * FROM other_payments WHERE OP_DATE BETWEEN ? AND ?',[$FROM,$TO]);

                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="Other Payment Report ('.$FROM.' - '.$TO.').xls"');
                    header('Cache-Control: max-age=0');
                    header('Cache-Control: max-age=1');
                    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header ('Pragma: public'); // HTTP/1.0

                    echo "<table border='1'>";

                    echo "<tr>";
                    echo "<th colspan='8'>Other Payment Report (".$FROM." - ".$TO.")</th>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th rowspan='2'>#</th>";
                    echo "<th rowspan='2'>Date</th>";
                    echo "<th rowspan='2'>Enterd By</th>";
                    echo "<th colspan='3'>Customer Details</th>";
                    echo "<th rowspan='2'>Inoice No</th>";
                    echo "<th rowspan='2'>Amount (LKR)</th>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Contact</th>";
                    echo "<th>Address</th>";
                    echo "</tr>";

                    $count = 1;
                    $total = 0;
                    foreach($Datas as $data){
                        echo "<tr>";
                        echo "<td>".$count."</td>";
                        echo "<td>".$data->OP_DATE."</td>";
                        echo "<td>".$data->EM_NUMBER."</td>";
                        echo "<td>".$data->OP_CUSTOMER_NAME."</td>";
                        echo "<td>".$data->OP_CUSTOMER_CONTACT."</td>";
                        echo "<td>".$data->OP_CUSTOMER_ADDRESS."</td>";
                        echo "<td>".$data->OP_INVOICE_NO."</td>";
                        echo "<td>".number_format($data->OP_AMOUNT,2)."</td>";
                        echo "</tr>";
                        $count++;
                        $total = $total + $data->OP_AMOUNT;
                    }

                    echo "<tr>";
                    echo "<th colspan='7' style='text-align:right'>Total Amount</th>";
                    echo "<th style='text-align:right'>".number_format($total,2)."</th>";
                    echo "</tr>";
                    echo "</table>";
                   
                }


                if($type == 'ExpensesReport'){
                    $Datas = DB::select('SELECT * FROM expenses WHERE E_DATE BETWEEN ? AND ?',[$FROM,$TO]);

                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="Expenses Report ('.$FROM.' - '.$TO.').xls"');
                    header('Cache-Control: max-age=0');
                    header('Cache-Control: max-age=1');
                    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header ('Pragma: public'); // HTTP/1.0

                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th colspan='5'>Expenses Report (".$FROM." - ".$TO.")</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th>Date</th>";
                    echo "<th>Enterd By</th>";
                    echo "<th>Description</th>";
                    echo "<th>Amount (LKR)</th>";
                    echo "</tr>";

                    $count = 1;
                    $total = 0;
                    foreach($Datas as $data){
                        echo "<tr>";
                        echo "<td>".$count."</td>";
                        echo "<td>".$data->E_DATE."</td>";
                        echo "<td>".$data->E_EMP_NUMBER."</td>";
                        echo "<td>".$data->E_DESCRIPTION."</td>";
                        echo "<td>".number_format($data->E_AMOUNT,2)."</td>";
                        echo "</tr>";
                        $count++;
                        $total = $total + $data->E_AMOUNT;
                    }

                    echo "<tr>";
                    echo "<th colspan='4' style='text-align:right'>Total Amount</th>";
                    echo "<th style='text-align:right'>".number_format($total,2)."</th>";
                    echo "</tr>";
                    echo "</table>";
                   
                }



            }
        }
    }
            


}
