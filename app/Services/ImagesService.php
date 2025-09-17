<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
/** عملت سيرفس للصور عشان اتمكن من توسيع الكود لو بدي اضيف صور تانية لاشياء تانية غير الاخبار ميثود للحدف وميثود للتخزين
 *  بحيث يخزن او يحدف الصور من الدسك 
 * والمرحلة التانية يحدفها او يخزنها من جدول الimages
 */
class ImagesService{

    public static function storeImage(array $files,$news)
    {
        foreach($files as $file){
            $path= $file->store('news','public');
            $news->images()->create(['path'=>$path,'alt_txt'=>'news Photo']);
        }
        return true;
    }
    public static function deleteImage($news)
    {
        foreach($news->images as $image){
            Storage::disk('public')->delete($image->path);
             $image->delete();
        }       
        return true;
    }
}