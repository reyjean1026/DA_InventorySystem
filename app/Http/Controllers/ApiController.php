<?php
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function showcategory(){

        $displaycategory = DB::table('category')
        ->where('status',1)
        ->get();

        return response()->json($displaycategory);


    }
    
    public function showarticle(){

        $displayarticle = DB::table('article')
        ->select("article.id as id","article.code as code","article.article as article","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->where('article.status',1)
        ->get();

        return response()->json($displayarticle);


    }

    public function showinventory(){

        $displayproperty = DB::table('inventory')
        ->select(DB::raw("CONCAT(personneldb.tbl_user.NAME_F,' ',personneldb.tbl_user.NAME_L) AS fullname"),"personneldb.lib_office.INFO_DIVISION as division",
        "inventorydb.inventory.id as id","inventorydb.category.code as code","inventorydb.category.category_name as category","inventorydb.article.article as article",
        "inventorydb.inventory.description as description","inventorydb.inventory.quantity as unitmeasure","inventorydb.inventory.unit_value as value",
        "inventorydb.inventory.date_acquired as date_acquired","inventorydb.inventory.property_number as propertynumber","inventorydb.inventory.attachment as attachment",
        "inventorydb.inventory.status as status","inventorydb.inventory.assigned_to as assigned_to","inventorydb.inventory.remarks as remarks",
        "inventorydb.inventory.temp_name as tempname","inventorydb.inventory.registered_status as registeredstatus")
        ->leftJoin('inventorydb.article', 'inventorydb.article.id', '=', 'inventorydb.inventory.id_article')
        ->leftJoin('inventorydb.category', 'inventorydb.category.id', '=', 'inventorydb.article.category_id')
        ->leftJoin('personneldb.tbl_user', 'personneldb.tbl_user.EMP_NO', '=', 'inventorydb.inventory.assigned_to')
        ->leftJoin('personneldb.main_employment_profile', 'personneldb.tbl_user.EMP_NO', '=', 'personneldb.main_employment_profile.EMP_NO')
        ->leftJoin('personneldb.lib_office', 'personneldb.main_employment_profile.DivisionCode', '=', 'personneldb.lib_office.ID_DIVISION')
        ->where('inventorydb.inventory.in_status',1)
        //->paginate(25)
        ->get();

        return response()->json($displayproperty);


    }

}





