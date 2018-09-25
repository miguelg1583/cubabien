<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaptchaController extends Controller
{
    public function refresh()
    {
        return response()->json(['captcha'=>captcha_img()]);
    }
}
