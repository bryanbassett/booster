<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable=['user_id','fundraiser_id','rating','review_text'];
    public function fundraiser(){
        return $this->belongsTo(Fundraiser::class,'fundraiser_id','id');
    }

}
