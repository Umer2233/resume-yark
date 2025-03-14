<?php
use App\NavbarButton;

use App\User;
use App\EduSubSectionContent;

if(!function_exists('contact_info')) {
    function contact_info()
    {
        $btn = NavbarButton::first();
        return $btn->contact_info;
    }
}
if(!function_exists('workhistory')) {
    function workhistory()
    {
        $btn =  NavbarButton::first();
        return $btn->work_history;
    }
}
if(!function_exists('education')) {
    function education()
    {
        $btn =  NavbarButton::first();
        return $btn->education;
    }
}
function getState($state_id){
   return DB::table('states')->where('id',$state_id)->first();
}
function getCountry($country_id){
   return DB::table('countries')->where('id',$country_id)->first();
}
function checkAccountStatus($id){
    if(Session::get('login_status')){
        return true;
    }
        return false;

//   return  User::where('id',$id)->where('password','!=' ,'')->first();
}
function getUser($id){
      return  User::where('id',$id)->with(['subscription_history'])->first();
}
function getUserSubscription($id){
    return DB::table('subscription_history')->where('user_id',$id)->orderBy('id','desc')->first();
}

function getRenewalDate($request,$user){
    $renewal_date  = '';
    if($request->billing_plan == 2){
        // if yearly
       $renewal_date = date('Y-m-d', strtotime("+1 year", strtotime($user->start_date)));
    }
    return $renewal_date;
}
function removeEduSubsectionContent($id,$subsection_content_able_id,$type){
 return               EduSubSectionContent::where('user_id',$id)
                    ->where('subsection_content_able_id',$subsection_content_able_id)
                    ->where('subsection_content_able_type',$type)
                    ->delete();
}

?>