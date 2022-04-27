<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RequestController extends Controller
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
    public function index()
    {

        $displayrequest = DB::table('inventory_logs')
        ->select("inventory_logs.id as id","inventory.type as type", "article.article as article",
        "inventory.description as description", "inventory.date_acquired as date_acquired","inventory.unit_of_measure as measure",
        "inventory.unit_value as value","inventory_logs.property_number as property_number","inventory_logs.remarks as remarks",
        "property_transfer.assigned_to as assign")
        ->leftJoin('inventory', 'inventory.id', '=', 'inventory_logs.id_inventory')
        ->leftJoin('article', 'article.id', '=', 'inventory.id_article')
        ->leftJoin('property_transfer', 'inventory_logs.id', '=', 'property_transfer.id_inventory')
        ->whereNull('property_transfer.assigned_to')
        ->get();

        return view('request.index',
        [
            'displayrequest' => $displayrequest
            ]
        );

    }
}
