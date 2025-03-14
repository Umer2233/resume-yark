<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use App\ResumeSection;
use App\ResumeSectionJob;
use App\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mockery\Exception;
use App\NavbarButton;
use Session,Validator;

class ContactsController extends Controller
{

    public function countries()
    {
        $countries = DB::table('countries')->select(array('id', 'country_name'))->get();
        $countryarray = array();
        foreach ($countries as $country) {
            $countryarray[$country->id] = $country->country_name;
        }
        return response()->json(["countries" => $countryarray]);
    }

    public function states()
    {

        $states = DB::table('states')->select(array('id', 'state'))->get();
        $statesarray = array();
        foreach ($states as $state) {
            $statesarray[$state->id] = $state->state;
        }
        return response()->json(["states" => $statesarray]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $currentUrl = $_SERVER['REQUEST_URI'];
        if(strpos($currentUrl, 'reset-password') !== false || strpos($currentUrl, 'forgotpassword') !== false ){
            $request->session()->put('acc_tnc',true);
        }
        if (!empty($request->session()->get('acc_tnc'))) {
            $FieldTips = DB::table('field_tips')->whereIn('page', ['contactInfo', 'workhistory', 'education'])->get();
            $fieldtipsarray = array();
            foreach ($FieldTips as $fieldTip) {
                $fieldtipsarray[$fieldTip->field] = $fieldTip->tip;
            }

            return view('frontend.pages.contacts.create', ['fieldtipsarray' => $fieldtipsarray]);

        }else {
            return redirect('/');
        }
    }

    public function getContact(Request $request)
    {
        $id = $request->session()->get('yak_user_id');
        try {
            $user_object = DB::table('users')->where('id', '=', $id)->get();
            if (!$user_object->isEmpty()) {
                return response()->json(["status" => 1, "message" => "", "user" => $user_object]);
            } else {
                return response()->json(["status" => 0, "message" => "Empty"]);
            }
        } catch (Exception $ex) {
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
        }
    }

    public function saveContact(Request $request)
    {
        // dd('asdasd');
        $FirstName = $request->input('FirstName');
        $LastName = $request->input('LastName');
        $Middle = $request->input('Middle');
        $StreetAddress = $request->input('StreetAddress');
        $City = $request->input('City');
        $state = $request->input('state');
        $country = $request->input('country');
        $PostalCode = $request->input('PostalCode');
        $Phone = $request->input('Phone');
        $EmailAddress = $request->input('EmailAddress');
        $Profile = $request->input('Profile');
        $Website = $request->input('Website');
        $Page = $request->input('Page');
        try {
            $yak_user_id = $request->session()->get('yak_user_id');

            $user_object = DB::table('users')->where('id', '=', $yak_user_id)->get();

            Session::put('workhistory', 'true');

            if ($user_object->isEmpty()) {
                $user_object2 = DB::table('users')->where('email', '=', $EmailAddress)->get();
                if ($user_object2->isEmpty()) {
                    $id = DB::table('users')->insertGetId(
                        ['first_name' => $FirstName,'subscription_id'=>1,'subscription_frequency'=>'free', 'middle_initial' => $Middle, 'last_name' => $LastName, 'street_address' => $StreetAddress, 'city' => $City, 'state' => $state, 'country' => $country, 'postal_code' => $PostalCode, 'phone' => $Phone, 'email' => $EmailAddress, 'professional_profile' => $Profile, 'website' => $Website, 'page' => $Page, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
                    );
                    if (!empty($id)) {
                        //var_dump("test");
                        $request->session()->put('yak_user_id', $id);
                        return response()->json(["status" => 1, "message" => ""]);
                    } else {
                        //var_dump("test");
                        return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
                    }
                } else {
                    return response()->json(["status" => 0, "message" => "Email already exist"]);
                }
            } else {
                if (!empty($yak_user_id)) {
                    //DB::enableQueryLog();
                    DB::table('users')->where('id', "=", $yak_user_id)->update(['first_name' => $FirstName, 'middle_initial' => $Middle, 'last_name' => $LastName, 'street_address' => $StreetAddress, 'city' => $City, 'state' => $state, 'country' => $country, 'postal_code' => $PostalCode, 'phone' => $Phone, 'email' => $EmailAddress, 'professional_profile' => $Profile, 'website' => $Website, 'updated_at' => Carbon::now()]);
                    //$query = DB::getQueryLog();
                    //print_r($query);
                    return response()->json(["status" => 1, "message" => ""]);
                } else {
                    return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
                }
            }
        } catch (Exception $ex) {
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
        }
        //var_dump($FirstName);

    }

    public function deleteWorkHisory(Request $request)
    {

        $db_id = $request->input('db_id');
        $r_id = $request->input('r_id');

        $yak_user_id = $request->session()->get('yak_user_id');
        if (!empty($yak_user_id)) {
            try {

            if($r_id){
                $findResSection =  ResumeSection::where('resume_id',$r_id)->where('type','work')->first();
                if($findResSection){
                    $rs_id =   $findResSection->id;
                    ResumeSectionJob::where('resumesection_id',$rs_id)->where('job_id',$db_id)->delete();
                }
            }
                DB::table('job')->where('id', $db_id)->delete();

                return response()->json(["status" => 1, "message" => ""]);
            } catch (Exception $ex) {
                return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
            }
        }
    }

    public function getPositions($search)
    {
        // dd($search);
        //        $search = $request->input('search');
        if (!empty($search)) {
            try {
                //                DB::enableQueryLog();
                $positions = DB::table('title')->join('title_position', 'title_position.title_id', '=', 'title.id')
                    ->join('position', 'position.id', '=', 'title_position.position_id')
                    ->select(['position.id', 'position.pos_name', 'position.pos_description', 'title.title', 'title.id as titleid'])
                    ->where('title_position.is_active', '1')
                    ->where('position.is_active', '1')->where('title.is_active', '1')->where('title.title', 'like', "%$search%")->get();
                //                $query = DB::getQueryLog();
                //                print_r($query);

                if (!empty($positions)) {
                    if (count($positions) > 0) {
                        return response()->json(["status" => 1, "message" => "", "positions" => $positions]);
                    } else {
                        return response()->json(["status" => 0, "message" => "no positions"]);
                    }
                } else {
                    return response()->json(["status" => 0, "message" => "no positions"]);
                }
            } catch (Exception $ex) {
                return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
            }
        } else {
            return response()->json(["status" => 0, "message" => "empty search"]);
        }
    }

    public function getWorkHistory(Request $request)
    {
        $yak_user_id = $request->session()->get('yak_user_id');
        if (!empty($yak_user_id)) {
            try {
                //DB::enableQueryLog();
                $saved_jobs = DB::table('job')
                    ->join('title', 'job.title_id', '=', 'title.id')
                    ->select(['job.id', 'job.position_id', 'job.company', 'job.position', 'job.city', 'job.state', 'job.country', 'job.start_month', 'job.start_year', 'job.end_month', 'job.end_year', 'title.title', 'title.id as titleid'])->where('job.user_id', $yak_user_id)->orderBy('job.end_date', 'DESC')->orderBy('job.start_date', 'DESC')->get();
                //$query = DB::getQueryLog();
                //print_r($query);
                $users = DB::table('users')
                    ->select(['users.page'])->where('users.id', $yak_user_id)->get();

                if (!empty($saved_jobs)) {
                    if (count($saved_jobs) > 0) {
                        return response()->json(["status" => 1, "message" => "", "jobs" => $saved_jobs, "users" => $users]);
                    } else {
                        return response()->json(["status" => 0, "message" => "1 no saved jobs"]);
                    }
                } else {
                    return response()->json(["status" => 0, "message" => "2 no saved jobs"]);
                }
            } catch (Exception $ex) {
                return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
            }
        } else {
            return response()->json(["status" => 0, "message" => "User session expired"]);
        }
    }

    public function saveWorkHisory(Request $request)
    {
            $validator = Validator::make($request->all(), [
                // 'TitleID' => 'required',
                'PositionClassificationID'=>'required'

            ], [
                // 'TitleID.required' => 'The TitleID field is required.',
                'PositionClassificationID.required' => 'Position Classification field is required.Select option from dropdown'

            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }


        $Company = $request->input('Company');
        $Position = $request->input('Position');
        $PositionClassificationID = $request->input('PositionClassificationID');
        $TitleID = $request->input('TitleID');
        $City = $request->input('City');
        $State = $request->input('State');
        $Country = $request->input('Country');
        $StartMonth = $request->input('StartMonth');
        $StartYear = $request->input('StartYear');
        $Startdate = "$StartYear-$StartMonth-01";
        $EndMonth = $request->input('EndMonth');
        $EndYear = $request->input('EndYear');
        $Enddate = "$EndYear-$EndMonth-01";
        $db_id = $request->input('db_id');
        $Page = $request->input('Page');
        $yak_user_id = $request->session()->get('yak_user_id');

        try {
            $getResumes =  Resume::where('user_id',$yak_user_id)->get();

            if (empty($db_id)) {

                $id = DB::table('job')->insertGetId(
                    ['user_id' => $yak_user_id, 'position_id' => $PositionClassificationID, 'title_id' => $TitleID, 'company' => $Company, 'position' => $Position, 'city' => $City, 'state' => $State, 'country' => $Country, 'start_month' => $StartMonth, 'start_year' => $StartYear, 'end_month' => $EndMonth, 'end_year' => $EndYear, 'start_date' => $Startdate, 'end_date' => $Enddate, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
                );
               if($id && count($getResumes) > 0){
                $this->insertJobInAllResWorkSection($id,$yak_user_id,$getResumes);
               }

                if (!empty($Page)) {
                    DB::table('users')->where('id', $yak_user_id)->update(['page' => $Page]);
                }
            } else {
                $id = $db_id;
                DB::table('job')->where('id', $db_id)->update(['company' => $Company, 'position' => $Position, 'city' => $City, 'state' => $State, 'country' => $Country, 'start_month' => $StartMonth, 'start_year' => $StartYear, 'end_month' => $EndMonth, 'end_year' => $EndYear, 'start_date' => $Startdate, 'end_date' => $Enddate, 'updated_at' => Carbon::now()]);
                if (!empty($Page)) {
                    DB::table('users')->where('id', $yak_user_id)->update(['page' => $Page]);
                }
            }
            if (!empty($id)) {
                return response()->json(["status" => 1, "message" => "", "db_id" => "$id"]);
            } else {
                return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
            }
        } catch (Exception $ex) {
            return response()->json(["status" => 0, "message" => "Unknown Database Error"]);
        }
    }
    public function insertJobInAllResWorkSection($job_id,$user_id,$getResumes){
       try{
            foreach($getResumes as $resume){
                $workResSection = ResumeSection::where('type','work')->where('resume_id',$resume->id)->first();
               if($workResSection){
                  $findSectionJob  = ResumeSectionJob::where('resumesection_id',$workResSection->id)->where('job_id',$job_id)->first();
                    if(!$findSectionJob){
                            $resumeJob = new ResumeSectionJob();
                            $resumeJob->resumesection_id = $workResSection->id;
                            $resumeJob->job_id = $job_id;
                            $resumeJob->endorsement_id = $resume->id;
                            $resumeJob->order = 1;
                            $resumeJob->save();
                    }
               }
            }
   } catch (Exception $ex) {
        return false;
   }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $FieldTips = DB::table('field_tips')->where('page','contactProfile')->get();
        $fieldtipsarray = array();
        foreach ($FieldTips as $fieldTip){
            $fieldtipsarray[$fieldTip->field] = $fieldTip->tip;
        }
        var_dump($fieldtipsarray);
        */
        //return view('frontend.pages.contacts.store',['fieldtipsarray' => $fieldtipsarray]);
        return view('frontend.pages.contacts.store');
    }

    public function accTnc(Request $request)
    {
        $request->session()->put('acc_tnc', true);
        return response()->json(["status" => 1, "message" => ""]);
    }
}