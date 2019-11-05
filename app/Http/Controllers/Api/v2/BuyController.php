<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Resources\v1\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyController extends Controller
{
    public function buy(Request $request, Course $course)
    {
        return $course;
    }
}
