<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Services\NewsUserService;


class UserNewsController extends Controller
{

    public function index(){

        $last_news=NewsUserService::lastNews()->take(3)->get();
        $categorise=Category::all();
        $all_news=[];
        foreach($categorise as $cat){
            $cat_news=NewsUserService::catNews($cat->id)->take(3)->get();
            $cat_name=$cat->name;
            $all_news[]=['name'=>$cat_name,'news'=>$cat_news];        
        }
       
        return response()->view('user-flow.welcome-user',['last_news'=>$last_news,'all_news'=>$all_news]);
    }
    public function newsByCat($cat_id){

        $category= Category::findOrFail($cat_id);
        $news= NewsUserService::catNews($cat_id)
                ->paginate(5)
                ->withPath(route('user-view.showByCat', $cat_id)) 
                ->withQueryString();
          
        return response()->view('user-flow.all-news-by-cat',['news'=>$news,'category'=>$category]);
    }
    public function show($id){

        $news=News::findOrFail($id);
        $news->load(['images','comments'=>function($q){
            $q->with('children')->whereNull('parent_id')->latest();
        }]);        
        return response()->view('user-flow.user-flow-newsDetails',['news'=>$news]);
    }
  
}
