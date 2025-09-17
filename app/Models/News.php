<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $fillable = ['title', 
                            'description',
                            'content', 
                            'published_at',
                            'category_id',
                            'user_id',
                            'status'];
  
    public function category()
    {
       return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class,'image');
        
    }
    public function comments()
    {
       return $this->hasMany(Comment::class)
                    ->whereNull('parent_id')
                    ->orderBy('created_at', 'asc');
    }
    
    //scope is used to apply public role on every query made on this model 
    //استخدمته عشان اقلل الاستعلامات المتكررة على جزئية حالة النشر وتاريخ النشر واحدث الحالات حيث لن يتم عرض الا اللي حالته منشور فقط
    public function scopePublished($news){
        return $news
            ->where('status','published')
            ->where('published_at','<=',now());
            

    }public function scopeLatestPublished($news){
        return $news
            ->published()
            ->latest('published_at');
          
    }
}
