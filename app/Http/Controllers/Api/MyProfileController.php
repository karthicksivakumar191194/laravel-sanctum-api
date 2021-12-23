<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyProfileController extends Controller
{
    public function myProfile(Request $request){
        $myDetails = Auth::user();

        $response = [
            'details' => $myDetails,
        ];

        return response($response);

    }
}
