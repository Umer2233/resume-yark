<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\ResetPassword;
use Illuminate\Support\Facades\Auth;
// use DB;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  // use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  // protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function postLogin(Request $request)
  {
    $credentials = $request->only('email', 'password');
    $find  = User::where('email',$request->email)->where('deleted',1)->first();
    if($find){
      return response()->json([
        'success' => false,
        'errors' => [
          'message' => [
            'Email is deleted'
          ]
        ],
      ]);
    }
    try {
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json([
          'success' => false,
          'errors' => [
            'message' => [
              'Either Email or Password Invalid'
            ]
          ],
        ]);
      }
    } catch (JWTException $e) {
      return response()->json([
        'success' => false,
        'errors' => [
          'message' => [
            'Either Email or Password Invalid'
          ]
        ],
      ]);
    }

    return $this->respondWithToken($token);
  }

  protected function respondWithToken($token, $id = '')
  {
    if ($id !== '') {
      $id = $id;
    } else {
      $id = Auth::user()->id;
      Session::put('yak_user_id', $id);
      Session::put('acc_tnc', true);
    }

    $user = User::leftJoin('education', function ($join) {
      $join->on('users.id', '=', 'education.user_id');
    })
      ->leftJoin('kaun', function ($join) {
        $join->on('users.id', '=', 'kaun.user_id');
      })
      ->leftJoin('minor', function ($join) {
        $join->on('education.id', '=', 'minor.education_id');
      })
      ->where('users.id', $id)
      ->first();
    $user['tips'] = DB::table('field_tips')->where('page', 'education enhancements')->get();
    $educationData = DB::table('education')->select('school.name as name', 'education.*')
      ->leftJoin('school', function ($join) {
        $join->on('school.id', '=', 'education.school_id');
      })->where('user_id', $id)->orderBy('grad_date', 'desc')->get();
    $minorDatePush = array();
    foreach ($educationData as $key => $value) {
      $minorDate = DB::table('minor')->where('education_id', $value->id)->get();
      array_push($minorDatePush, $minorDate);
    }
    $user['minorDatePush'] = $minorDatePush;
    $user['educationData'] = $educationData;
    $education = DB::table('education')->where('user_id', $id)->get();
    $currDate = date('Y-m-d');
    $data = array();
    foreach ($education as $key => $value) {
      $fdate = $value->grad_date;
      $tdate = $currDate;
      $datetime1 = new DateTime($fdate);
      $datetime2 = new DateTime($tdate);
      $interval = $datetime1->diff($datetime2);
      $days = $interval->format('%a');
      $years_remaining = intval($days / 365);
      array_push($data, $years_remaining);
    }
    $isGrade = false;
    $i = 0;
    $isCheck = array();
    foreach ($data as $key => $val) {
      if ($val <= 5) {
        $i++;
        array_push($isCheck, $i);
      }
    }
    if (count($isCheck) == count($data)) {
      $isGrade = true;
    }
    if (in_array(5, $data)) {
      $grad_Date = true;
    } else {
      $grad_Date = false;
    }

    $user['isGrade'] = $isGrade;
    $user['isgradDate'] = $grad_Date;
    // Get resume ID
    $resume = DB::table('resumes')->where('user_id', $id)->first();
    // if($resume){
    if($token){
       Session::put('login_status', true);
      // $user['resume_id'] = $resume->id;
      // $user['resume_name'] = $resume->name;

      return response()->json([
        'success' => true,
        'access_token' => $token,
        'user' => $user,
        'token_type' => 'bearer',
      ]);
    }
   return response()->json([
      'success' => false,
      'access_token' => '',
      'user' => '',
      'token_type' => 'bearer',
    ]);

  }
  public function logout()
  {
    // \JWTAuth::invalidate(\JWTAuth::getToken());
    // return response()->json([
    //   'success' => true
    // ]);

    auth()->logout();
    return response()->json([
      'success' => true
    ]);
  }

  public function createLogin(Request $request)
  {

    // if(!empty($request->session()->get('yak_user_id'))) {
    //   return redirect('/contact/#/new');
    // }
    $FieldTips = DB::table('field_tips')->whereIn('page', ['contactInfo', 'workhistory', 'education'])->get();
    $fieldtipsarray = array();
    foreach ($FieldTips as $fieldTip) {
      $fieldtipsarray[$fieldTip->field] = $fieldTip->tip;
    }
    return view('frontend.pages.contacts.create', ['fieldtipsarray' => $fieldtipsarray]);
  }

  function crypto_rand_secure($min, $max)
  {
    $range = $max - $min;
    if ($range < 0) return $min; // not so random...
    $log = log($range, 2);
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
      $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
      $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd >= $range);
    return $min + $rnd;
  }

  public function getToken($length = 32)
  {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    for ($i = 0; $i < $length; $i++) {
      $token .= $codeAlphabet[$this->crypto_rand_secure(0, strlen($codeAlphabet))];
    }
    return $token;
  }

  public function forgotPassword(request $request)
  {
    $EmailAddress = $request->input('email');
    $userEmail = DB::table('users')->where('email', '=', $EmailAddress)->get();
    if ($userEmail->isEmpty()) {
      return response()->json(["status" => 0, "error" => "Email not found"]);
    } else {
      $ResetPassword = new ResetPassword;
      $ResetPassword->email = $request->email;
      $ResetPassword->token = $this->getToken();
      $ResetPassword->save();

      $data = [
        'first_name' => $userEmail[0]->first_name,
        'last_name' => $userEmail[0]->last_name,
        'email' => $userEmail[0]->email,
        'year' => date('Y'),
        'token' => $ResetPassword->token
      ];
      try{

      Mail::send('Email.password_reset_email', $data, function ($message) use ($request) {
        $message->to($request->email)->subject('Welcome to the Best Online Resume Builder');
        $message->from('jseiter@resumeyak.com', 'Resume Yak');
      });
      }catch(Exception $e){
        Log::info($ex);

        return response()->json([
        'success' => false,
        'status' => 0,
        'message'=>'Email not sent!'
      ]);
      }
      return response()->json([
        'success' => true,
        'status' => 1
      ]);
    }
  }

  public function resetPassword(request $request)
  {
    $ResetPassword = new ResetPassword;
    $userData = ResetPassword::where('token', '=', $request->token)->first();

    $currentDate = date('Y-m-d H:i:s');
    if ($userData) {
      $diff_in_minutes = $userData->created_at->diffInMinutes($currentDate);
      $user = User::where('email', '=', $userData->email)->first();
      $user->update([
        'password' => Hash::make($request->password)
      ]);
    }
    if (empty($userData)) {
      return response()->json([
        'success' => true,
        'status' => 0,
        'msg' => 'Your create password link is not verified'
      ]);
    } else if ($diff_in_minutes < 60) {
      return response()->json([
        'success' => true,
        'status' => 1,
        'id' => $user->id
      ]);
    } else {
      return response()->json([
        'success' => true,
        'msg' => "Your Session expire, You have to request again to forgot password",
        'status' => 0,
        'id' => $user->id
      ]);
    }
  }
}