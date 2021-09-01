<?php

namespace App\Http\Controllers;

use App\Models\Fundraiser;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FundraiserController extends Controller
{
    /**
     * Get list of reviews for fundraiser.
     *
     * @return Response
     */
    public function listFundraisers(){
        return response(json_encode(Fundraiser::with('reviews')->withCount('reviews')->get()->sortBy([['averageRating', 'desc'], ['reviewCount', 'desc']])->toArray()));
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
    public function store(Request $request)
    {
        $userId = Auth::id();
        $title = $request->fundraiserTitle;
        if(Fundraiser::where('fundraiser_title',$title)->exists()){
            return response('A fundraiser with that name already exists.');
        };
        Fundraiser::create([
                           'user_id'=>$userId,
                           'fundraiser_title'=>$title,
                           'fundraiser_description'=>$request->fundraiserDescription,
                       ]);
        return response('Fundraiser created.');

    }
}
