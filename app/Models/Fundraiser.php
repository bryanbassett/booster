<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fundraiser extends Model
{
    use HasFactory;
    protected $table = 'fundraisers';
    protected $with = ['reviews'];
    protected $appends = ['averageRating','reviewedAlready','reviewCount'];

    public function reviews(){
        return $this->hasMany(Review::class,'fundraiser_id','id');
    }
    public function getAverageRatingAttribute(){
        return $this->reviews->avg('rating') ?? 0;
    }
    public function getReviewCountAttribute(){
        return $this->reviews->count() ?? 0;
    }
    public function getReviewedAlreadyAttribute(){
        return $this->reviews->where('user_id',Auth::id())->first() ? true : false;
    }
}
