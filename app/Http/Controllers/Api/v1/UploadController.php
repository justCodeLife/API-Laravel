<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function image(Request $request, Filesystem $filesystem)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,bmp,png|max:10240'
        ]);

        $file = $request->file('image');

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $imagePath = "/upload/images/{$year}/{$month}/{$day}";
        $filename = $file->getClientOriginalName();

        if ($filesystem->exists(public_path("{$imagePath}/{$filename}"))) {
            $filename = Carbon::now()->timestamp . "-{$filename}";

        }

        $file->move(public_path($imagePath), $filename);
        return response([
            'data' => ['image-url' => url("{$imagePath}/{$filename}")],
            'status' => 'success'
            ]);

    }
}
