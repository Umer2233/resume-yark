<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mockery\Exception;
use App\Endorsement;
use App\EduSubSectionContent;


class Endorsements extends Controller
{
    public function getEndorsements(Request $request)
    {
        $id = $request->session()->get('yak_user_id');
        $endorsements = DB::table('endorsement')->where('user_id', "=", $id)->get();

        foreach ($endorsements as  $key => $endorsement) {
            //var_dump($endorsements[$key]->job_id);
            if (is_null($endorsements[$key]->job_id)) {
                // echo "hi";
                $endorsements[$key]->job_id = 999;
            }
        }

        return response()->json([
            'success' => true,
            'status' => 1,
            'data' => $endorsements
        ]);
    }

    public function saveEndorsements(Request $request)
    {
        $id = $request->session()->get('yak_user_id');
        $value = $request->input('value');
        $author = $request->input('author');
        $author_description = $request->input('author_description');
        $job_id = $request->input('job_id');
        $result_id = $request->input('result_id');
        $endorsement_id = $request->input('id');
        $resume_id = $request->input('resume_id');

        if ($job_id == 999) {
            $job_id = null;
        }



        if ($endorsement_id == 0) {

            $endorsement_id = DB::table("endorsement")->insertGetId(['user_id' => $id, 'job_id' => $job_id, 'result_id' => $result_id, 'value' => $value, 'author' => $author, 'author_description' => $author_description]);
        } else {
            DB::table("endorsement")->where('id', '=', $endorsement_id)->update(['user_id' => $id, 'job_id' => $job_id, 'result_id' => $result_id, 'value' => $value, 'author' => $author, 'author_description' => $author_description]);
            if ($result_id == 5) {
                DB::table("resumes")->where('id', '=', $resume_id)->where('headline_type', '=', 'Endorsement')->update(['headline_type' => NULL, 'headline_endorsement_id' => NULL]);
            }
        }

        if ($result_id != 5) {
            //echo "test1";
            //DB::enableQueryLog();
            //DB::table("resumes")->where('id','=',$resume_id)->where('headline_type','!=','Endorsement')->update(['headline_type' => 'Endorsement','headline_endorsement_id' => $endorsement_id]);
            $affected = DB::update(
                'update resumes set headline_type = \'Endorsement\',headline_endorsement_id = ? where id = ? and NOT headline_type <=> \'Endorsement\'',
                [$endorsement_id, $resume_id]
            );
            //dd(DB::getQueryLog());
        } else {
            $endorsements_for_headline = DB::table('endorsement')->where('user_id', "=", $id)->where('result_id', '!=', "5")->first();
            if (!empty($endorsements_for_headline->id)) {
                DB::table("resumes")->where('id', '=', $resume_id)->where('headline_type', '=', 'Endorsement')->update(['headline_type' => 'Endorsement', 'headline_endorsement_id' => $endorsements_for_headline->id]);
            }
        }

        return response()->json([
            'success' => true,
            'status' => 1,
            'id' => $endorsement_id
        ]);
    }

    public function deleteEndorsements(Request $request)
    {
        $id = $request->session()->get('yak_user_id');
        $endorsements_id = $request->input('endorsements_id');
        $resume_id = $request->input('resume_id');
        $findEndorse =  Endorsement::where('id', $endorsements_id)->first();
        if($findEndorse){
                try{
                 $type = "App\Endorsement";
                 removeEduSubsectionContent($id,$findEndorse->id,$type);
                }catch(\Exception $ex){
                    Log::error($ex);
                }
        }
        $findEndorse->delete();
        //DB::enableQueryLog();
        $endorsements_for_headline = Endorsement::where('user_id', "=", $id)->where('result_id', '!=', "5")->first();
        //dd(DB::getQueryLog());
        //var_dump($endorsements_for_headline->id);

        if (!empty($endorsements_for_headline->id)) {
            //DB::connection()->enableQueryLog();
            $affected = DB::update(
                'update resumes set headline_type = \'Endorsement\',headline_endorsement_id = ? where id = ?',
                [$endorsements_for_headline->id, $resume_id]
            );
            //dd(DB::getQueryLog());
            //DB::table("resumes")->where('id','=',$resume_id)->where('headline_type','=','Endorsement')->where('headline_endorsement_id','=',$endorsements_id)->update(['headline_type' => 'Endorsement','headline_endorsement_id' => $endorsements_for_headline]);
        } else {
            $affected = DB::update(
                'update resumes set headline_type = NULL,headline_endorsement_id = NULL where id = ? and headline_type = \'Endorsement\'',
                [$resume_id]
            );
            //DB::table("resumes")->where('id','=',$resume_id)->where('headline_type','=','Endorsement')->where('headline_endorsement_id','=',$endorsements_id)->update(['headline_type' => NULL,'headline_endorsement_id' => NULL]);
        }

        return response()->json([
            'success' => true,
            'status' => 1,
        ]);
    }

    public function getEndorsementTooltip(Request $request)
    {
        $FieldTips = DB::table('field_tips')->whereIn('page', ['endorsements'])->get();
        return response()->json([
            'success' => true,
            'status' => 1,
            'field_tips'  => json_encode($FieldTips)
        ]);
    }
}