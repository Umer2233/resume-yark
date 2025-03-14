<?php

namespace App\Http\Controllers\Frontend;

use App\Education;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class EducationController extends Controller
{
    function getSchool($school_name)
    {
        //$school_name = $request->session()->get('school_name');
        try {
            $school_object = DB::table('school')->where('name', 'like', "%$school_name%")->where('state_id', '!=', '0')->get();
            if (!$school_object->isEmpty()) {
                return response()->json(["status" => 1, "message" => "", "school" => $school_object]);
            } else {
                return response()->json(["status" => 0, "message" => "Empty"]);
            }
        } catch (Exception $ex) {
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
        }
    }

    function saveEducationHistory(Request $request)
    {

        $School = $request->input('School');
        $City = $request->input('City');
        $State = $request->input('State');
        $Country = $request->input('Country');
        $Degree = $request->input('Degree');
        $OtherDegree = $request->input('OtherDegree');
        $MajorField = $request->input('MajorField');
        $CreditCompleted = $request->input('CreditCompleted');
        $CreditCompletedPhrase = 'Completed ' . $CreditCompleted . ' credits toward degree';
        $master_school_id = $request->input('master_school_id');
        $Month = $request->input('Month');
        $Year = $request->input('Year');
        $Page = $request->input('Page');
        $db_education_id = $request->input('db_education_id');
        $b4_CreditCompleted = $request->input('b4_CreditCompleted');
        $yak_user_id = $request->session()->get('yak_user_id');
        $state_code = 'AL';
        $country_code = 'US';
        
        try {

            if (empty($master_school_id)) {
            $getState = getState($State);
            if($getState){
             $state_code =  $getState->state_code;
            }
            
            $getCountry = getCountry($Country);
            if($getCountry){
             $country_code =    $getState->state_code;
            }
            $school_object = DB::table('school')->where('name', 'like', "%$School%")->first();
                if(!$school_object){
                    $master_school_id = DB::table('school')->insertGetId(
                            ['name' => $School, 
                            'type' => 'High' , 
                            'source' => 'NCES', 
                            'source_id' => 7201855, 
                            'state_id' => $State,// id 
                            'city' => $City,
                            'state' => $state_code, 
                            'country' => $country_code,
                            'top' => 0, 
                            ]
                        );
                }
            }
            
            $orderCount = 1;
            if (empty($db_education_id)) {
               $find =  Education::where('user_id',$yak_user_id)->select('orderBy')->orderBy('orderBy','Desc')->first();
            
               if($find){
                $orderCount =  $find->orderBy + 1;
                }else{
                 $orderCount =  1;
                }
              
               $db_education_id = DB::table('education')->insertGetId(
                    ['user_id' => $yak_user_id, 'orderBy' => $orderCount , 'school' => $School, 'school_id' => $master_school_id, 'city' => $City, 'state' => $State, 'country' => $Country, 'degree' => $Degree, 'other_degree' => $OtherDegree, 'major' => $MajorField, 'credits_completed' => $CreditCompleted, 'credits_completed_phrase' => $CreditCompletedPhrase, 'grad_month' => $Month, 'grad_year' => $Year]
                );
                // if (!empty($CreditCompleted)) {
                //     DB::table('education_enhancements')->insert(
                //         ['education_id' => $db_education_id, 'value' => $CreditCompleted, 'type' => 'Credits Completed']
                //     );
                // }
                if (!empty($Page)) {
                    DB::table('users')->where('id', $yak_user_id)->update(['page' => $Page]);
                }
            } else {
                $a = DB::table('education')->where('id', $db_education_id)->update(
                    ['user_id' => $yak_user_id, 'school' => $School, 'school_id' => $master_school_id, 'city' => $City, 'state' => $State, 'country' => $Country, 'degree' => $Degree, 'other_degree' => $OtherDegree, 'major' => $MajorField, 'credits_completed' => $CreditCompleted, 'credits_completed_phrase' => $CreditCompletedPhrase, 'grad_month' => $Month, 'grad_year' => $Year]
                );
                //var_dump($b4_CreditCompleted);
                //var_dump($CreditCompleted);
                // if(!empty($b4_CreditCompleted) && !empty($CreditCompleted)) {
                //     DB::table('education_enhancements')->where('education_id', $db_education_id)->update(
                //         ['value' => $CreditCompleted, 'type' => 'Credits Completed']
                //     );
                // }
                // else if(!empty($b4_CreditCompleted) && empty($CreditCompleted)){
                //     //delete row
                //     DB::table('education_enhancements')->where('education_id', $db_education_id)->delete();
                // }
                // else if(empty($b4_CreditCompleted) && !empty($CreditCompleted)) {
                //     //insert
                //     DB::table('education_enhancements')->insert(['education_id' => $db_education_id, 'value' => $CreditCompleted, 'type' => 'Credits Completed']);
                // }
                // else{
                //     // no action
                // }
            }

            if (!empty($db_education_id)) {
                return response()->json(["status" => 1, "message" => "", "db_id" => "$db_education_id"]);
            } else {
                return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
            }
        } catch (Exception $ex) {
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
        }
    }

    function getEducationHistory(Request $request)
    {
        $yak_user_id = $request->session()->get('yak_user_id');
        if (!empty($yak_user_id)) {
            try {
                //SELECT * FROM `education` ed left outer join education_enhancements ee on ed.id = ee.education_id where user_id = 102 order by ed.id
                $saved_education = DB::table('education as ed')
                    // ->leftJoin("education_enhancements as ee","ed.id", "=", "ee.education_id")
                    ->select("ed.*")
                    ->where("user_id", "=", $yak_user_id)
                    ->orderBy("ed.id")->get();
                //var_dump($saved_education);
                if (!empty($saved_education)) {
                    if (count($saved_education) > 0) {
                        return response()->json(["status" => 1, "message" => "", "education" => $saved_education]);
                    } else {
                        return response()->json(["status" => 0, "message" => "no saved education"]);
                    }
                } else {
                    return response()->json(["status" => 0, "message" => "no saved education"]);
                }
            } catch (Exception $ex) {
                return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
            }
        }
    }

    function deleteEducationHistory(Request $request)
    {
        $yak_user_id = $request->session()->get('yak_user_id');
        $db_education_id = $request->input('db_education_id');
        if (!empty($yak_user_id)) {
            try {
                var_dump($db_education_id);
                DB::table('education')->where('id', $db_education_id)->delete();
                // DB::table('education_enhancements')->where('education_id',$db_education_id)->delete();
                return response()->json(["status" => 1, "message" => ""]);
            } catch (Exception $ex) {
                return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
            }
        }
    }


    //for test 
    function getEducation()
    {
        $education = Education::get();
        return response()->json([
            'status' => 200,
            'education' => $education
        ]);
    }
}