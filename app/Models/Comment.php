<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=['content','news_id','parent_id','user_id'];

    public function news(){

        return $this->belongsTo(news::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function children()
    {
       
        return $this->hasMany(Comment::class, 'parent_id', 'id')
                    ->orderBy('created_at', 'asc');
                  
    }
}
