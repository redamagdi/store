<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OutCome extends Model
{
    protected $table = "out_comes";
    protected $fillable = ['desc','value','date','category_id'];

    public function getCategory(){
        return $this->belongsTo("App\models\Category", "category_id");
    }
}
