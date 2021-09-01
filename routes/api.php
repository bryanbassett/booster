<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FundraiserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Fundraiser;
use App\Models\Review;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/getMyStuff', function (Request $request) {
    $userId=Auth::id();
    $reviews = Review::with('fundraiser')->where('user_id',$userId)->get();
    $fundraisers = Fundraiser::where('user_id',$userId)->get();
    return View::make('myStuff',['reviews'=>$reviews,'fundraisers'=>$fundraisers]);
});


//fundraiser controller
Route::get('/listFundraisers', [FundraiserController::class, 'listFundraisers']);
Route::middleware('auth:sanctum')->get('/alreadyReviewed', [FundraiserController::class, 'checkIfUserAlreadyReviewed']);
Route::middleware('auth:sanctum')->post('/createFundraiser', [FundraiserController::class, 'store']);
//review controller
Route::middleware('auth:sanctum')->post('/createReview',[ReviewController::class,'store']);
Route::get('/reviewsForFundraiser', [ReviewController::class, 'listAllReviewsForFundraiser']);
