<?php

namespace App\Http\Controllers;

use App\Models\Fundraiser;
use Illuminate\Http\Request;

class FundraiserController extends Controller
{
    public function listFundraisers(){
        return json_encode(Fundraiser::get()->toArray());
    }
}
