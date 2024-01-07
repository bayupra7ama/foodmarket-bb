<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class food extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'ingredient',
        'price','types', 'rate','picturePath'
    ];

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    //untuk sesuatu
    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }

    public function toArray(){
        $toArray = parent::toArray();
        $toArray['picturePath']= $this->picturePath;
        return $toArray;
    }
    public function getPicturePathAttribute()
    {
        return config('app.url') . \Illuminate\Support\Facades\Storage::url($this->attributes['picturePath']);
    }
}
