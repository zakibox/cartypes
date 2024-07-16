<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\MediaLibrary\HasMedia;

class Brand extends Model 
{
    use HasFactory;
    protected $fillable = ['name', 'img'];
}
