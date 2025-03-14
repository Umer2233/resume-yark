<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use App\NavbarButton;
use Session;
class PagesController extends Controller
{
    /**
     * index()
     *
     * @return void Return Home Page
     */
    public function index()
    {
        $FieldTips = DB::table('field_tips')->where([['field', 'termsCheckbox'],['page','StartResume']])->first();
        $tick_tip = $FieldTips->tip;
        return view('frontend.pages.index',['tick_tip'=> $tick_tip]);
    }

    public function savePage(Request $request)
    {
        
        $Page = $request->input('Page');
        $yak_user_id = $request->session()->get('yak_user_id');
        try {
            // session()->put('education','true');
            Session::put('education', 'true');
            // $btn = NavbarButton::first();
            // $btn->education = 'true';
            // $btn->save();
            $user_object = DB::table('users')->where('id', $yak_user_id)->select(['page'])->get();
            if($user_object[0]->page < $Page) {
                DB::table('users')->where('id', $yak_user_id)->update(['page' => $Page]);
            }
            return response()->json(["status" => 1, "message" => ""]);
        } catch (Exception $ex) {
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
        }
    }
}