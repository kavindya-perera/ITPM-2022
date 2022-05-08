<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\stockManage;
use App\Models\StockHistory;
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

class StockController extends Controller
{
                //inser item
                public function ItemInsert(Request $request){
                    if(islog() != 1){
                        return redirect('Logout')->with('failed',"operation failed");
                    }else{
                        $rules = [
                           'ITEM_NAME' => 'required|string|min:3|max:100',
                           'ITEM_REMARK' => 'required|string|min:3|max:500',

                        ];
                        $validator = Validator::make($request->all(),$rules);
                        if ($validator->fails()) {
                            return Redirect::back()->with('failed',"operation failed");
                        }else{
                            $RandomNumber = "I".date('y').rand(10,99).rand(10,99);
                            $invalidItemCode = DB::select('SELECT * FROM stocks WHERE ITEM_CODE =? LIMIT 1',[$RandomNumber]);
                            if($invalidItemCode == FALSE){
                
                                $data = $request->input();
                                try{
                                    $Stock = new Stock;
                                    $Stock->ITEM_CODE =  $RandomNumber ;
                                    $Stock->ITEM_CREATED_BY =  Session::get('AdminEmNumber') ;
                                    $Stock->ITEM_CREATED_DATE = date('Y-m-d');
                                    $Stock->ITEM_NAME = test_input($data['ITEM_NAME']);
                                    $Stock->ITEM_REMARK = test_input($data['ITEM_REMARK']);
                                    if($Stock->save()){
                                        return Redirect::back()->with('status',"Item has been successfully created.");
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

                    }
                }



        //mange items
        public function StorkIndex(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $items = DB::select('SELECT * FROM stocks  ORDER BY ITEM_ID DESC');
                return view('Stock/ManageItems',['items'=>$items]);
            }
        }

        //mange items
        public function storeView(){
            if(islog() != 1){
                return redirect('Logout')->with('failed',"operation failed");
            }else{
                $items = DB::select('SELECT * FROM stocks LEFT JOIN stock_manages ON stocks.ITEM_ID = stock_manages.SM_ITEM_ID');
                return view('Stock/store',['items'=>$items]);
            }
        }




                // Edit View 
                public function EditView($id) {
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
                            $Data = DB::select('SELECT * FROM stocks WHERE ITEM_ID  = ? LIMIT 1',[$id]);
                            if($Data == TRUE){
                                return view('Stock/EditItem',['Item'=>$Data]);
                            }else{
                                return Redirect::back()->with('failed',"operation failed");
                            }
                        }
                    }
                    
                }




    public function updateItem(Request $request,$id) {
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
                    'ITEM_NAME' => 'required|string|min:3|max:100',
                    'ITEM_REMARK' => 'required|string|min:3|max:500'
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                        $ITEM_NAME = $request->input('ITEM_NAME');
                        $ITEM_REMARK = $request->input('ITEM_REMARK');
                
                        $ITEM_NAME = test_input($ITEM_NAME);
                        $ITEM_REMARK = test_input($ITEM_REMARK);

                        DB::update('UPDATE stocks SET 
                            ITEM_CREATED_BY=?, 
                            ITEM_NAME=?,
                            ITEM_REMARK=?
                        WHERE ITEM_ID  = ?',[
                            Session::get('AdminEmNumber'),
                            $ITEM_NAME,
                            $ITEM_REMARK,
                            $id
                        ]);
                            
                        return redirect('ManageItems')->with('status',"Item details have been Updated!");
                 
                    
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
                DB::delete('DELETE FROM stocks WHERE ITEM_ID = ?',[$id]);
                return Redirect::back()->with('status',"Item Details have been deleted!");
            }
        }
    }



    public function qtyInsert(Request $request){
        date_default_timezone_set('Asia/Colombo');
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
            $rules = [
               'item_id' => 'required|numeric',
               'item_code' => 'required|string',
               'qty' => 'required|numeric|max:500',

            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return Redirect::back()->with('failed',"operation failed");
            }else{
    
    
                    $data = $request->input();
                    try{
                        $stockManage = new stockManage;
                        $stockManage->SM_ITEM_ID = test_input($data['item_id']) ;
                        $stockManage->SM_UPDATE_EMPLOYEE = Session::get('AdminEmNumber');
                        $stockManage->SM_ITEM_QTY = test_input($data['qty']);
                        if($stockManage->save()){
                            $stockHistory = new StockHistory;
                            $stockHistory->SH_DATE = date('Y-m-d');
                            $stockHistory->SH_TIME = date("h:i a");
                            $stockHistory->SH_ITEM_CODE = test_input($data['item_code']);
                            $stockHistory->SH_DESCRIPTION = 'Updated Qty 0 to '.$data['qty'];
                            $stockHistory->Employee_ID = Session::get('AdminEmNumber');
                            $stockHistory->save();
                            return redirect('store')->with('status',"Qty has been successfully Updated.");
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



    public function qtyupdate(Request $request) {
        date_default_timezone_set('Asia/Colombo');
        if(islog() != 1){
            return redirect('Logout')->with('failed',"operation failed");
        }else{
      
                $rules = [
                    'item_id' => 'required|numeric',
                    'item_code' => 'required|string',
                    'qty' => 'required|numeric|max:500',
                    'pastqty' => 'required|numeric|max:500',
                ];
                $validator = Validator::make($request->all(),$rules);
                if ($validator->fails()) {
                    return Redirect::back()->with('failed',"operation failed");
                }else{

                        $item_id = $request->input('item_id');
                        $qty = $request->input('qty');
                
                        $item_id = test_input($item_id);
                        $qty = test_input($qty);

                        DB::update('UPDATE stock_manages SET 
                            SM_ITEM_QTY=?,
                            SM_UPDATE_EMPLOYEE=?
                        WHERE SM_ID  = ?',[
                            $qty,
                            Session::get('AdminEmNumber'),
                            $item_id
                        ]);

                        $stockHistory = new StockHistory;
                        $stockHistory->SH_DATE = date('Y-m-d');
                        $stockHistory->SH_TIME = date("h:i a");
                        $stockHistory->SH_ITEM_CODE = $request->input('item_code');
                        $stockHistory->SH_DESCRIPTION = 'Updated Qty '.$request->input('pastqty').' to '.$qty;
                        $stockHistory->Employee_ID = Session::get('AdminEmNumber');
                        $stockHistory->save();
                            
                        return redirect('store')->with('status',"Qty has been successfully Updated.");
                 
                    
                }
            
        }
    }


        
            public function stockHistory(){
                if(islog() != 1){
                    return redirect('Logout')->with('failed',"operation failed");
                }else{
                    $historyData = DB::select('SELECT * FROM stock_histories h,stocks s WHERE h.SH_ITEM_CODE=s.ITEM_CODE ORDER BY h.SH_DATE DESC LIMIT 100');
                    return view('Stock/stockHistory',['historyData'=>$historyData]);
                }
            }

            public function clearHistory(){
                if(islog() != 1){
                    return redirect('Logout')->with('failed',"operation failed");
                }else{
                    DB::table('stock_histories')->truncate();
                    return redirect('stockHistory')->with('status',"history was cleared!");
                }
            }


            public function stockHistoryFilter(Request $request){
                if(islog() != 1){
                    return redirect('Logout')->with('failed',"operation failed");
                }else{

                      
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
                                    
                                    $stockHistory = DB::select('SELECT * FROM stock_histories h,stocks s
                                                                WHERE  h.SH_ITEM_CODE=s.ITEM_CODE AND
                                                                    (h.SH_DATE BETWEEN ? AND ?)
                                                                    ORDER BY h.SH_DATE DESC'
                                                            ,[$Date_Since,$Date_To]);
                                    if($stockHistory == TRUE){
                                        return view('Stock/stockHistory',['historyData'=>$stockHistory]);
                                    }else{
                                        return redirect('stockHistory')->with('failed',"No data!");
                                    }

                                }  
                            }
                        
                    
                }
            }



}
