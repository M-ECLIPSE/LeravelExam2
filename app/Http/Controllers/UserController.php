<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOtpRequest;
use App\Http\Requests\OtpCodeRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserOtpResource;
use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserStoreRequest $userStoreRequest)
    {
        User::create($userStoreRequest->all());
    }

    public function ChkUser(OtpCodeRequest $otpCodeRequest)
    {
        $user = User::where('mobile',$otpCodeRequest->mobile)->first();
        if ($user)
        {
            $user_Otp = Otp::create([
                'code' =>mt_rand(1000,9999),
                'mobile' => $user->mobile
            ]);
            return response()->json([
                "message" => "",
                "data" => new UserOtpResource($user_Otp)
            ],200);
        }
    }

    public function ChkOtp(CheckOtpRequest $checkOtpRequest)
    {
        $chk_exist_otp = Otp::where('mobile',$checkOtpRequest->mobile)->where('code' , $checkOtpRequest->code)->first();
        if ($chk_exist_otp)
        {
            $chk_exist_otp->delete();
            $user = User::where('mobile' , $checkOtpRequest->mobile)->first();
            $token = $user->createToken("Login".$user->name);
            return response()->json([
                "message" => "done",
                "data" => new UserResource($user),
                "token" => $token->plainTextToken
            ],200);
        }
    }
}
