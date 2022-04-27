<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
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
     */
    public function index()
    {
        $displayinventory = DB::table('inventory')
        ->select("inventory.id as id","category.category_name as categoryname","article.article as article","inventory.description as description",
        "inventory.date_acquired as date_acquired","inventory.unit_of_measure as unit_of_measure","inventory.unit_value as unitvalue",
        "inventory.status as status","inventory.type as type")
        ->leftJoin('article', 'article.id', '=', 'inventory.id_article')
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->where('inventory.inputted','=',0)
        ->get();

        return view('property.index',
        [
            'displayinventory' => $displayinventory
            ]
        );
    }

    public function propertystore(Request $request)
    {
        $colidinventory = $request->colidinventory;
        $txtserialdata= implode(",", $request->txtserialdata);
        $txtserialdataarray = explode(',', $txtserialdata); 
        $txtpropertydata= implode(",", $request->txtpropertydata);
        $txtpropertydataarray = explode(',', $txtpropertydata); 
        $txtdaterequiredata= implode(",", $request->txtdaterequiredata);
        $txtdaterequiredataarray = explode(',', $txtdaterequiredata); 
        $txtremarksdata= implode(",", $request->txtremarksdata);
        $txtremarksdataarray = explode(',', $txtremarksdata); 

        $count = 0;

        $request->validate([
            'txtserialdata' => 'required',
            'txtpropertydata' => 'required',
            'txtdaterequiredata' => 'required',
            'txtremarksdata' => 'required',
        ]);

        foreach($txtserialdataarray as $txtserialdataarraykey => $txtserialdataarrayvalue){
            $data=array("id_inventory"=>$colidinventory,"serial_number"=>$txtserialdataarray[$count],"property_number"=>$txtpropertydataarray[$count],
            "remarks"=>$txtremarksdataarray[$count],"date_created"=>$txtdaterequiredataarray[$count]);
            DB::table('inventory_logs')->insertOrIgnore($data);
    
            $count++;
            }

            DB::table('inventory')
            ->where('id', $colidinventory)
            ->update(['inputted' => 1]);
    
            
            return redirect()->route('property.index')
                        ->with('success','Property created successfully.');

    }
}
