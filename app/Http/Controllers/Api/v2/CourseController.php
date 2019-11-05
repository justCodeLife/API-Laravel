<?php

namespace App\Http\Controllers\Api\v2;

use App\Course;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\v2\CourseCollection;
use App\Http\Resources\v2\Course as CourseResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(4);
        return new CourseCollection($courses);
    }

    public function single(Course $course)
    {
        return new CourseResource($course);
    }

}
