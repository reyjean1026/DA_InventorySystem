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
        //$location = $request->location;
        $remarks = $request->remarks;
        $tempname = $request->tempname;
        //$registered = $request->registered;

        $displayarticle = DB::table('article')
        ->select("article.id as id","article.code as codes","article.article as article","category.code as code","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->get();

        $displayproperty = DB::table('inventory')
        ->select(DB::raw("CONCAT(personneldb.tbl_user.NAME_F,' ',personneldb.tbl_user.NAME_L) AS fullname"),
        "inventorydb.inventory.id as id","inventorydb.category.code as code","inventorydb.category.category_name as category","inventorydb.article.article as article",
        "inventorydb.inventory.description as description","inventorydb.inventory.quantity as unitmeasure","inventorydb.inventory.unit_value as value",
        "inventorydb.inventory.date_acquired as date_acquired","inventorydb.inventory.property_number as propertynumber","inventorydb.inventory.attachment as attachment",
        "inventorydb.inventory.status as status","inventorydb.inventory.assigned_to as assigned_to","inventorydb.inventory.remarks as remarks",
        "inventorydb.inventory.temp_name as tempname","inventorydb.inventory.registered_status as registeredstatus")
        ->leftJoin('inventorydb.article', 'inventorydb.article.id', '=', 'inventorydb.inventory.id_article')
        ->leftJoin('inventorydb.category', 'inventorydb.category.id', '=', 'inventorydb.article.category_id')
        ->leftJoin('personneldb.tbl_user', 'personneldb.tbl_user.EMP_NO', '=', 'inventorydb.inventory.assigned_to')
        ->where('inventorydb.inventory.in_status',1)
        //->paginate(25)
        ->get()
        ->toArray();

        $displaytransferredlogs = DB::table('property_logs')
        ->select(DB::raw("CONCAT(personneldb.tbl_user.NAME_F,' ',personneldb.tbl_user.NAME_L) AS fullname"),
        "inventorydb.inventory.id as id","inventorydb.inventory.property_number as propnumber","inventorydb.property_logs.received_date as receiveddate",
        "inventorydb.property_logs.registered_status as regstatus","inventorydb.property_logs.assigned_to as assigned","inventorydb.property_logs.temp_name as tempname",
        "inventorydb.property_logs.status as status","inventorydb.property_logs.attachment as attachment","inventorydb.property_logs.remarks as remarks")
        ->leftJoin('inventory', 'inventory.id', '=', 'property_logs.id_inventory')
        ->leftJoin('personneldb.tbl_user', 'personneldb.tbl_user.EMP_NO', '=', 'inventorydb.property_logs.assigned_to')
        ->get()
        ->toArray();

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
        //->with('location',$location)
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
        $received_date = $request->received_date;

        //Inventory Logs
        $propertynumber = $request->propertynumber;
        
        //Property
        $statusid = $request->statusid;
        $assignedto = $request->assignedto;
        //$location = $request->location;
        $remarks = $request->remarks;
        $tempname = $request->tempname;
        $registered = $request->registered;
        $attachment = $request->attachment;

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

                    //'location.required' => "Location is Required",
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

                    //'location' => 'required',
                    //'remarks' => 'required',
                    //'tempname' => 'required',

                    'registered' => 'required',
                ];

                $validate =  Validator::make($request->all(),$rules,$messages);

                if($validate->fails()){

                    return redirect()->back()->withErrors($validate->messages())->withInput();
                }
                else {

                            //file attachment processed
                            if($attachment == ""){
                                $fileName = $attachment;
                            }
                            else {
                                $fileName = $attachment->getClientOriginalName();
                                $destinationPath = public_path().'/attachments' ;
                                $attachment->move($destinationPath,$fileName);
                            }
                          //file attachment processed end

                    $datainventorycreate=array('id_article'=>$articleid,'description'=>$description,'date_acquired'=>$date_acquired,
                    'property_number'=>$propertynumber, 'quantity'=>$unitofmeasure,'unit_value'=>$unitvalue,
                    'received_date'=>$received_date,'registered_status'=>$registered,'assigned_to'=>$assignedto,'temp_name'=>"",
                    'status'=>$statusid,'attachment'=>$fileName,'remarks'=>$remarks,
                    );
                    DB::table('inventory')->insertOrIgnore($datainventorycreate);


                    return redirect()->route('acquired.index')
                                    ->with('success','Inventory created successfully.');
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

                    //'location.required' => "Location is Required",
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

                    //'location' => 'required',
                    //'remarks' => 'required',
                    'tempname' => 'required',

                    'registered' => 'required',
                ];

                $validate =  Validator::make($request->all(),$rules,$messages);

                if($validate->fails()){

                    return redirect()->back()->withErrors($validate->messages())->withInput();
                }
                else {

                   //file attachment processed
                        if($attachment == ""){
                            $fileName = $attachment;
                        }
                        else {
                            $fileName = $attachment->getClientOriginalName();
                            $destinationPath = public_path().'/attachments' ;
                            $attachment->move($destinationPath,$fileName);
                        }
                    //file attachment processed end

                    $datainventorycreate=array('id_article'=>$articleid,'description'=>$description,'date_acquired'=>$date_acquired,
                    'property_number'=>$propertynumber, 'quantity'=>$unitofmeasure,'unit_value'=>$unitvalue,
                    'received_date'=>$received_date,'registered_status'=>$registered,'assigned_to'=>"",'temp_name'=>$tempname,
                    'status'=>$statusid,'attachment'=>$fileName,'remarks'=>$remarks,
                    );
                    DB::table('inventory')->insertOrIgnore($datainventorycreate);


                    return redirect()->route('acquired.index')
                                    ->with('success','Inventory created successfully.');
                }

        }

        else{

                $messages =
                [
                    'registered.required' => 'Please Input the Necessary Information',
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

        $transfermodalattachment = $request->transfermodalattachment;
       

        /*$datainventory=array('property_id'=>$propertytransferid,'received_date'=>$transmodaltransferred_date,'location'=>$transmodallocation,
        'registered_status'=>$transmodalregistered,'assigned_to'=>$transmodalassignedto,'temp_name'=>$transmodaltempname,'status'=>$transmodalstatusid,'remarks'=>$transmodalremarks);
        DB::table('property_logs')->insertOrIgnore($datainventory);*/

        $datas = DB::table('inventory')
        ->where('id',$propertytransferid)
        ->first();

        $datasproperty_id = $datas->id;
        //$datasinventory_id = $datas->id_inventory;
        $datasreceived_date = $datas->received_date;
        //$dataslocation = $datas->location;
        $datasregistered_status = $datas->registered_status;
        $datasassigned_to = $datas->assigned_to;
        $datastemp_name = $datas->temp_name;
        $datasstatus = $datas->status;
        $datasattachment = $datas->attachment;
        $datasremarks = $datas->remarks;

        $datainventory=array('id_inventory'=>$datasproperty_id,'received_date'=>$datasreceived_date,'registered_status'=>$datasregistered_status,
        'assigned_to'=>$datasassigned_to,'temp_name'=>$datastemp_name,'status'=>$datasstatus,'attachment'=>$datasattachment,'remarks'=>$datasremarks);
        DB::table('property_logs')->insertOrIgnore($datainventory);

                //file attachment processed
                    if($transfermodalattachment == ""){
                    $fileName = $transfermodalattachment;
                    }
                    else {
                        $fileName = $transfermodalattachment->getClientOriginalName();
                        $destinationPath = public_path().'/attachments' ;
                        $transfermodalattachment->move($destinationPath,$fileName);
                    }
                //file attachment processed end

        DB::table('inventory')
            ->where('id', $propertytransferid)
            ->update(['received_date' => $transmodaltransferred_date,
                      //'id_location'=>$transmodallocation,
                      'registered_status'=>$transmodalregistered,
                      'assigned_to'=>$transmodalassignedto,
                      'temp_name'=>$transmodaltempname,
                      'status'=>$transmodalstatusid,
                      'attachment' => $fileName,
                      'remarks'=>$transmodalremarks,
                    ]);

        //print_r($datainventory);
        return redirect()->route('acquired.index')
                        ->with('success','Inventory created successfully.');

    }

    public function edit($id)
    {
        $displayproperty = DB::table('inventory')
        ->select("inventory.id as id","inventorydb.category.code as code","category.category_name as category","article.id as articleid","article.article as article",
        "inventory.description as description","inventory.quantity as unitmeasure","inventory.unit_value as value",
        "inventory.date_acquired as date_acquired","inventory.property_number as propertynumber","inventory.received_date as received_date",
        "inventory.status as status","inventory.assigned_to as assigned_to","inventory.remarks as remarks","inventory.attachment as attachment",
        "inventory.temp_name as tempname","inventory.registered_status as registeredstatus")
        ->leftJoin('article', 'article.id', '=', 'inventory.id_article')
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->where('inventory.id',$id)
        ->get();

        $displayarticle = DB::table('article')
        ->select("article.id as id","article.code as codes","article.article as article","category.code as code","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->get();

        $displayemployee = DB::connection('mysql2')
        ->table('tbl_user')
        ->select("EMP_NO as id",DB::raw("CONCAT(NAME_F,' ',NAME_L) AS fullname"))
        ->get();

        return view('acquired.edit',
        [
            'displayproperty'=>$displayproperty,
            'displayarticle'=>$displayarticle,
            'displayemployee' => $displayemployee
        ]
        );
    }

    public function update(Request $request,$id)
    {
        $editarticleid = $request->editarticleid;
        $editregistered = $request->editregistered;
        $editassignedto = $request->editassignedto;
        $edittempname = $request->edittempname;
        $editdescription = $request->editdescription;
        $editdate_acquired = $request->editdate_acquired;
        $editpropertynumber = $request->editpropertynumber;
        $editunitofmeasure = $request->editunitofmeasure;
        $editunitvalue = $request->editunitvalue;
        $editstatusid = $request->editstatusid;
        $editremarks = $request->editremarks;
        $editreceived_date = $request->editreceived_date;

        $editattachment = $request->editattachment;


        /*$request->validate([
            'categoryid' => 'required',
            //'code' => 'required',
            'article' => 'required',
        ]);*/
        if($editattachment == ""){
        DB::table('inventory')
        ->where('id', $id)
        ->update(['id_article' => $editarticleid,
                  'description'=>$editdescription,
                  'date_acquired'=>$editdate_acquired,
                  'property_number'=>$editpropertynumber,
                  'quantity'=>$editunitofmeasure,
                  'unit_value'=>$editunitvalue,
                  'received_date'=>$editreceived_date,
                  'registered_status'=>$editregistered,
                  'assigned_to'=>$editassignedto,
                  'temp_name'=>$edittempname,
                  'status'=>$editstatusid,
                  'remarks'=>$editremarks,
                ]);
    
        return redirect()->route('acquired.index')
                        ->with('success','Inventory updated successfully');
        }

        else {

             //file attachment processed
             $fileName = $editattachment->getClientOriginalName();
             $destinationPath = public_path().'/attachments' ;
             $editattachment->move($destinationPath,$fileName);

            DB::table('inventory')
             ->where('id', $id)
             ->update(['id_article' => $editarticleid,
                        'description'=>$editdescription,
                        'date_acquired'=>$editdate_acquired,
                        'property_number'=>$editpropertynumber,
                        'quantity'=>$editunitofmeasure,
                        'unit_value'=>$editunitvalue,
                        'received_date'=>$editreceived_date,
                        'registered_status'=>$editregistered,
                        'assigned_to'=>$editassignedto,
                        'temp_name'=>$edittempname,
                        'status'=>$editstatusid,
                        'attachment'=>$fileName,
                        'remarks'=>$editremarks,
                        ]);
            
                return redirect()->route('acquired.index')
                                ->with('success','Inventory updated successfully');
        }
    }
    public function deactivate($id)
    {
        DB::table('inventory')
        ->where('id', $id)
        ->update(['in_status' => 0,
                ]);
    
        return redirect()->route('acquired.index')
                        ->with('success','Inventory deleted successfully');
    }
}
