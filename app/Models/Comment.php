<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=['name','content','news_id','parent_id'];
    public function news(){
        return $this->belongsTo(news::class);
    }
    public function parent (){
        return $this->hasMany(Comment::class,'parent_id');
        
    }public function children(){
        return $this->belongsTo(Comment::class,'parent_id');
    }
}
