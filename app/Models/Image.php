<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = ['path','alt_txt'];
    public function imagable() {
        return $this->morphto();
        
    }
    
}
