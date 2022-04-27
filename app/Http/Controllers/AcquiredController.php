<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AcquiredController extends Controller
{
    
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     *  */
    public function index(Request $request)
    {
        //Inventory Table
        //$articleid = $request->articleid;
        $description = $request->description;
        $unitofmeasure = $request->unitofmeasure;
        $unitvalue = $request->unitvalue;
        $date_acquired = $request->date_acquired;

        //Inventory Logs
        $propertynumber = $request->propertynumber;
        
        //Property
        //$statusid = $request->statusid;
        //$assignedto = $request->assignedto;
        $location = $request->location;
        $remarks = $request->remarks;
        $tempname = $request->tempname;
        //$registered = $request->registered;

        $displayarticle = DB::table('article')
        ->select("article.id as id","article.code as code","article.article as article","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->get();

        $displayproperty = DB::table('property_transfer')
        ->select("property_transfer.id as id","article.article as article","inventory.description as description","inventory.unit_of_measure as unitmeasure","inventory.unit_value as value",
        "inventory.date_acquired as date_acquired", 
        "inventory_logs.property_number as propertynumber",
        "property_transfer.status as status","property_transfer.assigned_to as assigned_to","property_transfer.location as location","property_transfer.remarks as remarks",
        "property_transfer.temp_name as tempname","property_transfer.registered_status as registeredstatus")
        ->leftJoin('inventory_logs', 'inventory_logs.id', '=', 'property_transfer.id_inventory')
        ->leftJoin('inventory', 'inventory.id', '=', 'inventory_logs.id_inventory')
        ->leftJoin('article', 'article.id', '=', 'inventory.id_article')
        ->get();

        $displaytransferredlogs = DB::table('property_logs')
        ->select("property_transfer.id as id","inventory_logs.property_number as propnumber","property_logs.received_date as receiveddate","property_logs.location as location",
        "property_logs.registered_status as regstatus","property_logs.assigned_to as assigned","property_logs.temp_name as tempname",
        "property_logs.status as status","property_logs.remarks as remarks")
        ->leftJoin('property_transfer', 'property_transfer.id', '=', 'property_logs.property_id')
        ->leftJoin('inventory_logs', 'inventory_logs.id', '=', 'property_transfer.id_inventory')
        ->get();

        $displayemployee = DB::connection('mysql2')
        ->table('tbl_user')
        ->select("EMP_NO as id",DB::raw("CONCAT(NAME_F,' ',NAME_L) AS fullname"))
        ->get();


        return view('acquired.index',[
            'displayarticle' => $displayarticle,
            'displayemployee' => $displayemployee,
            'displayproperty' => $displayproperty,
            'displaytransferredlogs' => $displaytransferredlogs
        ]
        )
        ->with('description',$description)
        ->with('unitofmeasure',$unitofmeasure)
        ->with('unitvalue',$unitvalue)
        ->with('date_acquired',$date_acquired)
        ->with('propertynumber',$propertynumber)
        ->with('location',$location)
        ->with('remarks',$remarks)
        ->with('tempname',$tempname)
        ;

    }

    public function acquiredstore(Request $request){
        //Inventory Table
        $articleid = $request->articleid;
        $description = $request->description;
        $unitofmeasure = $request->unitofmeasure;
        $unitvalue = $request->unitvalue;
        $date_acquired = $request->date_acquired;

        //Inventory Logs
        $propertynumber = $request->propertynumber;
        
        //Property
        $statusid = $request->statusid;
        $assignedto = $request->assignedto;
        $location = $request->location;
        $remarks = $request->remarks;
        $tempname = $request->tempname;
        $registered = $request->registered;

        if($registered == "YES"){

                    $messages =
                [
                    'articleid.required' => "Article Name is Required",

                    'description.required' => "Description is Required",
                    'unitofmeasure.required' => "Unit of Measure is required and accepts numbers only",
                    'unitvalue.required' => "Unit Value is required and accepts numbers only",
                    'date_acquired.required' => "Date Acquired is Required",
                    'propertynumber.required' => "Property Number is Required",

                    'statusid.required' => "Status of Equipment is Required",
                    'assignedto.required' => "Assigned Employee is Required",

                    'location.required' => "Location is Required",
                    //'remarks.required' => "Category Name is Required",
                    //'tempname.required' => "Temporary Name is Required",

                    'registered.required' => "Registered Employee is Required",
                ];

                $rules = [

                    'articleid' => 'required',

                    'description' => 'required',
                    'unitofmeasure' => 'required',
                    'unitvalue' => 'required',
                    'date_acquired' => 'required',
                    'propertynumber' => 'required',

                    'statusid' => 'required',
                    'assignedto' => 'required',

                    'location' => 'required',
                    //'remarks' => 'required',
                    //'tempname' => 'required',

                    'registered' => 'required',
                ];

                $validate =  Validator::make($request->all(),$rules,$messages);

                if($validate->fails()){

                    return redirect()->back()->withErrors($validate->messages())->withInput();
                }
                else {

                    $datainventory=array('id_article'=>$articleid,'description'=>$description,'date_acquired'=>$date_acquired,
                    'unit_of_measure'=>$unitofmeasure,'unit_value'=>$unitvalue,'inputted'=>1);
                    DB::table('inventory')->insertOrIgnore($datainventory);

                    $getinventorymaxid =   DB::table('inventory')
                    ->select(DB::raw("MAX(id) AS id"))
                    ->value('id');

                    $datainventorylogs=array('id_inventory'=>$getinventorymaxid,'property_number'=>$propertynumber);
                    DB::table('inventory_logs')->insertOrIgnore($datainventorylogs);

                    $getinventorylogsmaxid = DB::table('inventory_logs')
                    ->select(DB::raw("MAX(id) AS id"))
                    ->value('id');

                    $dataproperty=array('id_inventory'=>$getinventorylogsmaxid,'received_date'=>$date_acquired,'location'=>$location,
                    'assigned_to'=>$assignedto,'status'=>$statusid,'remarks'=>$remarks,
                    'registered_status'=>$registered, 'temp_name'=>$tempname);
                    DB::table('property_transfer')->insertOrIgnore($dataproperty);


                    return redirect()->route('acquired.index')
                                    ->with('success','Article created successfully.');
                }

        }

        else if ($registered == "NO"){

                $messages =
                [
                    'articleid.required' => "Article Name is Required",

                    'description.required' => "Description is Required",
                    'unitofmeasure.required' => "Unit of Measure is required and accepts numbers only",
                    'unitvalue.required' => "Unit Value is required and accepts numbers only",
                    'date_acquired.required' => "Date Acquired is Required",
                    'propertynumber.required' => "Property Number is Required",

                    'statusid.required' => "Status of Equipment is Required",
                    //'assignedto.required' => "Assigned Employee is Required",

                    'location.required' => "Location is Required",
                    //'remarks.required' => "Category Name is Required",
                    'tempname.required' => "Temporary Name is Required",

                    'registered.required' => "Registered Employee is Required",
                ];

                $rules = [

                    'articleid' => 'required',

                    'description' => 'required',
                    'unitofmeasure' => 'required',
                    'unitvalue' => 'required',
                    'date_acquired' => 'required',
                    'propertynumber' => 'required',

                    'statusid' => 'required',
                    //'assignedto' => 'required',

                    'location' => 'required',
                    //'remarks' => 'required',
                    'tempname' => 'required',

                    'registered' => 'required',
                ];

                $validate =  Validator::make($request->all(),$rules,$messages);

                if($validate->fails()){

                    return redirect()->back()->withErrors($validate->messages())->withInput();
                }
                else {

                    $datainventory=array('id_article'=>$articleid,'description'=>$description,'date_acquired'=>$date_acquired,
                    'unit_of_measure'=>$unitofmeasure,'unit_value'=>$unitvalue,'inputted'=>1);
                    DB::table('inventory')->insertOrIgnore($datainventory);
            
                    $getinventorymaxid =   DB::table('inventory')
                    ->select(DB::raw("MAX(id) AS id"))
                    ->value('id');
            
                    $datainventorylogs=array('id_inventory'=>$getinventorymaxid,'property_number'=>$propertynumber);
                    DB::table('inventory_logs')->insertOrIgnore($datainventorylogs);
            
                    $getinventorylogsmaxid = DB::table('inventory_logs')
                    ->select(DB::raw("MAX(id) AS id"))
                    ->value('id');
            
                    $dataproperty=array('id_inventory'=>$getinventorylogsmaxid,'received_date'=>$date_acquired,'location'=>$location,
                    'assigned_to'=>$assignedto,'status'=>$statusid,'remarks'=>$remarks,
                    'registered_status'=>$registered, 'temp_name'=>$tempname);
                    DB::table('property_transfer')->insertOrIgnore($dataproperty);
            
            
                    return redirect()->route('acquired.index')
                                    ->with('success','Article created successfully.');
                }

        }

        else{

                $messages =
                [
                    'registered.required' => 'Please Input on the Necessary Information',
                ];

                $rules = [

                    'registered' => 'required',

                ];

                $validate =  Validator::make($request->all(),$rules,$messages);

                if($validate->fails()){

                    return redirect()->back()->withErrors($validate->messages())->withInput();
                }     
        }
    }

    public function transfermodalstore(Request $request){
        //Inventory Table
        $propertytransferid = $request->textid;
        $transmodalregistered = $request->transmodalregistered;
        $transmodalassignedto = $request->transmodalassignedto;
        $transmodaltempname = $request->transmodaltempname;
        $transmodaltransferred_date = $request->transmodaltransferred_date;
        $transmodalstatusid = $request->transmodalstatusid;
        $transmodallocation = $request->transmodallocation;
        $transmodalremarks = $request->transmodalremarks;


        /*$datainventory=array('property_id'=>$propertytransferid,'received_date'=>$transmodaltransferred_date,'location'=>$transmodallocation,
        'registered_status'=>$transmodalregistered,'assigned_to'=>$transmodalassignedto,'temp_name'=>$transmodaltempname,'status'=>$transmodalstatusid,'remarks'=>$transmodalremarks);
        DB::table('property_logs')->insertOrIgnore($datainventory);*/

        $datas = DB::table('property_transfer')
        ->where('id',$propertytransferid)
        ->first();

        $datasproperty_id = $datas->id;
        $datasinventory_id = $datas->id_inventory;
        $datasreceived_date = $datas->received_date;
        $dataslocation = $datas->location;
        $datasregistered_status = $datas->registered_status;
        $datasassigned_to = $datas->assigned_to;
        $datastemp_name = $datas->temp_name;
        $datasstatus = $datas->status;
        $datasremarks = $datas->remarks;

        $datainventory=array('property_id'=>$datasproperty_id,'inventory_id'=>$datasinventory_id,'received_date'=>$datasreceived_date,'location'=>$dataslocation,
        'registered_status'=>$datasregistered_status,'assigned_to'=>$datasassigned_to,'temp_name'=>$datastemp_name,'status'=>$datasstatus,'remarks'=>$datasremarks);
        DB::table('property_logs')->insertOrIgnore($datainventory);

        DB::table('property_transfer')
            ->where('id', $propertytransferid)
            ->update(['received_date' => $transmodaltransferred_date,
                      'location'=>$transmodallocation,
                      'registered_status'=>$transmodalregistered,
                      'assigned_to'=>$transmodalassignedto,
                      'temp_name'=>$transmodaltempname,
                      'status'=>$transmodalstatusid,
                      'remarks'=>$transmodalremarks,
                    ]);

        //print_r($datainventory);
        return redirect()->route('acquired.index')
                        ->with('success','Article created successfully.');

    }
}
