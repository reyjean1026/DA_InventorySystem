<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
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
    public function index(Request $request)
    {

        $calculatesrpcppe = DB::table('inventory')
        ->select("category.category_name as category_name",DB::raw("SUM(inventory.quantity*inventory.unit_value) as Total"))
        ->leftJoin('article', 'article.id', '=', 'inventory.id_article')
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->where('inventory.in_status',1)
        ->where('inventory.status','SERVICIABLE')
        ->groupBy("category.category_name")
        ->get()
        ->toArray();
       
      return view('reports.srpccppe',[
        'calculatesrpcppe' => $calculatesrpcppe]);
    
    }

    public function index1(Request $request)
    {

      $maincategory = DB::table('inventory')
      ->select("category.id as id","category.category_name","category.code as code")
      ->leftJoin('article', 'article.id', '=', 'inventory.id_article')
      ->leftJoin('category', 'category.id', '=', 'article.category_id')
      ->where('inventory.in_status',1)
      ->where('inventory.status','SERVICIABLE')
      ->groupBy('inventorydb.category.id')
      ->get()->toArray();

      $subcategory = DB::table('inventorydb.inventory')
      ->select("inventorydb.category.id as catid","personneldb.main_employment_profile.EMP_NO as empid","inventorydb.article.article as article",
      "inventorydb.inventory.description as description","inventorydb.inventory.date_acquired as date_acquired","inventorydb.inventory.property_number as property_number",
      "inventorydb.inventory.quantity as quantity","inventorydb.inventory.unit_value as unitvalue","inventorydb.inventory.status as status",
        DB::raw("CONCAT(personneldb.tbl_user.NAME_F,' ',personneldb.tbl_user.NAME_L) AS fullname"),"inventorydb.inventory.temp_name as temp_name","inventorydb.inventory.remarks as remarks")
      ->leftJoin('personneldb.tbl_user', 'inventorydb.inventory.assigned_to', '=', 'personneldb.tbl_user.EMP_NO')
      ->leftJoin('personneldb.main_employment_profile', 'personneldb.tbl_user.EMP_NO', '=', 'personneldb.main_employment_profile.EMP_NO')
      ->leftJoin('inventorydb.article', 'inventorydb.article.id', '=', 'inventorydb.inventory.id_article')
      ->leftJoin('inventorydb.category', 'inventorydb.category.id', '=', 'inventorydb.article.category_id')
      ->where('inventorydb.inventory.in_status',1)
      ->where('inventory.status','SERVICIABLE')
      //->groupBy('inventorydb.category.id','personneldb.main_employment_profile.DivisionDesc')
      ->get()->toArray();
       
      return view('reports.rpcppe',[
        'maincategory' => $maincategory,
        'subcategory' => $subcategory]);
    
    }

    public function indexunserviciable(Request $request)
    {

      $maincategory = DB::table('inventory')
      ->select("category.id as id","category.category_name","category.code as code")
      ->leftJoin('article', 'article.id', '=', 'inventory.id_article')
      ->leftJoin('category', 'category.id', '=', 'article.category_id')
      ->where('inventory.in_status',1)
      ->where('inventory.status','!=','SERVICIABLE')
      ->groupBy('inventorydb.category.id')
      ->get()->toArray();

      $subcategory = DB::table('inventorydb.inventory')
      ->select("inventorydb.category.id as catid","personneldb.main_employment_profile.EMP_NO as empid","inventorydb.article.article as article",
      "inventorydb.inventory.description as description","inventorydb.inventory.date_acquired as date_acquired","inventorydb.inventory.property_number as property_number",
      "inventorydb.inventory.quantity as quantity","inventorydb.inventory.unit_value as unitvalue","inventorydb.inventory.status as status",
        DB::raw("CONCAT(personneldb.tbl_user.NAME_F,' ',personneldb.tbl_user.NAME_L) AS fullname"),"inventorydb.inventory.temp_name as temp_name","inventorydb.inventory.remarks as remarks")
      ->leftJoin('personneldb.tbl_user', 'inventorydb.inventory.assigned_to', '=', 'personneldb.tbl_user.EMP_NO')
      ->leftJoin('personneldb.main_employment_profile', 'personneldb.tbl_user.EMP_NO', '=', 'personneldb.main_employment_profile.EMP_NO')
      ->leftJoin('inventorydb.article', 'inventorydb.article.id', '=', 'inventorydb.inventory.id_article')
      ->leftJoin('inventorydb.category', 'inventorydb.category.id', '=', 'inventorydb.article.category_id')
      ->where('inventorydb.inventory.in_status',1)
      ->where('inventory.status','!=','SERVICIABLE')
      //->groupBy('inventorydb.category.id','personneldb.main_employment_profile.DivisionDesc')
      ->get()->toArray();
       
      return view('reports.rpcppe',[
        'maincategory' => $maincategory,
        'subcategory' => $subcategory]);
    
    }
     
}
