<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\storeNewsRequest;
use App\Mail\NewsPublishedMail;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use App\Services\NewsService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    //
    public function index(){
        
       $news= News::with('images')->latest('created_at')->paginate(4);
       
       return response()->view('cms.news.read-all-news',['data'=>$news]);
        
    }
    public function create(){

        $cat=Category::all();
        return response()->view('cms.news.create',['category'=>$cat]);
        
    }public function store(storeNewsRequest $request){

        $data=$request->validated();
        $result=NewsService::store($data);
        return response()->json(['message'=>$result?'created':'error'],  
        $result?Response::HTTP_CREATED:Response::HTTP_BAD_REQUEST);
        
    }public function update(){
        
        
    }public function show($news){

        $news =News::findOrFail($news);
            $news->load(['images','comments']);
                   
            
        return response()->view('cms.news.read-detailes',['news'=>$news]);
        
    }
    public function edit(){
        
    }
    public function destroy($id){

    $news=News::findOrfail($id);

       $affected_rows= $news->delete();

       if($news->images!=null){
        foreach($news->images as $image){
            Storage::disk('public')->delete($image->path);
             $image->delete();
        }
       }
       
       return response()->json(['message'=>$affected_rows>0?'deleted':'error']
       ,$affected_rows>0? 200:Response::HTTP_BAD_REQUEST);

    }
    public function publish ($id){

        $news=News::findOrFail($id);
        if($news->published_at==null){
            $result=$news->update(['published_at'=>now(),'status'=>'published']);
            $users = User::where('role','user')->get();
            foreach($users as $user)
                    Mail::to($user->email)->send(new NewsPublishedMail($news));

        }
        else
        {
            return response()->json(['message'=>'already published'], Response::HTTP_BAD_REQUEST);

        }
        return response()->json(['message'=>$result?'successfully published':'error'],
        $result?200:Response::HTTP_BAD_REQUEST);
    }
    public function archive($id){
        
        $news=News::findOrFail($id);
        if($news->status=='archived'){

            $result=$news->update(['status'=>'published']);
            return response()->json(['message'=>$result?'unarchived':'error','button'=>'archive'],
            $result?200:Response::HTTP_BAD_REQUEST);
        }
        elseif($news->status=='published'){

            $result=$news->update(['status'=>'archived']);
            return response()->json(['message'=>$result?'archived':'error','button'=>'unarchive'],
            $result?200:Response::HTTP_BAD_REQUEST);

        }else{
             return response()->json(['message'=>'draft cant be archived'],Response::HTTP_BAD_REQUEST);
        }
    }
}
