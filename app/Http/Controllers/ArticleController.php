<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
  
class ArticleController extends Controller
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
        $displaycategory = DB::table('category')
        ->select('id','category_name')
        ->get();

        $displayarticle = DB::table('article')
        ->select("article.code as code","article.article as article","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->get();

       
        return view('articles.index',[
                'displaycategory' => $displaycategory,
                'displayarticle' => $displayarticle
            ]
        );
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }
    
    public function categorystore(Request $request)
    {
        $categoryname = $request->categoryname;

        $request->validate([
            'categoryname' => 'required',
        ]);
    
        $data=array('category_name'=>$categoryname);
        DB::table('category')->insertOrIgnore($data);
     
        return redirect()->route('articles.index')
                        ->with('success','Category created successfully.');
    }

    public function articlestore(Request $request)
    {
        $articlecode = $request->articlecode;
        $articlename = $request->articlename;
        $categoryid = $request->categoryid;

        $request->validate([
            'articlecode' => 'required',
            'articlename' => 'required',
            'categoryid' => 'required',
        ]);
    
        $data=array('code'=>$articlecode,'article'=>$articlename,'category_id'=>$categoryid);
        DB::table('article')->insertOrIgnore($data);
     
        return redirect()->route('articles.index')
                        ->with('success','Article created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('articles.show',compact('product'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('articles.edit',compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('articles.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('articles.index')
                        ->with('success','Product deleted successfully');
    }
}