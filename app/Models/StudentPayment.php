<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Redirect;


class StudentPayment extends Model
{
    use HasFactory;
    public  function CheckCorrectStudentID($id){
        $StudentDetails = DB::select('SELECT * FROM students  WHERE  S_NUMBER =? LIMIT 1',[$id]);
        if($StudentDetails == TRUE){
            return FALSE;
        }else{
            return TRUE;
        }
    }


    public  function GetMonth($month){
        if($month == 1):
            return "January";
        elseif($month == 2):
            return "February";
        elseif($month == 3):
            return "March";
        elseif($month == 4):
            return "April";
        elseif($month == 5):
            return "May";
        elseif($month == 6):
            return "June";
        elseif($month == 7):
            return "July";
        elseif($month == 8):
            return "August";
        elseif($month == 9):
            return "September";
        elseif($month == 10):
            return "October";
        elseif($month == 11):
            return "November";
        elseif($month == 12):
            return "December";
        endif;

    }

  
    
}
