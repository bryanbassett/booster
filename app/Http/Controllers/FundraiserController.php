<?php

namespace App\Http\Controllers;

use App\Models\Fundraiser;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundraiserController extends Controller
{
    public function listFundraisers(){
        return json_encode(Fundraiser::with('reviews')->get()->sortBy([ ['averageRating', 'desc']])->toArray());
    }

    //not necessary but extra validation just in case page hadnt refreshed since review (should be instant but you never know)
    public function checkIfUserAlreadyReviewed(){
        $reviewed = Review::where('fundraiser_id',request()->input('fundraiserId'))->where('user_id',Auth::id())->exists();
        if($reviewed){
            return 1;
        }else{
            return 0;
        }
    }
}
