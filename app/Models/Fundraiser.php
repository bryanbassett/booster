<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    use HasFactory;
    protected $table = 'fundraisers';

    public function reviews(){
        return $this->hasMany(Review::class,'fundraiser_id','id');
    }
}
