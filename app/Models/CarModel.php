<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $table = 'models';
    protected $fillable = ['name', 'brand_id','fuel_id','category_id'];



    public function brand() {

        return $this->hasOne(Brand::class,'brand_id');
    }
    public function category(){
        return $this->hasOne(Categorie::class,'category_id');
    }
    public  function fuel(){
       return   $this -> hasOne(fuel::class,'fuel_id');
    }
}
