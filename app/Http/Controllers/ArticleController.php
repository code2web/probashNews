<?php

namespace App\Http\Controllers;

use App\Models\Article;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['articles'] = Article::all();
        return view('admin.article.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,jpeg',
            // 'category_id' => 'required',
            // 'district_id' => 'required',
        ]);
        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } 
        else 
        {
            $article = new Article;
            $article->title = $request->title;
            $article->content = $request->content;

            // thumbnail
            if ($request->file('thumbnail')) 
            {
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalName();
                $fileName = time() . '.' .$extension;
                $file->move('storage/article/', $fileName);
                $article->thumbnail = $fileName;
            }
            $article->save();

            // $article->category_id = $request->category_id;
            // $article->district_id = $request->district_id;
            return response()->json([
                'status' => 200,
                'message' => 'Article Created Successfully',
            ]);
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Article $article)
    public function edit($id)
    {
        // $data['article'] = Article::find($article);
        $data['article'] = Article::find($id);
        return view('admin.article.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Article $article)
    public function update(Request $request, $id)
    {
       // dd('hello');
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'mimes:png,jpg,jpeg',
            // 'category_id' => 'required',
            // 'district_id' => 'required',
        ]);
        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } 
        else 
        {
            $article = Article::find($id);
            $article->title = $request->title;
            $article->content = $request->content;

            // thumbnail
            if ($request->file('thumbnail')) 
            {
                $path = 'storage/article/'.$article->thumbnail;
                // dd($path);
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalName();
                $fileName = time() . '.' .$extension;
                $file->move('storage/article/', $fileName);
                $article->thumbnail = $fileName;
            }
            $article->save();

            // $article->category_id = $request->category_id;
            // $article->district_id = $request->district_id;
            return response()->json([
                'status' => 200,
                'message' => 'Article Created Successfully',
            ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Article $article)
    {
        
    }

    // pagination
    public function pagination()
    {
        
    }

    // search
    public function search(Request $request,)
    {
                       
    }

}
