<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function getTitle(Request $request)
    {
        $title = Title::where('id', $request->title_id)->first();
        return response()->json([
            'title' => $title->title
        ]);
    }
}
