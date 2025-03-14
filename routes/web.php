<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Country;
use App\Http\Controllers\Frontend\EducationController;
use App\Http\Controllers\Frontend\JobDescriptionsController;
use App\Http\Controllers\Frontend\MyResumeController;
use App\Http\Controllers\Frontend\ResumeType;
use App\Http\Controllers\Frontend\ScriptController;
use App\Http\Controllers\Frontend\SubscriptionController;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

Route::stripeWebhooks('stripe-webhook');

Route::get('/', 'Frontend\PagesController@index')->name('index');

Route::post('/savepage', 'Frontend\PagesController@savePage');

/** Country List */
Route::get('/countries', 'Frontend\ContactsController@countries');

/** States List */
Route::get('/states', 'Frontend\ContactsController@states');

/** Contact Save */
Route::post('/contact', 'Frontend\ContactsController@saveContact');
Route::get('/getcontact', 'Frontend\ContactsController@getContact');

/** Contact Save */
Route::post('/acc_tnc', 'Frontend\ContactsController@accTnc');

/** Save Work History */
Route::post('/workhisory', 'Frontend\ContactsController@saveWorkHisory');

/** Save Education History */
Route::post('/educationhistory', 'Frontend\EducationController@saveEducationHistory');

/** Get Education History */
Route::get('/educationhistory', 'Frontend\EducationController@getEducationHistory');

/** Get Work History */
Route::get('/workhisory', 'Frontend\ContactsController@getWorkHistory');

/** Delete Work History */
Route::delete('/workhisory', 'Frontend\ContactsController@deleteWorkHisory');

/** Delete Education */
Route::delete('/educationhistory', 'Frontend\EducationController@deleteEducationHistory');

/** Get Position Classifications */
Route::get('positions/{search1}', ['uses' => 'Frontend\ContactsController@getPositions']);

/** get school list */
Route::get('/school/{school_name}', 'Frontend\EducationController@getSchool');

/** Get education enhancemet */
Route::get('get_education_enhancement', 'Frontend\EducationEnhancementController@respondWithEducationEnhancement');

/** Add education enhancemet */
Route::post('add_education_enhancement', 'Frontend\EducationEnhancementController@postEducationEnhancement');


/** Get education enhancemet */
Route::get('/education_enhancement2', 'Frontend\EducationEnhancementController@respondWithEducationEnhancement');
Route::get('/education_enhacements_status/{user_id}', 'Frontend\EducationEnhancementController@education_enhacements_status');
Route::get('/get-education-enhancement/{user_id}/{resume_id}', 'Frontend\EducationEnhancementController@getEducationEnhancement');


Route::post('create_password', 'Frontend\MyResumeController@createPassword');

Route::post('reset_password', 'Frontend\MyResumeController@resetPassword');

//get position
Route::post('get-position', 'Frontend\MyResumeController@getPosition');

Route::post('save-resume', 'Frontend\MyResumeController@saveResume');
Route::post('save-resume-templates', 'Frontend\MyResumeController@saveResumeTemplate');

// get resume data
Route::POST('get-resume/{resume_id?}', 'Frontend\MyResumeController@getResume');

// delete resume data
Route::POST('delete-resume', 'Frontend\MyResumeController@deleteResume');

// Load resume
Route::POST('load-questions', 'Frontend\ExperienceFinder@questions');

// job data in dropdown
Route::get('get-job', 'Frontend\ExperienceFinder@GetJob');
Route::post('get-all-jobs', [JobDescriptionsController::class, 'getAllJobs']);


// Save Experience Finder
Route::POST('save-experience-finder', 'Frontend\ExperienceFinder@saveExperienceFinder');

// Edit Experience Finder
Route::POST('edit-experience-finder', 'Frontend\ExperienceFinder@editExperienceFinder');

// Delete Experience Finder
Route::POST('delete-experience-finder', 'Frontend\ExperienceFinder@deleteExperienceFinder');

// check next condition in exprience finder
Route::POST('check-next-condition', 'Frontend\ExperienceFinder@checkNextCondition');

// check next condition in exprience finder
Route::POST('show-more-question', 'Frontend\ExperienceFinder@showMoreQuestion');

// get skills data
Route::POST('get-skills', 'Frontend\SkillsController@getSkills');
Route::POST('get-user-skills', 'Frontend\SkillsController@getUserSkills');
Route::POST('add-user-skill', 'Frontend\SkillsController@addUserSkill');
Route::POST('delete-user-skill', 'Frontend\SkillsController@deleteUserSkill');
Route::POST('add-custom-skill', 'Frontend\SkillsController@addCustomSkill');

// Subscription data
Route::POST('change-resume-type', 'Frontend\SubscriptionController@changeResumeType');

/** Contact Page Route */
/*Route::group(['prefix' => 'contact'], function () {
    Route::get('', 'Frontend\ContactsController@create')->name('contact.create');
    //Route::post('store', 'Frontend\ContactsController@store')->name('contact.store');
});
*/

Route::get('/get_all_types/{resume_id}', 'Frontend\ResumeType@getAllTypes');
Route::post('/update-resume-type', 'Frontend\ResumeType@updateResumeType');

Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'Auth\LoginController@createLogin')->name('contact.create');
});

Route::post('/auth/login', 'Auth\LoginController@postLogin');

Route::post('/forgotpassword', 'Auth\LoginController@forgotPassword');

Route::post('/auth/reset_password', 'Auth\LoginController@resetPassword');

Route::post('/resetpw', 'Auth\LoginController@resetPassword');

Route::get('/auth/logout', 'Auth\LoginController@logout');

//Route::get('/contact/{vue_capture?}', 'Frontend\ContactsController@create')->where('vue_capture', 'new');
Route::get('/{vue_capture?}', 'Frontend\ContactsController@create')->where('vue_capture', '[\/\w\.-]*');
// Route::group(['middleware' => ['auth.jwt']], function () {
//     Route::get('/auth/logout', 'LoginController@logout');
// });


Route::get('/clear', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    return 'Cache cleared.';
});

Route::post('stripe-webhooks', [SubscriptionController::class, 'stripeWebhooks']);
