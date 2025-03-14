<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\EducationEnhancements;
use App\Education;
use App\Position;
use App\Resume;
use App\Minor;
use App\Job;
use App\Experience;
use App\Questions;
use App\PositionQuestion;
use App\PositionQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use DateTime;
use Mail;
use App\ResetPassword;
use Illuminate\Support\Facades\Hash;

class ResumeType extends Controller
{
    public function getAllTypes($resume_id)
    {
        $selected_type = 0;
        $res_type_assessment = DB::select("SELECT * FROM `res_type_assessment` where active = 1 order by `order`");

        $selected_resume = DB::table('resumes')->where('id', $resume_id)->get()->first();

        if ($selected_resume->type == 'functional') {
            $selected_type = 'functional';
        } else if ($selected_resume->type == 'chronological') {
            $selected_type = 'chronological';
        }

        return response()->json([
            'success' => true,
            'status' => 1,
            'data' => $res_type_assessment,
            'selected_type' => $selected_type
        ]);
    }

    public function updateResumeType(Request $request)
    {
        $resume = DB::table('resumes')->where('id', $request->resume_id)->update([
            'type' => $request->resume_type,
            'chronological_score' => $request->chronological_score == "NULL" ? null : $request->chronological_score,
            'type_assessment' => $request->type_assessment_questions == "NULL" ? null : $request->type_assessment_questions,
        ]);
        return response()->json([
            'success' => true,
            'status' => 1
        ]);
    }

    public function updateResumeSection(Request $request)
    {




        $resumesection_id = DB::table('resumesection')->where('resume_id', '=', $request->resume_id)->value('id');
        if (empty($resumesection_id)) {
            $resumesection_id = DB::table('resumesection')->insertGetId(['resume_id' => $request->resume_id, 'title' => 'Work Experience', 'content' => NULL, 'type' => 'work', 'column' => 1, 'order' => 1, 'hidden' => 1, 'created_at' => now(), 'updated_at' => now()]);
        }


        DB::table('resume_experience')->insertGetId(['resume_id' => $request->resume_id, 'experience_id' => 1, 'resumesubsection_id' => $resumesection_id, 'order' => 1, 'content_override' => '', 'created_at' => now(), 'updated_at' => now()]);

        $my_null_jobs = DB::table('job')->where('user_id', $request->user_id)->whereNull('end_date')->orderBy('id')->get();

        foreach ($my_null_jobs as $key => $my_null_job) {
            DB::table("resumesection_job")->insertGetId(['resumesection_id' => $resumesection_id, 'job_id' => $my_null_job->id, 'endorsement_id' => 0, 'order' => $key, 'hidden' => '', 'employment_gap' => 0, 'created_at' => now(), 'updated_at' => now()]);
        }


        $my_jobs = DB::table('job')->where('user_id', $request->user_id)->whereNotNull('end_date')->orderBy('end_date')->get();



        foreach ($my_jobs as $key => $my_job) {
            DB::table("resumesection_job")->insertGetId(['resumesection_id' => $resumesection_id, 'job_id' => $my_job->id, 'endorsement_id' => 0, 'order' => $key, 'hidden' => '', 'employment_gap' => 0, 'created_at' => now(), 'updated_at' => now()]);
        }



        return response()->json([
            'success' => true,
            'status' => 1
        ]);
    }
}