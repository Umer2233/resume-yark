<?php

namespace App\Http\Controllers\Frontend;

use App\Endorsement;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use Carbon\Carbon;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Job;
use App\EduSubSectionContent;
use App\Kaun;
use App\ResumeExperience;
use App\Skills;
use App\Minor;
use App\Template;
use App\JobDescription;
use App\QualificationStatement;
use App\ResumeSection;
use App\ResumeSectionJob;
use App\ResumeSetting;
use App\ResumeSorting;
use App\User;
use App\EducationEnhancements;
use App\Education;
use App\Position;
use App\Resume;
use App\ResumeSubSection;
use App\Experience;
use App\FieldSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use DateTime;
use Mail;
use Session;
use App\ResetPassword;
use App\Title;
use Illuminate\Support\Facades\Hash;
use Log;


class MyResumeController extends Controller
{
    public function __construct()
    {
        $id = Session::get('yak_user_id');
    }

    public function checkLoggedIn(Request $request)
    {
        Log::info('check', $request->all());
        if (!blank($request->session()->get('login_status'))) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function storeEndorsement(Request $request)
    {
        Log::info('storeEndorsement', $request->all());
        $id = $request->session()->get('yak_user_id');
        Endorsement::where('status', 1)->where('user_id', $id)->update(['status' => 0]);

        $endorsement = new  Endorsement();
        $endorsement->value = $request->value == 2 ? "Qualification" : "Endorsement";
        $endorsement->type = $request->value;
        $endorsement->author = $request->author;
        $endorsement->user_id = $id;
        $endorsement->author_description = $request->author_description;
        $endorsement->status = 1;
        $endorsement->save();
        $resumeData = $this->getResumeData($id,$request->resume_id);
        return response()->json($resumeData);
    }


    public function resumeStyle(Request $request)
    {
        $resume = Resume::where('id', $request->resume_id)->with(['template'])->first();

        if ($request->type == 'font_id') {
            $resume->update(['font_id' => $request->font]);
        }

        if ($request->type == 'heading') {
            $resume->update(['heading_font_size' => $request->font]);
        }

        if ($request->type == 'top_bottom_margin') {
            $resume->update(['top_bottom_margi' => $request->font]);
        }

        if ($request->type == 'body_font_size') {
            $resume->update(['body_font_size' => $request->font]);
        }

        if ($request->type == 'margin') {

            $resume->update(['top_bottom_margi' => $request->font]);
        }
        if ($request->type == 'sub_heading') {
            $resume->update(['subheading_font_s' => $request->font]);
        }
        if ($request->type == 'left_right_margin') {
           $resume->update(['left_right_margin' => $request->font]);
        }
        if ($request->type == 'haeding_spacing') {
            $resume->update(['heading_spacing' => $request->font]);
        }
        if ($request->type == 'sub_haeding_spacing') {
            $resume->update(['subheading_spacin' => $request->font]);
        }
        if ($request->type == 'body_text_spacing') {
            $resume->update(['body_text_spacing' => $request->font]);
        }

        if ($request->type == 'indent_spacing') {
            $resume->update(['indent_spacing' => $request->font]);
        }

        if ($request->type == 'template') {
            $this->resetResumeFormatting($resume,$request);
        }
        $id = $request->session()->get('yak_user_id');
        $resumeData = $this->getResumeData($id,$request->resume_id);
        return response()->json($resumeData);

    }

    public function resetResumeFormatting($resume,$request){
            $template_id = $request->font;
            $color_id = 1;
            $font_id = 1;
            $colorFont =   $this->getColorFont($template_id);

            return  $resume->update([
                'template_id' => $template_id,
                'color_id'=>$colorFont['color_id'],
                'font_id'=>$colorFont['font_id'],
                'heading_font_size'=>null,
                'subheading_font_s'=>null,
                'body_font_size'=>null,
                'top_bottom_margi'=>null,
                'left_right_margin'=>null,
                'heading_spacing'=>null,
                'subheading_spacin'=>null,
                'body_text_spacing'=>null,
                'indent_spacing'=>null,
            ]);

    }
    public function getColorFont($template_id){
                $color_id = 1;
                $font_id = 1;
            if($template_id == 1){
                $color_id = 1;
                $font_id = 4;
            }elseif($template_id == 2){
                $color_id = 6;
                $font_id = 4;
            }elseif($template_id == 3){
                $color_id = 11;
                $font_id = 7;
            }elseif($template_id == 4){
                $color_id = 14;
                $font_id = 10;
            }elseif($template_id == 5){
                 $color_id = 17;
                 $font_id = 13;
            }
            return  $response = ['color_id'=>$color_id,'font_id'=>$font_id];

    }
    public function createPassword(Request $request)
    {
         if(isset($request->id)){
        $user = User::find($request->id);
        if ($request->skip == "false") {
            $user->password = Hash::make($request->password);
            $user->email = $request->EmailAddress;
            $user->save();
            if($user){
                $data = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $request->EmailAddress,
                'year' => date('Y')
                 ];
             try{
                    Mail::send('Email.welcome', $data, function ($message) use ($request) {
                        $message->to($request->EmailAddress)->subject('Welcome to the Best Online Resume Builder');
                        $message->from('jseiter@resumeyak.com', 'Resume Yak');
                    });
                }catch(Exception $e) {
                    Log::info($ex);
                }

                $request['email']=$request->EmailAddress;

                return (new LoginController())->postLogin($request);
                // return response()->json([
                //     'success' => true,
                //     'status' => 1,
                //     'message'=>'Account created successfully.'
                // ]);
            }

            return response()->json([
                'success' => false,
                'status' => 0,
                'message'=>'Action failed!'
            ]);
            // return response()->json(200);
        } else {

            $ResetPassword = new ResetPassword;
            $ResetPassword->email = $request->email;
            $ResetPassword->token = md5($request->email);
            $ResetPassword->save();
            if($ResetPassword){
            $data = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'token' => $ResetPassword->token,
                'year' => date('Y')
            ];
            try{
            Mail::send('Email.skip_create_password', $data, function ($message) use ($user) {
                $message->to($user->email)->subject('Welcome to the Best Online Resume Builder');
                $message->from('jseiter@resumeyak.com', 'Resume Yak');
            });

            }catch(Exception $e) {
                Log::info($ex);
            }
            return response()->json([
                'success' => true,
                'status' => 1,
                'message'=>'Account created successfully without password!'
            ]);
        }

        return response()->json([
                'success' => false,
                'status' => 0,
                'message'=>'Action failed!'

            ]);
        }
        }else{

            return response()->json([
                'success' => false,
                'status' => 0,
                'message'=>'Please go to the Contact info page and add your details!'

            ]);

        }
    }

    public function resetPassword(Request $request)
    {
        if (!empty($request->id)) {
            $user = User::find($request->id);
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'success' => true,
                'status' => 1
            ]);
        } else {
            $token = DB::table('password_resets')->where('token', $request->token)->first();
            $user = User::where('email', $token->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'success' => true,
                'status' => 1
            ]);
        }
    }

    public function getPosition(Request $request)
    {
        // $position = Position::where('pos_name', 'like', '%' . $request->position . '%')->get();
        $position = Position::where('pos_name', 'like', '%' . str_replace(' ', '%', $request->position) . '%')->get();

        // dd($position->toArray());
        return response()->json([
            'success' => true,
            'status' => 1,
            'data' => $position
        ]);
    }
public function saveResume(Request $request)
    {
        Log::info('saveResume', $request->all());
        $id = $request->session()->get('yak_user_id');
        $checkSignup = checkAccountStatus($id);
        if(!$checkSignup ){
             return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Please create your account first!'
            ]);
        }
        $data = [];
        $Resume_id = '';
        $new = '';
        $Added_id = '';
        $title ='';
        $template_id='';
        $object = $request->all();
        $position = Position::where('id', $object['position_id'][0])->first();
        $findTemplate =   Resume::where('user_id', $id)->first();
        $jobs = Job::where('user_id', $id)->get();
        $title = Title::create([
            'title' => $position->pos_name,
            'is_active' => '1',
            'length' => strlen($position->pos_name)
        ]);
        foreach ($request->position_id as $key => $value) {

            if ($value !== false) {

              if ($key < count($request->id)) {
                    if ($request->id[$key] != null) {
                        $resume = Resume::find($request->id[$key]);
                        if($resume){
                            $Resume_id = $request->id[$key];
                            $template_id = $resume->template_id;
                        }else{
                            $resume = new Resume;
                            $new = 1;
                            $resume->last_step = $request->page;
                            $template_id = '';
                        }

                    }
                } else {
                    $resume = new Resume;
                    $new = 1;
                    $resume->last_step = $request->page;
                    $template_id = '';
                }

                $resume->position_id = $value;
                $resume->name = $request->name[$key];
                $resume->user_id = $request->session()->get('yak_user_id');
                $resume->middle_initial = $request->middle_initial;
                $resume->address_display = $request->address_display;
                $resume->email = $request->email;
                $resume->address = $request->address;
                $resume->phone = $request->phone;
                $resume->profile = $request->profile;
                $resume->website = $request->website;
                $resume->hide_headline = $request->hide_headline;
                $resume->employment_date = $request->employment_date;
                $resume->employment_location = $request->employment_location;
                $resume->employment_description = $request->employment_description;
                $resume->employment_emphasis = $request->employment_emphasis;
                $resume->education_date = $request->education_date;
                $resume->education_location = $request->education_location;
                $resume->education_emphasis = $request->education_emphasis;
                // $resume->color_id = 1;
                $resume->template_id = $template_id;
                $resume->title_id = $title->id;
                $resume->save();
                $Added_id = $resume->id;
                if ($new == 1) {
                    if ($id != '') {
                        $user = User::find($id);
                        $user->page = $request->page;
                        $user->save();
                    }
                    // if ($Resume_id == '') {
                    $Resume_id = $resume->id;

                    $resumeSetting = new ResumeSetting();
                    $resumeSetting->resume_id = $resume->id;
                    $resumeSetting->save();

                    $education = Education::where('user_id', $user->id)->get();

                    // if (count($jobs) > 0) {
                        $resumeaInfo = new ResumeSection();
                        $resumeaInfo->resume_id = $resume->id;
                        $resumeaInfo->title = 'Contact Info';
                        $resumeaInfo->type = 'contact';
                        $resumeaInfo->content = 'Contact Info';
                        $resumeaInfo->order = 1;
                        $resumeaInfo->column = 1;
                        $resumeaInfo->endorsement_id = 0;
                        $resumeaInfo->hidden = 1;
                        $resumeaInfo->save();

                        $resumeSection = new ResumeSection();
                        $resumeSection->resume_id = $resume->id;
                        $resumeSection->title = 'Work Experience';
                        $resumeSection->type = 'work';
                        $resumeSection->content = 'Work';
                        $resumeSection->order = 2;
                        $resumeSection->column = 1;
                        $resumeSection->endorsement_id = 0;
                        $resumeSection->hidden = 1;
                        $resumeSection->save();

                        if(count($jobs) > 0){
                            foreach ($jobs as $job) {
                                $resumeJob = new ResumeSectionJob();
                                $resumeJob->resumesection_id = $resumeSection->id;
                                $resumeJob->job_id = $job->id;
                                $resumeJob->endorsement_id = $resume->id;
                                $resumeJob->order = 1;
                                $resumeJob->save();
                            }
                        }

                        $resumeSectionPro = new ResumeSection();
                        $resumeSectionPro->resume_id = $resume->id;
                        $resumeSectionPro->title = 'Professional Summary';
                        $resumeSectionPro->type = 'professional-summary';
                        $resumeSectionPro->content = 'professional summary';
                        $resumeSectionPro->order = 3;
                        $resumeSectionPro->column = 1;
                        $resumeSectionPro->endorsement_id = 0;
                        $resumeSectionPro->hidden = 1;
                        $resumeSectionPro->save();
                    // }

                    // if (count($education) > 0) {
                        $resumeaEdu = new ResumeSection();
                        $resumeaEdu->resume_id = $resume->id;
                        $resumeaEdu->title = 'Education';
                        $resumeaEdu->type = 'education';
                        $resumeaEdu->content = 'Education';
                        $resumeaEdu->order = 4;
                        $resumeaEdu->column = 1;
                        $resumeaEdu->endorsement_id = 0;
                        $resumeaEdu->hidden = 1;
                        $resumeaEdu->save();
                    // }

                }else{
                    if(count($jobs) > 0){
                    $workResSection = ResumeSection::where('type','work')->where('resume_id',$Added_id)->first();
                        if($workResSection){
                            foreach ($jobs as $job) {
                                $findSectionJob  = ResumeSectionJob::where('resumesection_id',$workResSection->id)->where('job_id',$job->id)->first();
                                if(!$findSectionJob){
                                    $resumeJob = new ResumeSectionJob();
                                    $resumeJob->resumesection_id = $workResSection->id;
                                    $resumeJob->job_id = $job->id;
                                    $resumeJob->endorsement_id = $Added_id;
                                    $resumeJob->order = 1;
                                    $resumeJob->save();
                                }

                            }
                        }
                    }
                }
            }
        }



        if ($Added_id != '') {
            return response()->json([
                'success' => true,
                'status' => 1,
                'resume_id' => $Added_id
            ]);
        } else {
            return response()->json([
                'success' => true,
                'status' => 1,
                'resume_id' => ''
            ]);
        }
    }
    public function saveResumeTemplate(Request $request){
        $id = $request->session()->get('yak_user_id');
        if(isset(($request->t_id)) && $request->resume_id ){
        $findRes =  Resume::where('id',$request->resume_id)->where('user_id',$id)->first();
            if($findRes){
                $colorFont =   $this->getColorFont($request->t_id);
                $findRes->update(['template_id'=>$request->t_id,'color_id'=>$colorFont['color_id'],'font_id'=>$colorFont['font_id']]);
                return response()->json([
                    'success' => true,
                    'status' => 1,
                ]);
            }
        }
         return response()->json([
                'success' => false,
                'status' => 0,
            ]);
    }
    public function saveResumeOld(Request $request)
    {

        Log::info('saveResume', $request->all());
        $data = [];
        $Resume_id = '';
        $new = '';
        $Added_id = '';
        $title ='';
        $template_id = '';
        $object = $request->all();
        $position = Position::where('id', $object['position_id'][0])->first();
        foreach ($request->position_id as $key => $value) {
            if ($value !== false) {
                if ($key < count($request->id)) {
                    if ($request->id[$key] != null) {
                        $resume = Resume::find($request->id[$key]);
                        $Resume_id = $request->id[$key];
                        $new = '';
                        $template_id = $resume->template_id;
                    }

                } else {
                    $resume = new Resume;
                    $new = 1;

                }

                $resume->position_id = $value;
                $resume->pos_name = $request->position_name;
                $resume->name = $request->name[$key];
                $resume->user_id = $request->session()->get('yak_user_id');
                $resume->middle_initial = $request->middle_initial;
                $resume->address_display = $request->address_display;
                $resume->email = $request->email;
                $resume->address = $request->address;
                $resume->phone = $request->phone;
                $resume->profile = $request->profile;
                $resume->website = $request->website;
                $resume->hide_headline = $request->hide_headline;
                $resume->employment_date = $request->employment_date;
                $resume->employment_location = $request->employment_location;
                $resume->employment_description = $request->employment_description;
                $resume->employment_emphasis = $request->employment_emphasis;
                $resume->education_date = $request->education_date;
                $resume->education_location = $request->education_location;
                $resume->education_emphasis = $request->education_emphasis;
                $resume->color_id = 1;
                $resume->last_step = 5;
                $resume->template_id = $template_id;
                $resume->title_id = $title->id;
                $resume->save();

                if ($new == 1) {
                    $Added_id = $resume->id;
                }
            }
        }

        $id = $request->session()->get('yak_user_id');
        if ($id != '') {
            $user = User::find($id);
            $user->page = $request->page;
            $user->save();
        }
        if ($Resume_id == '') {
            $Resume_id = $resume->id;

            $resumeSetting = new ResumeSetting();
            $resumeSetting->resume_id = $resume->id;
            $resumeSetting->save();

            $jobs = Job::where('user_id', $user->id)->get();
            $education = Education::where('user_id', $user->id)->get();

            // if (count($jobs) > 0) {
                $resumeaInfo = new ResumeSection();
                $resumeaInfo->resume_id = $resume->id;
                $resumeaInfo->title = 'Contact Info';
                $resumeaInfo->type = 'contact';
                $resumeaInfo->content = 'Contact Info';
                $resumeaInfo->order = 1;
                $resumeaInfo->column = 1;
                $resumeaInfo->endorsement_id = 0;
                $resumeaInfo->hidden = 1;
                $resumeaInfo->save();


                $resumeSection = new ResumeSection();
                $resumeSection->resume_id = $resume->id;
                $resumeSection->title = 'Work Experience';
                $resumeSection->type = 'work';
                $resumeSection->content = 'Work';
                $resumeSection->order = 2;
                $resumeSection->column = 1;
                $resumeSection->endorsement_id = 0;
                $resumeSection->hidden = 1;
                $resumeSection->save();

                $resumeSection = new ResumeSection();
                $resumeSection->resume_id = $resume->id;
                $resumeSection->title = 'Professional Summary';
                $resumeSection->type = 'professional-summary';
                $resumeSection->content = 'professional summary';
                $resumeSection->order = 3;
                $resumeSection->column = 1;
                $resumeSection->endorsement_id = 0;
                $resumeSection->hidden = 1;
                $resumeSection->save();

               if(count($jobs) > 0){
                foreach ($jobs as $job) {
                    $resumeJob = new ResumeSectionJob();
                    $resumeJob->resumesection_id = $resumeSection->id;
                    $resumeJob->job_id = $job->id;
                    $resumeJob->endorsement_id = $resume->id;
                    $resumeJob->order = 1;
                    $resumeJob->save();
                }
               }

            // }

            // if (count($education) > 0) {
                $resumeaEdu = new ResumeSection();
                $resumeaEdu->resume_id = $resume->id;
                $resumeaEdu->title = 'Education';
                $resumeaEdu->type = 'education';
                $resumeaEdu->content = 'Education';
                $resumeaEdu->order = 4;
                $resumeaEdu->column = 1;
                $resumeaEdu->endorsement_id = 0;
                $resumeaEdu->hidden = 1;
                $resumeaEdu->save();
            // }
        }
        if ($Added_id != '') {
            return response()->json([
                'success' => true,
                'status' => 1,
                'resume_id' => $Added_id
            ]);
        } else {
            return response()->json([
                'success' => true,
                'status' => 1,
                'resume_id' => ''
            ]);
        }
    }

    public function saveDefaultSort($resumeId, $type)
    {
        Log::info('saveDefaultSort', $resumeId, $type);
        $resumeTypeSort = ResumeSorting::where(['resume_id' => $resumeId, 'type' => $type])->first();
        if (blank($resumeTypeSort)) {
            $resumeTypeSort = new ResumeSorting();
        }
        $resumeTypeSort->resume_id = $resumeId;
        $resumeTypeSort->type = $type;
        $resumeTypeSort->value = json_encode([
            "Email Address",
            "Physical Address",
            "Phone Number",
            "Professional Profile",
            "Website"
        ]);
        $resumeTypeSort->save();
    }

    public function getResume(Request $request,$resume_id = false)
    {
        Log::info('getResume', $request->all());
        $id = $request->session()->get('yak_user_id');
        $resumeData = Resume::select('resumes.id as resume_id', 'position.id as pos_id', 'resumes.*', 'position.*')
            ->leftJoin('position', function ($join) {
                $join->on('resumes.position_id', '=', 'position.id');
            })
            ->where('user_id', $id);
        if($resume_id){
            $resumeData = $resumeData->where('resumes.id',$resume_id);
        }
        $resumeData= $resumeData->get();

    if (count($resumeData) > 0) {

            return response()->json([
                'success' => true,
                'status' => 1,
                'data' => $resumeData
            ]);
        } else {
            return response()->json([
                'success' => true,
                'status' => 0,
            ]);
        }
    }

    public function deleteResume(Request $request)
    {
        Log::info('deleteResume', $request->all());
        $ResumeId = $request->id;
        $resumeData = Resume::find($ResumeId);
        $resumeData->delete();
        ResumeExperience::where('resume_id',$ResumeId)->delete();
        $id = $request->session()->get('yak_user_id');
        $resumeData = Resume::select('resumes.id as resume_id', 'position.id as pos_id', 'resumes.*', 'position.*')
            ->leftJoin('position', function ($join) {
                $join->on('resumes.position_id', '=', 'position.id');
            })
            ->where('user_id', $id)
            ->get();

        return response()->json([
            'success' => true,
            'status' => 1,
            'data' => $resumeData
        ]);
    }

    public function resumeJobUpdate(Request $request,$resume_id = false)
    {
        Log::info('resumeJobUpdate', $request->all());
        $id = $request->session()->get('yak_user_id');
        $resume = Resume::with('resumeSetting')->where('id',$resume_id)->where('user_id', $id)->first();

        if ($request->get('type') == 'dates') {
            if ($resume->resumeSetting->is_dates == 1) {
                $resume->resumeSetting->update(['is_dates' => 0, 'is_month_year' => 0, 'is_year' => 0]);
            } else {
                $resume->resumeSetting->update(['is_dates' => 1]);
            }
        }

        if ($request->get('type') == 'monthyears') {

            if ($resume->resumeSetting->is_month_year == true) {
                $resume->resumeSetting->update(['is_month_year' => false, 'is_dates' => false]);
            } else {
                $resume->resumeSetting->update(['is_month_year' => true, 'is_year' => 0, 'is_dates' => 1]);
            }
        }

        if ($request->get('type') == 'years') {
            if ($resume->resumeSetting->is_year == true) {
                $resume->resumeSetting->update(['is_year' => false, 'is_dates' => false]);
            } else {
                $resume->resumeSetting->update(['is_year' => true, 'is_month_year' => 0, 'is_dates' => 1]);
            }
        }

        if ($request->get('type') == 'is-location-work') {


            if ($resume->resumeSetting->is_location == true) {
                $resume->resumeSetting->update(['is_location' => false, 'is_city_state' => false, 'is_city_state_country' => false]);
            } else {
                $resume->resumeSetting->update(['is_location' => true]);
            }
        }

        if ($request->get('type') == 'is-city-state-work') {
            if ($resume->resumeSetting->is_city_state == true) {
                $resume->resumeSetting->update(['is_city_state' => false]);
            } else {
                $resume->resumeSetting->update(['is_city_state' => true, 'is_city_state_country' => 0, 'is_location' => 1]);
            }
        }
        if ($request->get('type') == 'is-city-state-country-work') {

            if ($resume->resumeSetting->is_city_state_country == true) {
                $resume->resumeSetting->update(['is_city_state_country' => false]);
            } else {
                $resume->resumeSetting->update(['is_city_state_country' => true, 'is_city_state' => 0, 'is_location' => 1]);
            }
        }


        if ($request->get('type') == 'info-location') {


            if ($resume->resumeSetting->is_info_location == 1) {
                $resume->resumeSetting->update(['is_info_location' => 0]);
            } else {
                $resume->resumeSetting->update(['is_info_location' => 1]);
            }
        }

        /*Updates information location*/

        if ($request->get('type') == 'is_info_city_state') {

            if ($resume->resumeSetting->is_info_city_state == 1) {
                $resume->resumeSetting->update(['is_info_city_state' => true, 'is_info_location' => 1]);
            } else {
                $resume->resumeSetting->update(['is_info_city_state' => 1, 'is_info_location' => 1, 'is_info_full_address' => 0, 'is_info_full_address_city' => 0]);
            }
        }

        if ($request->get('type') == 'is_info_full_address') {

            if ($resume->resumeSetting->is_info_full_address == 1) {
                $resume->resumeSetting->update(['is_info_full_address' => true, 'is_info_location' => 1]);
            } else {
                $resume->resumeSetting->update(['is_info_full_address' => 1, 'is_info_location' => 1, 'is_info_city_state' => 0, 'is_info_full_address_city' => 0]);
            }
        }

        if ($request->get('type') == 'is_info_full_address_city') {

            if ($resume->resumeSetting->is_info_full_address_city == 1) {
                $resume->resumeSetting->update(['is_info_full_address_city' => true, 'is_info_location' => 1]);
            } else {
                $resume->resumeSetting->update(['is_info_full_address_city' => 1, 'is_info_location' => 1, 'is_info_city_state' => 0, 'is_info_full_address' => 0]);
            }
        }


        if ($request->get('type') == 'is_edu_month_year') {

            if ($resume->resumeSetting->is_edu_month_year == true) {
                $resume->resumeSetting->update(['is_edu_month_year' => true]);
            } else {
                $resume->resumeSetting->update(['is_edu_month_year' => true, 'is_edu_year' => 0, 'is_edu_dates' => 1]);
            }
        }

        if ($request->get('type') == 'is_edu_year') {

            if ($resume->resumeSetting->is_edu_year == true) {
                $resume->resumeSetting->update(['is_edu_year' => true]);
            } else {
                $resume->resumeSetting->update(['is_edu_year' => true, 'is_edu_month_year' => 0, 'is_edu_dates' => 1]);
            }
        }


        if ($request->get('type') == 'is_edu_location') {
            if ($resume->resumeSetting->is_edu_location == true) {
                $resume->resumeSetting->update(['is_edu_location' => 0,'is_edu_city_state' => 0, 'is_edu_city_state_country' => 0, ]);
            }
        }


        if ($request->get('type') == 'is_edu_city_state') {
            if ($resume->resumeSetting->is_edu_city_state == true) {
                $resume->resumeSetting->update(['is_edu_city_state' => true]);
            } else {
                $resume->resumeSetting->update(['is_edu_city_state' => true, 'is_edu_city_state_country' => 0, 'is_edu_location' => 1]);
            }
        }


        if ($request->get('type') == 'is_edu_city_state_country') {
            if ($resume->resumeSetting->is_edu_city_state_country == true) {
                $resume->resumeSetting->update(['is_edu_city_state_country' => true]);
            } else {
                $resume->resumeSetting->update(['is_edu_city_state_country' => true, 'is_edu_city_state' => 0, 'is_edu_location' => 1]);
            }
        }


        if ($request->get('type') == 'job_description') {
            if ($resume->resumeSetting->is_job_description == true) {
                $resume->resumeSetting->update(['is_job_description' => false]);
            } else {
                $resume->resumeSetting->update(['is_job_description' => true]);
            }
        }

        $resumeData = $this->getResumeData($id,$resume_id);
        return response()->json($resumeData);
    }
    public function resumeEducationUpdate(Request $request){
        $resume_id = $request->data['resume_id'];
        $userID = $request->session()->get('yak_user_id');
        $education = Education::where('id',$request->data['id'])->first();
        if($education){
            if ($request->data['type'] == 'is_degree') {

                if ($education->is_degree == 1) {
                    $education->update(['is_degree' => false]);
                } else {
                    $education->update(['is_degree' => true]);
                }

            }
            // dd($request->data['type']);
            if ($request->data['type'] === 'is_major_field_study') {

                if ($education->is_major_field_study == 1) {
                    $education->update(['is_major_field_study' => false]);
                } else {
                    $education->update(['is_major_field_study' => true]);
                }

            }

            if ($request->data['type'] == 'is_grad_date') {

                if ($education->is_grad_date == 1) {
                    $education->update(['is_grad_date' => false]);
                } else {
                    $education->update(['is_grad_date' => true]);
                }

            }
            if ($request->data['type'] == 'is_credits_completed') {

                if ($education->is_credits_completed == 1) {
                    $education->update(['is_credits_completed' => false]);
                } else {
                    $education->update(['is_credits_completed' => true]);
                }

            }
            if ($request->data['type'] == 'is_overall_gpa') {

                if ($education->is_overall_gpa == 1) {
                    $education->update(['is_overall_gpa' => false]);
                } else {
                    $education->update(['is_overall_gpa' => true]);
                }

            }
            if ($request->data['type'] == 'is_major_gpa') {

                if ($education->is_major_gpa == 1) {
                    $education->update(['is_major_gpa' => false]);
                } else {
                    $education->update(['is_major_gpa' => true]);
                }

            }

              if ($request->data['type'] == 'gpa_format') {

                $education->update(['gpa_format' => $request->data['format']]);

                // if ($request->data['format'] == 'full') {
                //     $education->update(['gpa_format' => 'simple']);
                // } else {
                //     $education->update(['gpa_format' => 'full']);
                // }
            }

        }
        $resumeData = $this->getResumeData($userID,$resume_id);
        return response()->json($resumeData);

    }
    public function updateResumeFormatting(Request $request){
        $resumeId = $request->resume_id;
        $userID = $request->session()->get('yak_user_id');
        $resume = Resume::where('user_id', $userID)->where('id', $resumeId)->first();
        if($resume){

            if($request->type == 'font_id'){
            $resume->update(['font_id'=>$request->value]);
            }

            if($request->type == 'education_emphasis'){
            $resume->update(['education_emphasis'=>$request->value]);
            }

            if($request->type == 'employment_emphasis'){
            $resume->update(['employment_emphasis'=>$request->value]);
            }

        }
        $resumeData = $this->getResumeData($userID,$resumeId);
        return response()->json($resumeData);


    }

      public function updateResumeSectionColumns(Request $request){
        $resumeId = $request->resume_id;
        $section_id = $request->section_id;

        $userID = $request->session()->get('yak_user_id');
        $resumeSection = ResumeSection::where('id',$section_id )->first();
        if($resumeSection){
            $resumeSection->update(['column'=>$request->column_val]);
        }
        $resumeData = $this->getResumeData($userID,$resumeId);
        return response()->json($resumeData);
    }

    public function resumeInfoUpdate(Request $request, $resumeId)
    {

        $userID = $request->session()->get('yak_user_id');
        $resume = Resume::with(['resumeSetting'])->where('user_id', $userID)->where('id',$resumeId)->first();
        if ($request->get('type') == 'info-location') {
            if ($resume->resumeSetting->is_info_location == 1) {
                $resume->resumeSetting->update(['is_info_location' => 0]);
            } else {
                $resume->resumeSetting->update(['is_info_location' => 1]);
            }
        }

        /*Updates information location*/

        if ($request->get('type') == 'is_info_city_state') {

            if ($resume->resumeSetting->is_info_city_state == 1) {
                $resume->resumeSetting->update(['is_info_city_state' => true, 'is_info_location' => 1]);
            } else {
                $resume->resumeSetting->update(['is_info_city_state' => 1, 'is_info_location' => 1, 'is_info_full_address' => 0, 'is_info_full_address_city' => 0]);
            }
        }

        if ($request->get('type') == 'is_info_full_address') {
            if ($resume->resumeSetting->is_info_full_address == 1) {
                $resume->resumeSetting->update(['is_info_full_address' => true, 'is_info_location' => 1]);
            } else {
                $resume->resumeSetting->update(['is_info_full_address' => 1, 'is_info_location' => 1, 'is_info_city_state' => 0, 'is_info_full_address_city' => 0]);
            }
        }

        if ($request->get('type') == 'is_info_full_address_city') {

            if ($resume->resumeSetting->is_info_full_address_city == 1) {
                $resume->resumeSetting->update(['is_info_full_address_city' => true, 'is_info_location' => 1]);
            } else {
                $resume->resumeSetting->update(['is_info_full_address_city' => 1, 'is_info_location' => 1, 'is_info_city_state' => 0, 'is_info_full_address' => 0]);
            }
        }

        if ($request->get('type') == 'physical_address') {

            if ($resume->resumeSetting->is_physical_address == 1) {
                $resume->resumeSetting->update(['is_physical_address' => false]);
            } else {
                $resume->resumeSetting->update(['is_physical_address' => true]);
            }
        }


        if ($request->get('type') == 'email') {

            if ($resume->resumeSetting->is_email == true) {
                $resume->resumeSetting->update(['is_email' => false]);
            } else {
                $resume->resumeSetting->update(['is_email' => true]);
            }
        }

        if ($request->get('type') == 'middle') {

            if ($resume->resumeSetting->is_middle == true) {
                $resume->resumeSetting->update(['is_middle' => false]);
            } else {
                $resume->resumeSetting->update(['is_middle' => true]);
            }
        }
        if ($request->get('type') == 'phone') {

            if ($resume->resumeSetting->is_phone == true) {
                $resume->resumeSetting->update(['is_phone' => false]);
            } else {
                $resume->resumeSetting->update(['is_phone' => true]);
            }
        }
        if ($request->get('type') == 'web') {
            if ($resume->resumeSetting->is_web == true) {
                $resume->resumeSetting->update(['is_web' => false]);
            } else {
                $resume->resumeSetting->update(['is_web' => true]);
            }
        }
        if ($request->get('type') == 'pro') {
            if ($resume->resumeSetting->is_pro == true) {
                $resume->resumeSetting->update(['is_pro' => false]);
            } else {
                $resume->resumeSetting->update(['is_pro' => true]);
            }
        }

        if (isset($request->endorsement_type)) {
            $resume->resumeSetting->update(['endorsement_type' => $request->endorsement_type]);
        }

        if(isset($request->resume_section)){
           ResumeSection::where('id',$request->resume_section['id'])->update(['title'=>$request->resume_section['title']]);
        }
        if(isset($request->endorsement_section)){
            Endorsement::where('job_id',$request->endorsement_section['job_id'])->where('id','!=',$request->endorsement_section['id'])->update(['status'=>0]);
          $endorsementData =   Endorsement::where('id',$request->endorsement_section['id'])->first();
                if ($endorsementData->status == 1) {
                    $endorsementData->status = 0;
                } else {
                    $endorsementData->status = 1;
                }
                 $endorsementData->save();
        }

        if(isset($request->experience_section)){
            $findExp = Experience::where('id',$request->experience_section['id'])->first();

            if ($findExp->status == 1) {
                    $findExp->status = 0;
                } else {
                    $findExp->status = 1;
                }
            $findExp->save();
        }
         if(isset($request->minor_section)){
            $findMinor = Minor::where('id',$request->minor_section['id'])->first();
            if ($findMinor->status == 1) {
                    $findMinor->status = 0;
                } else {
                    $findMinor->status = 1;
                }
            $findMinor->save();
        }

          if(isset($request->education_section)){
            $findExp = Education::where('id',$request->education_section['id'])->first();

            if ($findExp->status == 1) {
                    $findExp->status = 0;
                } else {
                    $findExp->status = 1;
                }
            $findExp->save();
        }

        $resumeData = $this->getResumeData($userID,$resumeId);
        $field_suggestions = FieldSuggestion::where('active', 1)->get();
        $resumeData['field_suggestions'] = $field_suggestions;
        return response()->json($resumeData);
    }

    public function resumeUpdate(Request $request)
    {
        Log::info('resumeUpdate', $request->all());
        $id = $request->session()->get('yak_user_id');
        $endorsements = Endorsement::where('user_id', $id);
        $endorsementData = Endorsement::where('id', $request->endorsement_id)->first();
        $endorsements->update(['top_endorsment_status'=>0]);

        if ($endorsementData->top_endorsment_status == 1) {
            $endorsementData->top_endorsment_status = 0;
        } else {
            $endorsementData->top_endorsment_status = 1;
        }
        $endorsementData->save();

        $resumeData = $this->getResumeData($id,$request->resume_id);
        return response()->json($resumeData);
    }

    public function resumeInformation(Request $request, $id,$resume_id)
    {
        Log::info('resumeInformation', $request->all());
        $id = $request->session()->get('yak_user_id');
        $resumeId = $resume_id;
        $user = User::find($id);
        if (blank($user)) {
            return response()->json(['error' => 1, 'Please add data in contacts first']);
        }

        Session::put('userId', $id);

        $jobs = Job::where('user_id', $user->id)->get();
        if (count($jobs) > 0) {

            $resumeSection = ResumeSection::where('type', 'work')->orderBy('id', 'DESC')->first();

            foreach ($jobs as $job) {

                $resumeJob = ResumeSectionJob::where('job_id', $job->id)->first();

                if (!$resumeJob) {
                    $resumeJob = new ResumeSectionJob();
                    $resumeJob->resumesection_id = $resumeSection->id;
                    $resumeJob->job_id = $job->id;
                    $resumeJob->endorsement_id = 1;
                    $resumeJob->order = 1;
                    $resumeJob->save();
                }
            }
        }
        $resumeData = $this->getResumeData($id, $resumeId);
        $field_suggestions = FieldSuggestion::where('active', 1)->get();
        $resumeData['field_suggestions'] = $field_suggestions;
        return response()->json($resumeData);
    }

    public function resumeQualificationStatement(Request $request)
    {
        //Response
        // array:7 [
        //     "id" => 7
        //     "resume_id" => 181
        //     "single_word" => "Hello"
        //     "position_sought" => "World"
        //     "level_or_exp" => "Teamdsdf"
        //     "prom_aspect" => "dfdsgfdsgcdsdsdf"
        //     "final_statement" => "Hello World Teamdsdf  dfdsgfdsgcdsdsdf"
        //   ]
        $userId = $request->session()->get('yak_user_id');
        $resumeId = $request->resume_id;
        $resumeQualStatement = QualificationStatement::where('resume_id', $request->resume_id)->first();

        if (blank($resumeQualStatement)) {
            $resumeQualStatement = new QualificationStatement();
        }

        $resumeQualStatement->resume_id = $request->resume_id;
        $resumeQualStatement->single_word = $request->single_word;
        $resumeQualStatement->position_sought = $request->position_sought;
        $resumeQualStatement->level_or_exp = $request->level_or_exp;
        $resumeQualStatement->prom_aspect = $request->prom_aspect;
        $resumeQualStatement->final_statement = $request->final_statement;
        $resumeQualStatement->save();

        $resumeData[] = $this->getResumeData($userId, $resumeId);
        $data = DB::table('field_suggestions')->get();
        $resumeData['field_suggestions'] = $data;

        return response()->json($resumeData);
    }


    public function getResumeData($userId, $resumeId = null)
    {
        $resume = Resume::with([
            'user.educations.minors',
            'user.educations.state',
            'job_descriptions',
            'user.countries',
            'resumeSkill',
            'user.kaun',
            'user.skills',
            'user.state',
            'font',
            'resumeSorting',
            'color',
            'template.fonts','template.colors',
            'user.endorsements.jobs', 'resumeSetting',
            'resumeSections.resumeSubSection.resumeExperience.experience',
            'resumeSections.resumeSubSection.eduSubSectionContent.subsection_content_able',
            'resumeSections.resumeSectionJob.job.position',
            'resumeSections.resumeSectionJob.job.country',
            'resumeSections.resumeSectionJob.job.stateRelation',
            'resumeSections.resumeSectionJob.job.experiences.resume_experience',
            'resumeSections.resumeSectionJob.job.endorsements',
            'resumeQualificationStatement',
            'resumeExperience.experience'
        ])
            ->where('user_id', $userId);
        if ($resumeId != null) {
            $resume->where('id', $resumeId);
        }

    return $resume->first();
    }

    public function updateResumeType(Request $request)
    {
        $resumeTypeUpdated = Resume::where('id', $request->resume_id)->update([
            'type' => $request->resume_type,
            'type_assessment' => $request->type_assessment_questions,
            'chronological_score' => $request->chronological_score,
        ]);

        if ($resumeTypeUpdated) {
            return response()->json([
                'status' => $resumeTypeUpdated,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'something went wrong'
            ]);
        }
    }
    public function storeEduSubSectionContent(Request $request){
         $id = $request->session()->get('yak_user_id');

        if($request->active){
            $orderBy = 1;
        $getData =  EduSubSectionContent::where('resume_subsection_id',$request->subsection_id)->orderBy('orderBy','desc')->first();

        if($getData){
                    $orderBy =  $getData->orderBy + 1;
            }else{
                    $orderBy = 1;
            }
        $model = '';
        if($request->type == 'ACADEMIC_ACHIVEMENTS' || $request->type == 'ACADEMIC_ORGANIZATIONS'  ){
            $model = 'App\Kaun';
            $save_content =  Kaun::where('id',$request->model_id)->first();
        }else if($request->type == 'skills'){
            $model = 'App\Skills';
            $save_content =  Skills::where('id',$request->model_id)->first();

        }else if($request->type == 'endorsement'){
            $model = 'App\Endorsement';
            $save_content =  Endorsement::where('id',$request->model_id)->first();
        }

        $save_content->subsection_content_type()->create([
            'user_id'=>$id,
            'resume_subsection_id'=>$request->subsection_id,
            'type'=>$request->type,
            'subsection_content_able_id'=>$request->model_id,
            'subsection_content_able_type'=>$model,
            'status'=>true,
            'orderBy'=>$orderBy
        ]);
        if($save_content){
            return response()->json(["status" => 1, "message" => "Success", "data" => $save_content]);
        }
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);

    }else{
      $findEdu =  EduSubSectionContent::where('id',$request->edu_subsection_id)->first();
      if($findEdu){
        $findEdu->delete();
            return response()->json(["status" => 1, "message" => "Success", "id" =>$request->edu_subsection_id ]);
       }
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);

    }
    }

    public function checkEduSubSectionContent(Request $request){
            $id = $request->session()->get('yak_user_id');
            $model = '';
            if($request->type == 'ACADEMIC_ACHIVEMENTS' || $request->type == 'ACADEMIC_ORGANIZATIONS'  ){
                $model = 'App\Kaun';
            }else if($request->type == 'skills'){
                $model = 'App\Skills';
            }else if($request->type == 'endorsement'){
                $model = 'App\Endorsement';
            }
            $findEdu =  EduSubSectionContent::
              where('type',$request->type)
            ->where('subsection_content_able_id',$request->model_id)
            ->where('subsection_content_able_type',$model)
            ->where('user_id',$id)
            ->first();
            if($findEdu){
                    return response()->json(["status" => true, "message" => "Success" ,
                    'eduSubSection_id'=>$findEdu->id]);
            }
            return response()->json(["status" => false, "message" => "failed" ]);

    }
     public function checkSkillSubSectionContent(Request $request){
        $id = $request->session()->get('yak_user_id');
        $model = 'App\Skills';
         $findEdu =  EduSubSectionContent::
              where('type',$request->type)
            ->where('subsection_content_able_id',$request->model_id)
            ->where('subsection_content_able_type',$model)
            ->where('user_id',$id)
            ->first();

         if($findEdu){
            return response()->json(["status" => true, "message" => "Success" ,
            'eduSubSection_id'=>$findEdu->id]);
      }
            return response()->json(["status" => false, "message" => "failed" ]);
    }
    public function deleteEduSubSectionContent(Request $request){
        $find =  ResumeSubSection::where('id',$request->id)->first();
        if($find){
            EduSubSectionContent::where('resume_subsection_id',$request->id)->delete();
            $find->delete();
            $id = $request->session()->get('yak_user_id');
            $resumeData = $this->getResumeData($id,$request->resume_id);
            return response()->json($resumeData);
        }
            return response()->json(["status" => false, "message" => "Some Error occurred at deleting education subsection" ]);


    }
     public function deleteNewSection(Request $request){
       $find =  ResumeSection::where('id',$request->id)->with('resumeSubSection.eduSubSectionContent')->first();

       if($find){
        $getResumeSubsection =  ResumeSubSection::where('resumesection_id',$find->id)->with(['eduSubSectionContent'])->get();
        if($getResumeSubsection->count() > 0){
            foreach($getResumeSubsection as $subsection)
                $subsection->eduSubSectionContent()->delete();
                $subsection->delete();
            }
         $find->delete();
        $id = $request->session()->get('yak_user_id');
        $resumeData = $this->getResumeData($id,$request->resume_id);
        return response()->json($resumeData);
       }
            return response()->json(["status" => false, "message" => "failed" ]);

    }
    public function resumeEduSubSectionUpdate(Request $request){

       $findSubSection =  ResumeSubSection::where('id',$request->resumeSubSection_id)->first();
       if($findSubSection){

            if($request->type == 'title'){
                $findSubSection->update(['title'=>$request->value]);
            }

            if($request->type == 'content'){
                $findSubSection->update(['content'=>$request->value]);
            }

             if($request->type == 'list_style'){
                $findSubSection->update(['list_style'=>$request->value]);
            }
                $id = $request->session()->get('yak_user_id');
                $resumeData = $this->getResumeData($id,$request->resume_id);
                return response()->json($resumeData);

        }

            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);

    }

    public function createEduSubSection(Request $request){
       try {
        $count = 0;
        $findSubSection =  ResumeSubSection::where('resumesection_id',$request->resumesection_id)->orderBy('order','desc')->first();
            if($findSubSection){
                $count = $findSubSection->order + 1;
            }else{
                $count = 1;
            }
        DB::table('resumesubsection')->insertGetId(
                    ['resumesection_id' => $request->resumesection_id,
                    'order' => $count,
                    'list_style'=>'vertical_bullets',
                    'hidden'=>'no',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()]
                );

        $id = $request->session()->get('yak_user_id');
        $resumeData = $this->getResumeData($id,$request->resume_id);
        return response()->json($resumeData);

        } catch (Exception $ex) {
        $id = $request->session()->get('yak_user_id');

            $resumeData = $this->getResumeData($id,$request->resume_id);
            return response()->json($resumeData);
        }

    }
    public function updateEduSubsection(Request $request){
          $getEdu =  EduSubSectionContent::where('id',$request->edu_id)->first();
           $orderBy = 1;
          if($getEdu){

                 $getData =  EduSubSectionContent::where('resume_subsection_id',$request->r_sub_id)->orderBy('orderBy','desc')->first();
                 if($getData){
                 $orderBy = $getData->orderBy + 1;
                 }else{
                      $orderBy = 1;
                 }


                $getEdu->update(['resume_subsection_id'=>$request->r_sub_id,'orderBy'=>$orderBy]);

                $id = $request->session()->get('yak_user_id');
                $resumeData = $this->getResumeData($id,$request->resume_id);
                return response()->json($resumeData);
            }
                return response()->json(["status" => 0, "message" => "Unknown Database Error"]);

    }
     public function createNewSection(Request $request){
       $order = 0;
       try {
        $findResume =   Resume::where('id',$request->resume_id)->first();
        $order =    $findResume->resumereview + 1;
        $findResume->update(['resumereview'=>$order]);
        $findSection = ResumeSection::where('resume_id',$request->resume_id)->select('order')->orderBy('order','desc')->first();
       if($findSection){
        $order = $findSection->order  + 1;
        $resumeSection = new ResumeSection();
        $resumeSection->resume_id = $request->resume_id;
        $resumeSection->title = $request->type ? 'Professional Summary' : 'Untitled Section';
        $resumeSection->type = $request->type ? 'professional-summary' : 'new-section';
        $resumeSection->content = '';
        $resumeSection->order = $order;
        $resumeSection->column = 1;
        $resumeSection->endorsement_id = 0;
        $resumeSection->hidden = 1;
        $resumeSection->save();
            if($resumeSection){
                // if(!$request->type){
                //     $id = DB::table('resumesubsection')->insertGetId(
                //         ['resumesection_id' => $resumeSection->id,
                //         'order' => 1,
                //         'list_style'=>'vertical_bullets',
                //         'hidden'=>'no',
                //         'created_at' => Carbon::now(),
                //         'updated_at' => Carbon::now()]
                //     );
                // }
            }
                    $id = $request->session()->get('yak_user_id');
                    $resumeData = $this->getResumeData($id,$request->resume_id);
                    return response()->json($resumeData);
        }
                     $id = $request->session()->get('yak_user_id');
                    $resumeData = $this->getResumeData($id,$request->resume_id);
                    return response()->json($resumeData);

        } catch (Exception $ex) {
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
        }

    }
    public function resumeNewSectionUpdate(Request $request){

       $findNewSection =  ResumeSection::where('id',$request->resumeSection_id)->with('resumeSubSection')->first();
       if($findNewSection){

            if($request->type == 'title'){
                $findNewSection->update(['title'=>$request->value]);
            }

            if($request->type == 'content'){
                $findNewSection->update(['content'=>$request->value]);
            }

             if($request->type == 'list_style'){
                $findNewSection->resumeSubSection()->update(['list_style'=>$request->value]);
            }

            $id = $request->session()->get('yak_user_id');
            $resumeData = $this->getResumeData($id,$request->resume_id);
            return response()->json($resumeData);
        }


            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);

    }
    public function createResExpSubSection(Request $request){
       $findResExp =  ResumeExperience::where('id',$request->res_exp_id)->first();

       if($findResExp){
            $findResExp->update(['resumesubsection_id'=>$request->subSection_id]);

             $id = $request->session()->get('yak_user_id');
            $resumeData = $this->getResumeData($id,$request->resume_id);
            return response()->json($resumeData);
        }
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
    }
    public function checkResExpSubSection(Request $request){
       $findResExp =  ResumeExperience::where('id',$request->res_exp_id)->first();

       if($findResExp){
          if($findResExp->resumesubsection_id !== null || $findResExp->resumesubsection_id != 0){
            return response()->json(["status" => true, "message" => "Success" ]);
            }
        }
         return response()->json(["status" => false, "message" => "Unknown Database Error"]);

    }
     public function removeResExpProSumSubSection(Request $request){
       $findResExp =  ResumeExperience::where('id',$request->res_exp_id)->first();
        if($findResExp){
             $findResExp->update(['resumesubsection_id'=>null]);

            // return response()->json(["status" => true, "message" => "Success" ]);
            }
            $id = $request->session()->get('yak_user_id');
        $resumeId = $request->resume_id;
       return (new MyResumeController())->getResumeData($id,$resumeId);
            //  return response()->json(["status" => false, "message" => "Unknown Database Error"]);
    }

     public function storeSkillSubSectionContent(Request $request){
        $id = $request->session()->get('yak_user_id');
        $orderBy = 1;
        $getData =  EduSubSectionContent::where('resume_subsection_id',$request->subsection_id)->orderBy('orderBy','desc')->first();

        if($getData){
                    $orderBy =  $getData->orderBy + 1;
            }else{
                    $orderBy = 1;
            }

        $model = 'App\Skills';
            $save_content =  Skills::where('id',$request->model_id)->first();

        $save_content->subsection_content_type()->create([
            'user_id'=>$id,
            'resume_subsection_id'=>$request->subsection_id,
            'type'=>$request->type,
            'subsection_content_able_id'=>$request->model_id,
            'subsection_content_able_type'=>$model,
            'status'=>true,
            'orderBy'=>$orderBy
        ]);
        if($save_content){
        $resumeId = $request->resume_id;
        $id = $request->session()->get('yak_user_id');
        return (new MyResumeController())->getResumeData($id,$resumeId);

            // return response()->json(["status" => 1, "message" => "Success", "data" => $save_content]);
        }
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);

    }
    public function getTemplateFonts(Request $request){
        dd($request->all());
    }
    public function updateUserPage(Request $request)
    {
        $page = $request->page;
        $yak_user_id = $request->session()->get('yak_user_id');
        if (!empty($page)) {
              DB::table('users')->where('id', $yak_user_id)->update(['page' => $page]);
              return response()->json(["status" => 1, "message" => "Page Updated successfully"]);
        }
        return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
    }

    public function updateResumeLastStep(Request $request)
    {
        $page = $request->page;
        $resume_id = $request->resume_id;
        $yak_user_id = $request->session()->get('yak_user_id');
        if (!empty($page) && !empty($resume_id)) {
            Resume::where('id',$resume_id)->where('user_id',$yak_user_id)->update(['last_step'=>$page]);
              return response()->json(["status" => 1, "message" => "Page Updated successfully",'page'=>$page]);
        }
        return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
    }

     public function updateResumeCurrentResumeId(Request $request)
    {

        $resume_id = $request->resume_id;
        $yak_user_id = $request->session()->get('yak_user_id');

        if (!empty($yak_user_id) && !empty($resume_id)) {
            // $getResume =   Resume::where('id',$resume_id)->select('position_id')->with(['position'])->first();
            // if($getResume && $getResume->position){
            //  $pos_name = $getResume->position->pos_name;
            // }
            User::where('id',$yak_user_id)->update(['current_resume_id'=>$resume_id]);
            return response()->json(["status" => 1 ,"message" => "Page Updated successfully"]);
        }
        return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
    }

    public function getTemplates(){
        $data = Template::where('active',1)->get();
        return response()->json(["status" => 1 ,"message" => "Templates found",'data'=>$data]);
    }

    public function resumeSectionHideShow(Request $request){
          $find =   ResumeSection::where('id',$request->section_id)->first();
                if($find ){
                   if($find->hidden == 0){
                   $find->update(['hidden'=>1]);
                }else{
                   $find->update(['hidden'=>0]);
                }
            }
              $resume_id = $request->resume_id;
              $id = $request->session()->get('yak_user_id');
              $resumeData = $this->getResumeData($id,$resume_id);
              return response()->json($resumeData);

    }
}