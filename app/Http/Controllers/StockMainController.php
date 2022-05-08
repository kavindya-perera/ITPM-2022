<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\cart;
use App\Models\stockManage;
use App\Models\StorkOutJobItems;
use App\Models\StorkOutJobs;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\StockHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use \Exception;


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

class StockMainController extends Controller
{
    public function index(){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $items = DB::select('SELECT * FROM stocks,stock_manages WHERE stocks.ITEM_ID = stock_manages.SM_ITEM_ID AND  stock_manages.SM_ITEM_QTY > 0 ORDER BY stocks.ITEM_NAME DESC');
            $cart = DB::select('SELECT * FROM carts,stocks,stock_manages WHERE stocks.ITEM_ID = stock_manages.SM_ITEM_ID AND  carts.C_ITEM_ID = stocks.ITEM_CODE AND carts.C_OWNER = ? ORDER BY stocks.ITEM_NAME DESC',[Session::get('AdminEmNumber')]);
            return view('Stock/removels',['items'=>$items,'cart'=>$cart]);
        }
    }


    public function AddToCart(Request $request){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $rules = [
               'item' => 'required|string',
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{
              
                $data = $request->input();
                $alreadyAdded = DB::select('SELECT * FROM carts WHERE C_ITEM_ID = ?',[$data['item']]);

                if($alreadyAdded == true){
                    return Redirect::back()->with('failed',"This Item Already Added to the cart!");
                }else{
                    try{
                        $cart = new cart;
                        $cart->C_OWNER =  Session::get('AdminEmNumber') ;
                        $cart->C_ITEM_ID = test_input($data['item']);
                        $cart->C_ITEM_QTY = 1;
                        if($cart->save()){
                            return redirect('removels');
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

    public function removeCart($id) {
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
                DB::delete('DELETE FROM carts WHERE C_ID = ?',[$id]);
                return Redirect::back()->with('status',"Item removed from cart!");
            }
        }
    }



    public function ActionStokOut(Request $request){
        date_default_timezone_set('Asia/Colombo');
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $rules = [
               'Recipient' => 'required|string',
               'contact' => 'required|numeric',
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{
              
                $data = $request->input();
                if(empty($data['ItemCode']) || empty($data['qty'])){
                    return Redirect::back()->with('failed',"Found an error of Items or Items' Qty");
                    exit;
                }
                $ItemCodes = $data['ItemCode'];
                $Itemqtys = $data['qty'];

            
             
                    try{
                        $StorkOutJobs = new StorkOutJobs;
                        $StorkOutJobs->JO_DATE = date('Y-m-d');
                        $StorkOutJobs->JO_TO = test_input($data['Recipient']);
                        $StorkOutJobs->JO_CONTACT = test_input($data['contact']);
                        $StorkOutJobs->JO_DESCRIPTION = test_input($data['remark']);
                        $StorkOutJobs->JOB_HANDLER =  Session::get('AdminEmNumber');
                        if($StorkOutJobs->save()){
                            $lastID = DB::getPdo()->lastInsertId();

                            foreach($ItemCodes as $index=>$itemcode){
                                
                                $itemDetails= DB::select('SELECT stock_manages.SM_ITEM_QTY,stock_manages.SM_ID FROM stocks,stock_manages WHERE stocks.ITEM_ID = stock_manages.SM_ITEM_ID AND stocks.ITEM_CODE = ? LIMIT 1',[$itemcode]);
                                $Item_QTY = $itemDetails[0]->SM_ITEM_QTY;

                                if($Item_QTY < $Itemqtys[$index]){
                                    return Redirect::back()->with('failed',"Incorrect Qty");
                                    exit;
                                }
                            }

                            foreach($ItemCodes as $index=>$itemcode){

                                $itemDetails= DB::select('SELECT stock_manages.SM_ITEM_QTY,stock_manages.SM_ID FROM stocks,stock_manages WHERE stocks.ITEM_ID = stock_manages.SM_ITEM_ID AND stocks.ITEM_CODE = ? LIMIT 1',[$itemcode]);
                                $Item_QTY = $itemDetails[0]->SM_ITEM_QTY;
                                $SM_ID = $itemDetails[0]->SM_ID;
                                    
                                $StorkOutJobItems = new StorkOutJobItems;
                                $StorkOutJobItems->JOI_JOB_ID = $lastID;
                                $StorkOutJobItems->JOI_ITEM_CODE = $itemcode;
                                $StorkOutJobItems->JOI_QTY = $Itemqtys[$index];
                                $StorkOutJobItems->save();


                                DB::update('UPDATE stock_manages SET 
                                    SM_ITEM_QTY=?
                                WHERE SM_ID  = ?',[
                                    $Item_QTY - $Itemqtys[$index],
                                    $SM_ID
                                ]);

                                $stockHistory = new StockHistory;
                                $stockHistory->SH_DATE = date('Y-m-d');
                                $stockHistory->SH_TIME = date("h:i a");
                                $stockHistory->SH_ITEM_CODE = $itemcode;
                                $stockHistory->SH_DESCRIPTION = $Itemqtys[$index].' Out from the stock.';
                                $stockHistory->Employee_ID = Session::get('AdminEmNumber');
                                $stockHistory->save();
                                
                            }
                            DB::delete('DELETE FROM carts WHERE C_OWNER = ?',[Session::get('AdminEmNumber')]);
                            return redirect('removels')->with('status',"Items Out process has been completed successfully!");
                        
                           
                            
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




    public function removelList(){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $removels = DB::select('SELECT * FROM stork_out_jobs  ORDER BY JO_DATE DESC LIMIT 100');
            return view('Stock/removelManage',['removels'=>$removels]);
        }
    }

    public function filterRemovel(Request $request){
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $rules = [
                'Date_Since' => 'required|string',
                'Date_To' => 'required|string'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed', "operation failed");
            } else {
                $data = $request->input();

                $Date_Since = date_create($data['Date_Since']);
                $Date_To = date_create($data['Date_To']);

                if($Date_Since > $Date_To){
                    return Redirect::back()->with('failed',"Invalid Date Range");
                }else{
                    $removels = DB::select('SELECT * FROM stork_out_jobs  WHERE JO_DATE BETWEEN ? AND ?',[$Date_Since,$Date_To]);
                    return view('Stock/removelManage', ['removels'=>$removels]);
                }

            }
        }
    }


    public function DeleteRemovel($id) { 
        if(islog() != 1 ){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $id = test_input($id);
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{
                $itemID = array();
                $itemQTY = array();
                $itemRealQTY = array();
                $itemCode = array();
           
                $removel = DB::select('SELECT * FROM stork_out_job_items,stocks,stock_manages  WHERE stork_out_job_items.JOI_ITEM_CODE = stocks.ITEM_CODE AND stock_manages.SM_ITEM_ID = stocks.ITEM_ID AND  stork_out_job_items.JOI_JOB_ID = ? ',[$id]);
                foreach($removel as $removel){
                    array_push($itemID,$removel->ITEM_ID);
                    array_push($itemCode,$removel->ITEM_CODE);
                    array_push($itemQTY,$removel->JOI_QTY);
                    array_push($itemRealQTY,$removel->SM_ITEM_QTY);
                }
           
                foreach($itemID as $index=>$val){

                    $stockHistory = new StockHistory;
                    $stockHistory->SH_DATE = date('Y-m-d');
                    $stockHistory->SH_TIME = date("h:i a");
                    $stockHistory->SH_ITEM_CODE = $itemCode[$index];
                    $stockHistory->SH_DESCRIPTION = 'Delete Removal. Updated qty '.$itemRealQTY[$index].' to '.$itemQTY[$index];
                    $stockHistory->Employee_ID = Session::get('AdminEmNumber');
                    $stockHistory->save();

                    DB::update('UPDATE stock_manages SET 
                        SM_ITEM_QTY=?
                    WHERE SM_ITEM_ID  = ?',[
                        $itemRealQTY[$index] + $itemQTY[$index],
                        $val
                    ]);
                }

                DB::delete('DELETE FROM stork_out_jobs WHERE JO_ID = ?',[$id]);
                DB::delete('DELETE FROM stork_out_job_items WHERE JOI_JOB_ID = ?',[$id]);

                return redirect('removelList')->with('status',"Item removed!");
            }
        }
    }


    public function MoreRemovel($id) {
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
                $removels = DB::select('SELECT * FROM stork_out_jobs  WHERE JO_ID = ? LIMIT 1',[$id]);
                $removelItems = DB::select('SELECT * FROM stork_out_job_items,stocks  WHERE stork_out_job_items.JOI_ITEM_CODE = stocks.ITEM_CODE AND stork_out_job_items.JOI_JOB_ID = ?',[$id]);
                return view('Stock/removelMore',['removelDetails'=>$removels,'removelItemsDetails'=>$removelItems]);
            }
        }
    }


    public function RemovelDetailsDownload($id) {
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
                $removels = DB::select('SELECT * FROM stork_out_jobs  WHERE JO_ID = ? LIMIT 1',[$id]);
                $removelItems = DB::select('SELECT * FROM stork_out_job_items,stocks  WHERE stork_out_job_items.JOI_ITEM_CODE = stocks.ITEM_CODE AND stork_out_job_items.JOI_JOB_ID = ?',[$id]);
                return view('Download/DownloadRemovelDetails',['removelDetails'=>$removels,'removelItemsDetails'=>$removelItems]);
            }
        }
    }




}
