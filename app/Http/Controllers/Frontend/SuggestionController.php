<?php

namespace App\Http\Controllers\Frontend;

use App\FieldSuggestion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function getSingleWordSuggestion(Request $request)
    {
        // $field_suggestion = FieldSuggestion::where('field', 'LIKE', '%' . $request->single_word . '%')->get();
        // return response()->json([
        //     'word' => $field_suggestion
        // ]);

        $field_suggestion = FieldSuggestion::where('field', 'single-word')->get();
        return response()->json([
            'word' => $field_suggestion
        ]);
    }
}
