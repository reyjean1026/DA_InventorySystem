<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
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
        $displayarticle = DB::table('article')
        ->select("article.id as id","article.code as code","article.article as article","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->get();

        $displayinventory = DB::table('inventory')
        ->select("category.category_name as categoryname","article.article as article","inventory.description as description",
        "inventory.date_acquired as date_acquired","inventory.unit_of_measure as unit_of_measure","inventory.unit_value as unitvalue",
        "inventory.status as status","inventory.type as type")
        ->leftJoin('article', 'article.id', '=', 'inventory.id_article')
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->get();

        return view('inventory.index',[
        'displayarticle' => $displayarticle,
        'displayinventory' => $displayinventory
        ]
        );
    }

    public function inventorystore(Request $request)
    {
        $articleid = $request->articleid;
        $description = $request->description;
        $dateacquired = $request->dateacquired;
        $unitofmeasure = $request->unitofmeasure;
        $unitvalue = $request->unitvalue;
        $status = $request->status;
        $inv_type = $request->inv_type;


        $request->validate([
            'articleid' => 'required',
            'description' => 'required',
            'dateacquired' => 'required',
            'unitofmeasure' => 'required',
            'unitvalue' => 'required',
            'status' => 'required',
            'inv_type' => 'required'
        ]);
    
        $data=array('id_article'=>$articleid,'description'=>$description,
        'date_acquired'=>$dateacquired,'unit_of_measure'=>$unitofmeasure,
        'unit_value'=>$unitvalue,'status'=>$status,'type'=>$inv_type);
        DB::table('inventory')->insertOrIgnore($data);
     
        return redirect()->route('inventory.index')
                        ->with('success','Inventory created successfully.');
    }

     
}
