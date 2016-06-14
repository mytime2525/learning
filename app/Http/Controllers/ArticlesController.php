<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests;
use Carbon\Carbon;
// use Request;

class ArticlesController extends Controller
{
    /**
     * @return mixed
     */
    public function __construct()
    {
        $this->middleware('auth',['only' => 'create']);
    }

    public function index()
    {

    	$articles = Article::latest('published_at')->published()->get();
    	return view('articles.index',compact('articles'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Article $articles)
    {
     //    dd($id);
    	// $articles = Article::findOrFail($id);
        
    	return view('articles.show',compact('articles'));
    }
    public function create()
    {
        if(\Auth::guest())
        {
            return redirect('articles');
        }
    	return view('articles.create');
    }

    public function store(ArticleRequest $request)
    {
    	// $input['published_at'] = Carbon::now();
        // Auth::user(); 
        // // Article::create($request->all());
        \Auth::user()->articles()->create($request->all());
       session()->flash('flash_message','Your article has been created!');
       session()->flash('flash_message_important',true);
       flash('Your article has been created!')->important();
    	// return redirect('articles')->with([
     //        'flash_message' => 'Your article has been created!',
     //        'flash_message_important' => true
     //    ]);
        return redirect('articles');
    }

    public function edit(Article $article)
    {
        return view('articles.edit',compact('article'));
    }

    public function update(Article $article,ArticleRequest $request)
    {
        // $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect('articles');
    }
}
