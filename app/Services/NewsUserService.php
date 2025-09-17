<?php

namespace App\Services;

use App\Models\News;

class NewsUserService{
    
     public static function lastNews() {
        return News::latestPublished()->with(['category','images']); // اختيارياً
    }
    public static function catNews($id) {
        return News::where('category_id', $id)
                   ->latestPublished()
                   ->with(['category','images']); // اختيارياً
    }
    

}