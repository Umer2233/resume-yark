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

class ExperienceFinder extends Controller
{
    public function questions(Request $request,$experience_id = null)
    {
        $id = $request->session()->get('yak_user_id');
        $resume_id = $request->resume_id;

        //$resumeDataNew1 = DB::select("select qex.id as que_id,qex.*,position_question.* from (SELECT questions.*,count(questions.id) as experience_time FROM `questions` LEFT JOIN `experiences` on questions.id = experiences.question_id where profile_question <> '' and experiences.user_id = $id  GROUP by questions.id) as qex inner join `position_question` on qex.id = position_question.question_id order by position_question.user_rating DESC");
        //(SELECT description FROM experiences WHERE question_id = 3) AS Experience

        /*$resumeData = Questions::select('questions.id as que_id', 'questions.*', 'position_question.*')
        ->leftJoin('position_question', function ($join) {
            $join->on('position_question.question_id', '=', 'questions.id');
        })
        // ->leftJoin('resumes', function ($join) use ($id) {

        //     $join->on('resumes.position_id', '=', 'position_question.position_id');
        //     $join->where('resumes.user_id', '=', $id);
        // })
        // ->where('resumes.position_id', '=', 'position_question.position_id')
        ->where('questions.profile_question', '!=', null)
        // ->where('questions.user_id', '=', $id)
        ->orderBy('position_question.user_rating', 'DESC')
        ->groupby('questions.id')
        ->get();
        $resume = Resume::where('user_id','=',$id)->where('id','=',$request->resume_id)->get();
        $resumeDataNew = [];
        if(count($resume) > 0){
            foreach ($resumeData as $keys => $resumes) {
                foreach ($resume as $key => $res) {
                    if($res['position_id'] == $resumes['position_id']){
                        array_push($resumeDataNew,$resumeData[$keys]);
                    }
                    // else{
                    //     unset($resumeData[$keys]);
                    // }
                }
            }
        }
        $resumeDataNew = array_values(array_map("unserialize", array_unique(array_map("serialize", $resumeDataNew))));
        $Experience = Experience::where('user_id','=',$id)->get();
        if(count($resumeDataNew)> 0 && count($Experience) >0) {
            foreach ($resumeDataNew as $keys => $value) {
                    $data = [];
                    $count = 1;
                    $resumeDataNew[$keys]->experience_time = 0;
                    $resumeDataNew[$keys]->Experience = [];
                    foreach ($Experience as $key => $exp) {

                        if($exp['question_id'] === $value['que_id']) {
                            $resumeDataNew[$keys]->experience_time = $count++;
                            //  $resumeDataNew[$keys]->Experience[$key] = $Experience[$key];
                            array_push($data,$Experience[$key]);
                            $resumeDataNew[$keys]->Experience = $data;
                        }
                    }

            }
        }*/
        //SELECT questions.*, position_question.position_id, position_question.question_id, position_question.importance_rating, position_question.user_rating FROM questions INNER JOIN `position_question` ON questions.id = position_question.question_id INNER JOIN resumes ON position_question.position_id = resumes.position_id AND resumes.user_id = $id AND resumes.id = $request->resume_id WHERE questions.profile_question IS NOT NULL AND questions.profile_question <> '' GROUP BY questions.id ORDER BY position_question.user_rating DESC, position_question.question_id DESC
        // order by pq.user_rating desc, pq.importance_rating DESC
        $resumeDataNew = DB::select("SELECT q.*,pq.position_id, pq.question_id, pq.importance_rating, pq.user_rating FROM questions q INNER JOIN position_question pq on q.id = pq.question_id INNER join `resumes` r on pq.position_id = r.position_id where r.id = :resume_id and q.profile_question is not null and q.profile_question <> ''  order by  pq.importance_rating DESC", ["resume_id" => $request->resume_id]);
        if (count($resumeDataNew) > 0) {
            foreach ($resumeDataNew as $keys => $value) {
                $resumeDataNew[$keys]->que_id = $value->id;
                $experienceData = DB::select("SELECT experiences.* FROM experiences LEFT JOIN `questions` on questions.id = experiences.question_id INNER JOIN resume_experience on resume_experience.experience_id = experiences.id WHERE experiences.question_id = $value->id  AND experiences.user_id = $id and resume_experience.resume_id = $resume_id GROUP BY experiences.id");
                $resumeDataNew[$keys]->experience_time = count($experienceData);
                $resumeDataNew[$keys]->Experience = $experienceData;
            }
        }
        // Add data in resumesection
        // $resumesection = DB::table('resumesection')->where('resume_id', $request->resume_id)->get()->first();
        // if(empty($resumesection)) {
        //     $resumesectionID = DB::table('resumesection')->insertGetId(['resume_id' => $request->resume_id, 'title' => 'Work Experience', 'type' => 'work', 'column' => 1, 'order' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        // }
        // End
        if (count($resumeDataNew) > 0) {
            return response()->json([
                'success' => true,
                'status' => 1,
                'data' => $resumeDataNew,
                'experience_id'=>$experience_id

            ]);
        } else {
            return response()->json([
                'success' => true,
                'status' => 0,
            ]);
        }
    }

    public function GetJob(Request $request)
    {
        $id = $request->session()->get('yak_user_id');
        $jobData = Job::where('user_id', '=', $id)
            ->orderBy('end_date', 'DESC')
            ->get();
        $nullData = array();
        $NotNullData = array();
        if (count($jobData) > 0) {
            for ($i = 0; $i < count($jobData); $i++) {
                if ($jobData[$i]->end_year === null) {
                    array_push($nullData, $jobData[$i]);
                } else {
                    array_push($NotNullData, $jobData[$i]);
                }
            }
        }

        $result = array_merge($nullData, $NotNullData);

        if (count($jobData) > 0) {
            return response()->json([
                'success' => true,
                'status' => 1,
                'data' => $result
            ]);
        } else {
            return response()->json([
                'success' => true,
                'status' => 0,
            ]);
        }
    }

    public function saveExperienceFinder(Request $request)
    {
        $count_experiences = DB::table('resume_experience')->where("resume_id", $request->resume_id)->count();
        $id = $request->session()->get('yak_user_id');
        $resume_id = $request->resume_id;

        $Experience = new Experience;
        $Experience->user_id = $id;
        $Experience->question_id = $request->question_id;
        $Experience->position_id = $request->position_id;
        $Experience->job_id = $request->job_id;
        $Experience->result_id = $request->result_id;
        // $Experience->resume_id = $request->resume_id;
        $Experience->type = $request->type;
        $Experience->description = $request->description;
        $Experience->save();

        //var_dump($Experience->id);

        $resume = Resume::find($resume_id);
        $resume->last_step = $request->page;
        $resume->save();

        $user = User::find($id);
        $user->page = $request->page;
        $user->save();

        // $position_question =  PositionQuestion::find($request->question_id);
        // $position_question->user_rating = $position_question->user_rating + 1;
        // $position_question->save();

        $resume_experience = DB::table("resume_experience")->insert([
            'resume_id' => $resume_id,
            'experience_id' => $Experience->id,
            'order' => $count_experiences + 1,
            'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);


        $user_rating = DB::table('position_question')->where('position_id', $request->position_id)
            ->where('question_id', $request->question_id)->get()->first()->user_rating;

        DB::table('position_question')->where('position_id', $request->position_id)->where('question_id', $request->question_id)
            ->update(['user_rating' => $user_rating + 1]);
        return $this->questions($request,$Experience->id);
    }

    public function editExperienceFinder(Request $request)
    {
        $id = $request->session()->get('yak_user_id');

        $Experience = Experience::find($request->id);
        $Experience->user_id = $id;
        $Experience->question_id = $request->question_id;
        $Experience->position_id = $request->position_id;
        $Experience->job_id = $request->job_id;
        $Experience->result_id = $request->result_id;
        $Experience->type = $request->type;
        $Experience->description = $request->description;
        $Experience->save();
        $resume = Resume::find($request->resume_id);
        $resume->last_step = $request->page;
        $resume->save();

        $user = User::find($id);
        $user->page = $request->page;
        $user->save();

        DB::table("resume_experience")->where('id', $request->id)->update(['updated_at' => Carbon::now()]);

        return $this->questions($request);
    }

    public function deleteExperienceFinder(Request $request)
    {
        $Experience = Experience::find($request->id);
        $Experience->delete();

        DB::table('resume_experience')->where('experience_id', $request->id)->delete();

        DB::table("resume_experience")->where('id', $request->id)->delete();

        return response()->json([
            'success' => true,
            'status' => 1,
        ]);
    }
    public function checkNextCondition(Request $request)
    {
        $id = $request->session()->get('yak_user_id');
        $Experience = Experience::where('user_id', '=', $id)->get();
        $Job = Job::where('user_id', '=', $id)->orderby('id', 'DESC')->get();

        $resumeData = Resume::select('resumes.id as resume_id', 'position.id as pos_id', 'resumes.*', 'position.*')
            ->leftJoin('position', function ($join) {
                $join->on('resumes.position_id', '=', 'position.id');
            })
            ->where('user_id', $id)
            ->where('resumes.id', $request->resume_id)
            ->orderby('resumes.id', 'DESC')
            ->get();
        $sub_date = date('Y', strtotime("-5475 days"));

        if ((count($Experience) < 15 || ($Job[0]->end_month == '13' || $Job[0]->end_year > $sub_date)) && $resumeData[0]->expand_experienc != 1) { //
            $popup = true;
        } else {
            $popup = false;
        }

        return response()->json([
            'success' => true,
            'status' => 1,
            'popup' => $popup,
            'expand_experienc' => $resumeData[0]->expand_experienc
        ]);
    }

    public function showMoreQuestion(request $request)
    {

        if ($request->btnClick == 'showMeMoreQuestion' || $request->btnClick == 'FromOtherCall') {

            if ($request->btnClick == 'showMeMoreQuestion') {
                $resume = Resume::find($request->resume_id);
                $resume->expand_experienc = 1;
                $resume->save();
            }

            $id = $request->session()->get('yak_user_id');
            //SELECT qex.*, position_question.position_id, position_question.question_id, position_question.importance_rating, position_question.user_rating FROM questions AS qex INNER JOIN `position_question` ON qex.id = position_question.question_id INNER JOIN resumes ON position_question.position_id != resumes.position_id AND resumes.id = $request->resume_id INNER JOIN job ON position_question.position_id = job.position_id AND job.user_id = $id WHERE qex.profile_question IS NOT NULL AND qex.profile_question <> '' GROUP BY qex.id ORDER BY position_question.user_rating DESC, position_question.question_id DESC
             $resumeDataMain = DB::select("SELECT questions.*,
             position_question.position_id,
             position_question.question_id,
             position_question.importance_rating,
             position_question.user_rating
              FROM position_question
               LEFT JOIN questions ON position_question.question_id = questions.id WHERE position_question.position_id in
               (SELECT position_id FROM `job` where user_id = :user_id) AND questions.profile_question IS NOT NULL AND questions.profile_question <> '' AND questions.id NOT IN
                (SELECT questions.id FROM position_question LEFT JOIN questions ON position_question.question_id = questions.id WHERE position_question.position_id
                IN(SELECT position_id FROM `resumes` where id = :resume_id)) ORDER BY position_question.user_rating DESC,
                 position_question.importance_rating DESC", ["user_id" => $id] + ["resume_id" => $request->resume_id]);

            //echo ("SELECT qex.*, position_question.position_id, position_question.question_id, position_question.importance_rating, position_question.user_rating FROM questions AS qex INNER JOIN `position_question` ON qex.id = position_question.question_id INNER JOIN resumes ON position_question.position_id != resumes.position_id AND resumes.id = $request->resume_id INNER JOIN job ON position_question.position_id = job.position_id AND job.user_id = $id WHERE qex.profile_question IS NOT NULL AND qex.profile_question <> '' GROUP BY qex.id ORDER BY position_question.user_rating DESC, position_question.question_id DESC");

            if (count($resumeDataMain) > 0) {
                foreach ($resumeDataMain as $keys => $value) {
                    $resumeDataMain[$keys]->que_id = $value->id;
                    $experienceData = DB::select("SELECT experiences.* FROM experiences LEFT JOIN `questions` on questions.id = experiences.question_id WHERE experiences.question_id = $value->id AND experiences.user_id = $id GROUP BY experiences.id");
                    $resumeDataMain[$keys]->experience_time = count($experienceData);
                    $resumeDataMain[$keys]->Experience = $experienceData;
                }
            }

            return response()->json([
                'success' => true,
                'status' => 1,
                'data' => $resumeDataMain
            ]);
        } else {
            $resume = Resume::find($request->resume_id);
            $resume->expand_experienc = 0;
            $resume->save();

            $id = $request->session()->get('yak_user_id');

            $user = User::find($id);
            $user->page = $request->page;
            $user->save();
            return response()->json([
                'success' => true,
                'status' => 1,
            ]);
        }
    }
}