<?php
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function showarticle(){

        $displayarticle = DB::table('article')
        ->select("article.id as id","article.code as code","article.article as article","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->where('article.status',1)
        ->get();

        return response()->json($displayarticle);


    }
}
