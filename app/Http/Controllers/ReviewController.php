<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $fundraiserId = $request->fundraiserId;
        if(Review::where('user_id',$userId)->where('fundraiser_id',$fundraiserId)->exists()){
            return response('You already reviewed this fundraiser.');
        };
        Review::create([
            'user_id'=>$userId,
            'fundraiser_id'=>$fundraiserId,
            'rating'=>$request->rating,
            'review_text'=>$request->reviewText
                       ]);
        return response('Review saved.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
