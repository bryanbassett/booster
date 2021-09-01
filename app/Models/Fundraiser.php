<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fundraiser extends Model
{
    use HasFactory;
    protected $table = 'fundraisers';
    protected $appends = ['averageReviews','reviewedAlready'];

    public function reviews(){
        return $this->hasMany(Review::class,'fundraiser_id','id');
    }
    public function getAverageReviewsAttribute(){
        return $this->reviews->avg('rating') ?? 0;
    }
    public function getReviewedAlreadyAttribute(){
        return $this->reviews->where('user_id',Auth::id())->first() ? true : false;
    }
}
