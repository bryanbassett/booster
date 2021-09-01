<?php

namespace Tests\Unit;

use App\Models\User;
use Carbon\Carbon;
use App\Models\Fundraiser;
use App\Models\Review;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {

        User::factory(1)->create();
        $user =  User::orderBy('created_at','desc')->first();
        $user->email_verified_at = Carbon::today();
        $user->save;
        $userId = $user->id;
        var_dump($userId);
        $fundraiser = Fundraiser::create(['fundraiser_title'=>'test'.rand(10,100).rand(10,100),'fundraiser_description'=>'description','user_id'=>$userId]);
        var_dump($fundraiser->id);
        $review = Review::create(['review_text'=>'test','rating'=>3,'user_id'=>$userId,'fundraiser_id'=>$fundraiser->id]);
        var_dump($review->id);
        $this->assertTrue($review->id==true);
        $error = '';
        try{
            $review = Review::create(['review_text'=>'test','rating'=>3,'user_id'=>$userId,'fundraiser_id'=>$fundraiser->id]);
        }catch(\Exception $e){
            $error = $e->getMessage();
        }

        var_dump($review->id);
        $originalReviewId = $review->id;
        $this->assertTrue($review->id!=true || $error!='');

        $review->delete();
        if($originalReviewId!=$review->id){
            Review::find($review->id)->delete();
        }
        $fundraiser->delete();
        $user->delete();

    }

}
