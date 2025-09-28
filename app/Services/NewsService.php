<?php

namespace App\Services;

use App\Models\News;

use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class NewsService
{
    public static function  store(array $data) {
        
        $data['user_id']=Auth::user()->id;
        $data['content']=Purifier::clean($data['content']);
        $news =News::create($data);
        ImagesService::storeImage($data['images'],$news);
        return $news;
    }
 
}
