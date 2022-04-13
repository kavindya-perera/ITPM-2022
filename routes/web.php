<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('loginShow');
}); 



// administrator routes

//dashboard
Route::get('/AD_Dashboard','App\Http\Controllers\Dashboard@index');

    //employees management
    Route::get('/AD_AddEmployee','App\Http\Controllers\AdminEmployeeController@addEmployee');
    Route::post('/CreateEmloyee','App\Http\Controllers\AdminEmployeeController@insert');
    Route::get('/AD_ManageEmployees','App\Http\Controllers\AdminEmployeeController@index');
    Route::get('/AD_DeleteEmployees/{id}','App\Http\Controllers\AdminEmployeeController@destroy');
    Route::get('/AD_EditEmployees/{id}','App\Http\Controllers\AdminEmployeeController@show');
    Route::post('/EmployeeEdit/{id}','App\Http\Controllers\AdminEmployeeController@edit');
    Route::get('/AD_StatusEmployees/{id}/{action}','App\Http\Controllers\AdminEmployeeController@status'); 

    //task management
    Route::get('/AD_AddTask','App\Http\Controllers\AdminTaskController@addTask');
    Route::post('/CreateTask','App\Http\Controllers\AdminTaskController@insert');
    Route::get('/AD_ManageTasks','App\Http\Controllers\AdminTaskController@index');
    Route::get('/AD_DeleteTask/{id}','App\Http\Controllers\AdminTaskController@destroy');
    Route::get('/AD_EditTask/{id}','App\Http\Controllers\AdminTaskController@show');
    Route::post('/TaskEdit/{id}','App\Http\Controllers\AdminTaskController@edit');
    Route::get('/AD_ViewTask/{id}','App\Http\Controllers\AdminTaskController@view');
    Route::get('/AD_CheckTask/{id}','App\Http\Controllers\AdminTaskController@check');
    Route::get('/AD_UncheckTask/{id}','App\Http\Controllers\AdminTaskController@uncheck');
    Route::get('/AD_MyManageTasks','App\Http\Controllers\AdminTaskController@myTask');
    Route::get('/AD_MyViewTask/{id}','App\Http\Controllers\AdminTaskController@MyTaskView');
    Route::get('/AD_CancelkTask/{id}','App\Http\Controllers\AdminTaskController@cancel');
    Route::get('/AD_ProcessTask/{id}','App\Http\Controllers\AdminTaskController@process');
    Route::get('/AD_CompleteTask/{id}','App\Http\Controllers\AdminTaskController@complete');
    Route::post('/AD_ReOpenTasks/{id}','App\Http\Controllers\AdminTaskController@ReOpen1');

    //Learning management

    //class room
    Route::get('/AD_AddClassRoom', function () {
        return view('/Admin/AddClassRoom');
    });
    Route::post('/CreateClassRoom','App\Http\Controllers\LMS_ClassroomController@insert');
    Route::get('/AD_ManageClassRoom','App\Http\Controllers\LMS_ClassroomController@index');
    Route::get('/AD_EditClassRoom/{id}','App\Http\Controllers\LMS_ClassroomController@show');
    Route::post('/ClassroomEdit/{id}','App\Http\Controllers\LMS_ClassroomController@edit');
    Route::get('/AD_DeleteClassRoom/{id}','App\Http\Controllers\LMS_ClassroomController@destroy');

    //students
    Route::get('/AD_AddStudent','App\Http\Controllers\LMS_StudentController@addStudent');
    Route::post('/CreateStudent','App\Http\Controllers\LMS_StudentController@insert');
    Route::get('/AD_ManageStudents','App\Http\Controllers\LMS_StudentController@index');
    Route::get('/AD_StatusStudent/{id}/{action}','App\Http\Controllers\LMS_StudentController@status');
    Route::get('/AD_DeleteStudent/{id}','App\Http\Controllers\LMS_StudentController@destroy');
    Route::get('/AD_EditStudent/{id}','App\Http\Controllers\LMS_StudentController@show');
    Route::post('/StudentEdit/{id}','App\Http\Controllers\LMS_StudentController@edit');
    Route::get('/AD_ViewStudents/{id}','App\Http\Controllers\LMS_StudentController@view');
    Route::get('/Download_Setudent_Details/{id}','App\Http\Controllers\LMS_StudentController@Download_Setudent_Details');
    Route::get('/Download_Setudent_Payment/{id}','App\Http\Controllers\LMS_StudentController@Download_Setudent_Payment');

    //class rooms
    Route::get('/AD_ClassRooms','App\Http\Controllers\LMS_ClassroomController@classManager');

    //in class room
    Route::get('/class_dashboard/{class}','App\Http\Controllers\LMS_IN_ClassRoom_Dashboard@index');

    Route::get('/class_EmbedVideo/{class}','App\Http\Controllers\LMS_IN_ClassRoom_VideoLessonController@AddLesson');
    Route::post('/EmbedVideoAction/{class}','App\Http\Controllers\LMS_IN_ClassRoom_VideoLessonController@insert');
    Route::get('/class_manageVideos/{class}','App\Http\Controllers\LMS_IN_ClassRoom_VideoLessonController@manageVideos');
    Route::get('/class_EditVideoLesson/{id}/{class}','App\Http\Controllers\LMS_IN_ClassRoom_VideoLessonController@show');
    Route::post('/EditVideoAction/{id}/{class}','App\Http\Controllers\LMS_IN_ClassRoom_VideoLessonController@edit');
    Route::get('/class_DeleteVideoLesson/{id}/{class}','App\Http\Controllers\LMS_IN_ClassRoom_VideoLessonController@destroy');
    Route::get('/class_PlayVideoLesson/{id}/{class}','App\Http\Controllers\LMS_IN_ClassRoom_VideoLessonController@play');

    Route::get('/class_SendAnnouncement/{class}','App\Http\Controllers\LMS_IN_ClassRoom_AnnouncementController@AddAnnouncement');
    Route::post('/SendAnnouncementAction/{class}','App\Http\Controllers\LMS_IN_ClassRoom_AnnouncementController@insert');
    Route::get('/class_manageAnnouncements/{class}','App\Http\Controllers\LMS_IN_ClassRoom_AnnouncementController@manageAnnouncements');
    Route::get('/class_EditAnnouncement/{id}/{class}','App\Http\Controllers\LMS_IN_ClassRoom_AnnouncementController@show');
    Route::post('/EditAnnouncementAction/{id}/{class}','App\Http\Controllers\LMS_IN_ClassRoom_AnnouncementController@edit');
    Route::get('/class_DeleteAnnouncement/{id}/{class}','App\Http\Controllers\LMS_IN_ClassRoom_AnnouncementController@destroy');

    Route::get('/class_Students/{class}','App\Http\Controllers\LMS_StudentController@classStudents');
    Route::get('/class_ViewStudents/{id}/{class}','App\Http\Controllers\LMS_StudentController@classView');
    Route::get('/class_ChangeClassroom/{id}/{class}','App\Http\Controllers\LMS_StudentController@changeClassroom');
    Route::post('/ChangeClassroomAction/{id}/{class}','App\Http\Controllers\LMS_StudentController@changeAction');

    Route::get('/class_Payments_step1/{class}','App\Http\Controllers\LMS_IN_ClassRoomPaymentController@daypiker');
    Route::post('/class_Payments_step2/{class}','App\Http\Controllers\LMS_IN_ClassRoomPaymentController@index');

    Route::post('/LiveClassInsert/{class}','App\Http\Controllers\LMS_IN_ClassRoom_LiveClass@insert');
    Route::get('/EndLive/{id}/{class}','App\Http\Controllers\LMS_IN_ClassRoom_LiveClass@destroy');



    //Learning management

    //student payment
    Route::get('/Get_Student_Payment', function () {
        return view('/Finance/StudentPayment_StudentNumber_Form');
    });
    Route::get('/GetPaymentPortal','App\Http\Controllers\Finance_Controller@GetPaymentPortal');
    Route::post('/PlacePayment','App\Http\Controllers\Finance_Controller@PlacePayment');
    Route::get('/DownloadInvoice/{invoiceNumber}','App\Http\Controllers\Finance_Controller@Invoice_Download');
    Route::get('/Manage_Student_Payments','App\Http\Controllers\Finance_Controller@index');
    Route::get('/AD_DeletePayment/{id}','App\Http\Controllers\Finance_Controller@destroy');
    Route::get('/AD_EditPayment/{id}','App\Http\Controllers\Finance_Controller@show');
    Route::post('/PaymentEditAction/{id}','App\Http\Controllers\Finance_Controller@edit');
    Route::post('/Manage_Student_Payments/{filter}','App\Http\Controllers\Finance_Controller@index_filter');
    Route::get('/Manage_Student_Payments_Today','App\Http\Controllers\Finance_Controller@index_filter_today');

    //other incomes
    Route::get('/Get_Other_Income','App\Http\Controllers\Finance_Controller@other_income_form');
    Route::post('/OtherIncomeInsertAction','App\Http\Controllers\Finance_Controller@PlaceOtherIncome');
    Route::get('/Manage_Other_Incomes','App\Http\Controllers\Finance_Controller@indexOther');
    Route::get('/Manage_Other_Incomes_Today','App\Http\Controllers\Finance_Controller@indexOther_filter_today');
    Route::post('/Manage_Other_Incomes/{filter}','App\Http\Controllers\Finance_Controller@indexOther_filter');
    Route::get('/AD_EditOtherPayment/{id}','App\Http\Controllers\Finance_Controller@showOther');
    Route::post('/OtherIncomeUpdateAction/{id}','App\Http\Controllers\Finance_Controller@editOther');
    Route::get('/AD_DeleteOtherPayment/{id}','App\Http\Controllers\Finance_Controller@destroyOther');
    Route::get('/DownloadInvoiceOtherPayment/{invoiceNumber}','App\Http\Controllers\Finance_Controller@Invoice_Other_Download');

    //Expenses
    Route::get('/Add_Expenses', function () {
        return view('/Finance/Add_Expenses');
    });
    Route::post('/ExpensesInsertAction','App\Http\Controllers\Finance_Controller@insertExpenses');
    Route::get('/Manage_Expenses','App\Http\Controllers\Finance_Controller@indexExpenses');
    Route::get('/ManageExpenses_filter_today','App\Http\Controllers\Finance_Controller@indexExpenses_filter_today');
    Route::post('/Manage_Expenses/{filter}','App\Http\Controllers\Finance_Controller@indexExpenses_filter');
    Route::get('/EditExpenses/{id}','App\Http\Controllers\Finance_Controller@showExpensesEditView');
    Route::post('/ExpensesUpdateAction/{id}','App\Http\Controllers\Finance_Controller@updateExpenses');
    Route::get('/DeleteExpenses/{id}','App\Http\Controllers\Finance_Controller@destroyExpenses');   

    //Finance Report
    Route::get('/FinanceReport', function () {
        return view('/Finance/FinanceReports');
    });
    Route::post('/reportAction/{type}','App\Http\Controllers\Finance_Controller@reports');   


    Route::get('/AttendanceSelector', function () {
        return view('/Attendance/AttendanceSelector');
    });
    Route::get('/GetStudentAttendance','App\Http\Controllers\Attendance_Controller@index');
    Route::post('/PlacePaymentAttend','App\Http\Controllers\Attendance_Controller@PlacePayment');
    Route::get('/MarkAttend/{S_ID}','App\Http\Controllers\Attendance_Controller@MarkAttend');
    Route::get('/ManageAttendanceSelector', function () {
        return view('/Attendance/manageAttendanceSelector');
    });
    Route::get('/ManageAttendance','App\Http\Controllers\Attendance_Controller@manage');
    Route::get('/DeleteAttendance/{id}','App\Http\Controllers\Attendance_Controller@destroy');





    //Student Account 
    Route::get('/StudentLogin', function () {
        return view('StudentLogin'); 
    });
    Route::get('/ST_Dashboard','App\Http\Controllers\ST_Controller@dashboard');
    Route::get('/ST_Videos','App\Http\Controllers\ST_Controller@manageVideos');
    Route::get('/PlayVideoLesson/{id}','App\Http\Controllers\ST_Controller@play');
    Route::get('/MyPayments','App\Http\Controllers\ST_Controller@payments');
    Route::get('/Profile','App\Http\Controllers\ST_Controller@profile');
    Route::post('/changePassword','App\Http\Controllers\ST_Controller@changePassword');
    // Route::get('/Dashboard','App\Http\Controllers\ST_Dashboard@index');


    //assign systems
    Route::get('/AddSystem','App\Http\Controllers\System_Assign@addPage');
    Route::post('/Assign','App\Http\Controllers\System_Assign@Assign');
    Route::post('/AssignEdit','App\Http\Controllers\System_Assign@AssignEdit');
    Route::get('/ManageSystems','App\Http\Controllers\System_Assign@ManageSystems');
    Route::get('/EditSystems/{id}','App\Http\Controllers\System_Assign@EditSystems');



    //stork
    Route::get('/AddNewItem', function () {
        return view('Stock/AddNewItem'); 
    });
    Route::post('/CreateAction','App\Http\Controllers\StockController@ItemInsert');
    Route::get('/ManageItems','App\Http\Controllers\StockController@StorkIndex');
    Route::get('/EditItem/{id}','App\Http\Controllers\StockController@EditView');
    Route::post('/EditAction/{id}','App\Http\Controllers\StockController@updateItem'); 
    Route::get('/DeleteItem/{id}','App\Http\Controllers\StockController@destroy');
    Route::get('/store','App\Http\Controllers\StockController@storeView');
    Route::post('/qtyinsert','App\Http\Controllers\StockController@qtyInsert');
    Route::post('/qtyupdate','App\Http\Controllers\StockController@qtyUpdate');

    Route::get('/removels','App\Http\Controllers\StockMainController@index');
    Route::get('/removelList','App\Http\Controllers\StockMainController@removelList');
    Route::post('/filterRemovel','App\Http\Controllers\StockMainController@filterRemovel');
    Route::get('/DeleteRemovel/{id}','App\Http\Controllers\StockMainController@DeleteRemovel');
    Route::get('/MoreRemovel/{id}','App\Http\Controllers\StockMainController@MoreRemovel');
    Route::get('/RemovelDetailsDownload/{id}','App\Http\Controllers\StockMainController@RemovelDetailsDownload');
    Route::get('/AddToCart','App\Http\Controllers\StockMainController@AddToCart');
    Route::get('/removeFromCart/{id}','App\Http\Controllers\StockMainController@removeCart');
    Route::post('/ActionStokOut','App\Http\Controllers\StockMainController@ActionStokOut');

//login
Route::get('/login', function () {
    return view('loginShow'); 
});

Route::post('/CheckLogin','App\Http\Controllers\loginController@check');
Route::get('/Logout','App\Http\Controllers\loginController@Logout');
Route::post('/CheckLoginStudent','App\Http\Controllers\loginController@STcheck');
Route::get('/LogoutST','App\Http\Controllers\loginController@LogoutST');