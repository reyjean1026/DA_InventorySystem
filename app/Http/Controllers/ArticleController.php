<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
  
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
    public function index(Request $request)
    {
        $categoryname = $request->categoryname;

        $articlecode = $request->articlecode;
        $articlename = $request->articlename;
        $categoryid = $request->categoryid;

        $displaycategory = DB::table('category')
        ->select('id','category_name')
        ->where('status',1)
        ->get();

        $displayarticle = DB::table('article')
        ->select("article.id as id","article.code as code","article.article as article","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->where('article.status',1)
        ->get();

       
        return view('articles.index',[
                'displaycategory' => $displaycategory,
                'displayarticle' => $displayarticle
            ]
        )
        ->with('categoryname',$categoryname)
        ->with('articlecode',$articlecode)
        ->with('articlename',$articlename)
        ->with('categoryid',$categoryid)
        ;
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

        $messages =
        [
            'categoryname.required' => "Category Name is Required",
        ];

        $rules = [
            'categoryname' => 'required',
        ];

        $validate =  Validator::make($request->all(),$rules,$messages);

        if($validate->fails()){

            return redirect()->back()->withErrors($validate->messages())->withInput();
        }
        else {

            $data=array('category_name'=>$categoryname);
            DB::table('category')->insertOrIgnore($data);
         
            return redirect()->route('articles.index')
                            ->with('success','Category created successfully.');
        }
       
    }

    public function articlestore(Request $request)
    {
        $articlecode = $request->articlecode;
        $articlename = $request->articlename;
        $categoryid = $request->categoryid;

        /*$request->validate([
            'categoryid' => 'required',
            'articlecode' => 'required',
            'articlename' => 'required',
        ]);*/

        $messages =
        [
            'categoryid.required' => "Category Name is Required",
            'articlecode.required' => "Article Code is Required",
            'articlename.required' => "Article Name is Required"
        ];

        $rules = [
            'categoryid' => 'required',
            'articlecode' => 'required',
            'articlename' => 'required',
        ];

        $validate =  Validator::make($request->all(),$rules,$messages);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate->messages())->withInput();
        }
        else {
        $data=array('code'=>$articlecode,'article'=>$articlename,'category_id'=>$categoryid);
        DB::table('article')->insertOrIgnore($data);
     
        return redirect()->route('articles.index')
                        ->with('success','Article created successfully.');
        }
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
    public function edit($id)
    {
        $editdisplayarticle = DB::table('article')
        ->select("article.id as id","category.id as catid","article.code as code","article.article as article","category.category_name as categoryname")
        ->leftJoin('category', 'category.id', '=', 'article.category_id')
        ->where('article.id',$id)
        ->get();

        $displaycategory = DB::table('category')
        ->select('id','category_name')
        ->where('status',1)
        ->get();

        return view('articles.edit',
        [
            'editdisplayarticle'=>$editdisplayarticle,
            'displaycategory' => $displaycategory
        ]
        );
    }

    public function editcategory($id)
    {
        $editdisplaycategory = DB::table('category')
        ->select("id","category_name")
        ->where('id',$id)
        ->get();

        return view('articles.editcategory',
        [
            'editdisplaycategory'=>$editdisplaycategory
        ]
        );
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $code = $request->code;
        $article = $request->article;
        $categoryid = $request->categoryid;


        $request->validate([
            'categoryid' => 'required',
            //'code' => 'required',
            'article' => 'required',
        ]);
    
        DB::table('article')
        ->where('id', $id)
        ->update(['code' => $code,
                  'article'=>$article,
                  'category_id'=>$categoryid,
                ]);
    
        return redirect()->route('articles.index')
                        ->with('success','Article updated successfully');
    }

    public function updatecategory(Request $request,$id)
    {
        $category_name = $request->category_name;


        $request->validate([
            'category_name' => 'required',
        ]);
    
        DB::table('category')
        ->where('id', $id)
        ->update(['category_name' => $category_name,
                ]);
    
        return redirect()->route('articles.index')
                        ->with('success','Category updated successfully');
    }
    
    public function deactivate($id)
    {
        DB::table('article')
        ->where('id', $id)
        ->update(['status' => 0,
                ]);
    
        return redirect()->route('articles.index')
                        ->with('success','Article deleted successfully');
    }
    public function deactivatecategory($id)
    {
        DB::table('category')
        ->where('id', $id)
        ->update(['status' => 0,
                ]);
    
        return redirect()->route('articles.index')
                        ->with('success','Category deleted successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('category')
        ->where('id', $id)
        ->update(['status' => 0,
                ]);
    
        return redirect()->route('articles.index')
                        ->with('success','Product deleted successfully');
    }
}