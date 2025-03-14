<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::post('/builder/btn/contact', 'NavbarButtonController@contact');
// Route::get('/btn/contact', 'NavbarButtonController@contact');
// Route::post('btn/workhistory', 'NavbarButtonController@workhistory');
// Route::get('/btn/workhistory', 'NavbarButtonController@workhistory');
// Route::post('/btn/education', 'NavbarButtonController@education');
/** Home Page Route */
Route::get('/', 'Frontend\PagesController@index')->name('index');

Route::post('/builder/savepage','Frontend\PagesController@savePage');

/** Country List */
Route::get('/builder/countries', 'Frontend\ContactsController@countries');

/** States List */
Route::get('/builder/states', 'Frontend\ContactsController@states');

/** Contact Save */
Route::post('/builder/contact','Frontend\ContactsController@saveContact');

Route::get('/builder/getcontact','Frontend\ContactsController@getContact');

/** Contact Save */
Route::post('/builder/acc_tnc','Frontend\ContactsController@accTnc');

/** Save Work History */
Route::post('/builder/workhisory','Frontend\ContactsController@saveWorkHisory');

/** Save Education History */
Route::post('/builder/educationhistory','Frontend\EducationController@saveEducationHistory');

/** Get Education History */
Route::get('/builder/educationhistory','Frontend\EducationController@getEducationHistory');

/** Get Work History */
Route::get('/builder/workhisory','Frontend\ContactsController@getWorkHistory');

/** Delete Work History */
Route::delete('/builder/workhisory','Frontend\ContactsController@deleteWorkHisory');

/** Delete Education */
Route::delete('/builder/educationhistory','Frontend\EducationController@deleteEducationHistory');

/** Get Position Classifications */
Route::get('/builder/positions/{search1}',['uses' =>'Frontend\ContactsController@getPositions']);

/** get school list */
Route::get('/builder/school/{school_name}','Frontend\EducationController@getSchool');

/** Get education enhancemet */
Route::get('/builder/education_enhancement','Frontend\EducationEnhancementController@respondWithEducationEnhancement');

Route::get('/builder/education_enhacements_status/{user_id}','Frontend\EducationEnhancementController@education_enhacements_status');;
Route::get('/builder/get-education-enhancement/{user_id}/{resume_id}','Frontend\EducationEnhancementController@getEducationEnhancement');

Route::get('/builder/get-all-jobs/{user_id}}/{resume_id}','Frontend\JobDescriptionsController@getAllJobs');
Route::get('/get-resposibilities/{position_id_job}/{position_id_resume}','Frontend\JobDescriptionsController@getResposibilities');


Route::post('/builder/update_overallgpa','Frontend\EducationEnhancementController@update_overallgpa');
Route::post('/builder/update_totaloverallgpa','Frontend\EducationEnhancementController@update_totaloverallgpa');
Route::post('/builder/update_majorgpa','Frontend\EducationEnhancementController@update_majorgpa');
Route::post('/builder/update_totalmajorgpa','Frontend\EducationEnhancementController@update_totalmajorgpa');
Route::post('/builder/add_minor','Frontend\EducationEnhancementController@add_minor');
Route::post('/builder/remove_minor','Frontend\EducationEnhancementController@remove_minor');
Route::post('/builder/update_credits_completed_phrase','Frontend\EducationEnhancementController@update_credits_completed_phrase');
Route::post('/save_jobdescription','Frontend\JobDescriptionsController@save_jobdescription');
Route::post('/save-employment-description','Frontend\JobDescriptionsController@employment_description');

Route::post('/builder/add_achivements','Frontend\EducationEnhancementController@add_achivements');
Route::post('/builder/remove_achivements','Frontend\EducationEnhancementController@remove_achivements');
Route::post('/builder/add_organizations','Frontend\EducationEnhancementController@add_organizations');
Route::post('/builder/remove_organizations','Frontend\EducationEnhancementController@remove_organizations');

/** Add education enhancemet */
Route::post('/builder/add_education_enhancement','Frontend\EducationEnhancementController@postEducationEnhancement');

Route::post('/builder/create_password','Frontend\MyResumeController@createPassword');

Route::post('/builder/reset_password','Frontend\MyResumeController@resetPassword');

//get position
Route::post('/builder/get-position','Frontend\MyResumeController@getPosition');

Route::post('/builder/save-resume','Frontend\MyResumeController@saveResume');

// get resume data
Route::POST('/builder/get-resume','Frontend\MyResumeController@getResume');

// delete resume data
Route::POST('/builder/delete-resume','Frontend\MyResumeController@deleteResume');

// Load resume
Route::POST('/builder/load-questions','Frontend\ExperienceFinder@questions');

// job data in dropdown
Route::get('/builder/get-job','Frontend\ExperienceFinder@GetJob');

// Save Experience Finder
Route::POST('/builder/save-experience-finder','Frontend\ExperienceFinder@saveExperienceFinder');

// Edit Experience Finder
Route::POST('/builder/edit-experience-finder','Frontend\ExperienceFinder@editExperienceFinder');

// Delete Experience Finder
Route::POST('/builder/delete-experience-finder','Frontend\ExperienceFinder@deleteExperienceFinder');

// check next condition in exprience finder
Route::POST('/builder/check-next-condition','Frontend\ExperienceFinder@checkNextCondition');

// check next condition in exprience finder
Route::POST('/builder/show-more-question','Frontend\ExperienceFinder@showMoreQuestion');

// get skills data
Route::POST('/builder/get-skills','Frontend\SkillsController@getSkills');
Route::POST('/builder/get-user-skills','Frontend\SkillsController@getUserSkills');
Route::POST('/builder/add-user-skill','Frontend\SkillsController@addUserSkill');
Route::POST('/builder/delete-user-skill','Frontend\SkillsController@deleteUserSkill');
Route::POST('/builder/add-custom-skill','Frontend\SkillsController@addCustomSkill');

// Subscription data
Route::POST('/builder/change-resume-type','Frontend\SubscriptionController@changeResumeType');
Route::GET('/builder/subscription_list','Frontend\SubscriptionController@subscriptionList');
Route::POST('/builder/get_subscription_list','Frontend\SubscriptionController@getSubscriptionData');
Route::POST('/builder/add-subscription','Frontend\SubscriptionController@addSubscription');

/** Contact Page Route */
/*Route::group(['prefix' => 'contact'], function () {
    Route::get('', 'Frontend\ContactsController@create')->name('contact.create');
    //Route::post('store', 'Frontend\ContactsController@store')->name('contact.store');
});
*/

Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'Auth\LoginController@createLogin')->name('contact.create');
});


Route::post('/auth/login', 'Auth\LoginController@postLogin');

Route::post('/forgotpassword', 'Auth\LoginController@forgotPassword');

Route::post('/resetpw', 'Auth\LoginController@resetPassword');

Route::get('/auth/logout', 'Auth\LoginController@logout');



//Route::get('/contact/{vue_capture?}', 'Frontend\ContactsController@create')->where('vue_capture', 'new');
Route::get('/{vue_capture?}', 'Frontend\ContactsController@create')->where('vue_capture', '[\/\w\.-]*');
// Route::group(['middleware' => ['auth.jwt']], function () {
//     Route::get('/auth/logout', 'LoginController@logout');
// });