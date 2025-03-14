<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\EndorsementController;
use App\Http\Controllers\Frontend\MyResumeController;
use App\Http\Controllers\Frontend\JobDescriptionsController;
use App\Http\Controllers\Frontend\SuggestionController;
use App\Http\Controllers\Frontend\ScriptController;
use App\Http\Controllers\Frontend\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\SkillsController;
use App\Http\Controllers\ResumeSortingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api', 'web')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('payment/initiate', [StripeController::class, 'initiatePayment']);
Route::post('payment/complete', [StripeController::class, 'completePayment']);
Route::post('payment/failure', [StripeController::class, 'failPayment']);
// create customer stripe
// Route::post('customer/create', [StripeController::class, 'customerCreate']);
// Route::get('customer/retrieve/{account_id?}', [StripeController::class, 'customerRetrieve']);
 Route::post('customer/card/create', [StripeController::class, 'addCustomerStripeCard']);
// Route::post('customer/card/create/attach', [StripeController::class, 'attachCustomerStripeCard']);
 Route::post('customer/attach', [StripeController::class, 'customerAttach']);
// Route::post('createPaymentIntent', [StripeController::class, 'createPaymentIntent']);
//Route::post('get-single-customer-card', [StripeController::class, 'getSingleCard']);
Route::post('customer/delete/card', [SubscriptionController::class, 'deleteCustomerCard']);
Route::post('customer/edit/card', [SubscriptionController::class, 'editCustomerCard']);
Route::post('update-subscription', [SubscriptionController::class, 'updateSubscription']);
Route::post('add-customer-card', [SubscriptionController::class, 'addCustomerCard']);
Route::post('/replace-customer-card', [SubscriptionController::class, 'replaceCustomerCard']);
Route::post('/downgrade-subscription', [SubscriptionController::class, 'downgradeSubscription']);
// subscriptions
Route::post('/delete-subscription', [SubscriptionController::class, 'deleteOldSubscription'] );
Route::post('/delete-user', [SubscriptionController::class, 'deleteUser']);

Route::post('getSingleSubscription', [StripeController::class, 'getSingleSubscription']);
Route::post('createSubscription', [StripeController::class, 'createSubscription']);
// products
Route::post('createProduct', [StripeController::class, 'createProduct']);

// Route::post('/btn/contact', 'NavbarButtonController@contact');
// Route::POST('/btn/workhistory', 'NavbarButtonController@workhistory');
// Route::post('/btn/education', 'NavbarButtonController@education');
/*Auth Routes for api*/
Route::get('check_logged_in', [\App\Http\Controllers\Frontend\MyResumeController::class, 'checkLoggedIn']);
Route::post('logoutUser', [\App\Http\Controllers\UserController::class, 'logout']);
/*---------------Auth Routes for api--------*/
Route::post('update-resume-formatting', [\App\Http\Controllers\Frontend\MyResumeController::class, 'updateResumeFormatting']);
Route::post('update-section-column', [\App\Http\Controllers\Frontend\MyResumeController::class, 'updateResumeSectionColumns']);
Route::post('create-edu-sub-section', [\App\Http\Controllers\Frontend\MyResumeController::class, 'createEduSubSection']);
Route::post('create-new-section', [\App\Http\Controllers\Frontend\MyResumeController::class, 'createNewSection']);
Route::post('store-edu-subsection-content', [\App\Http\Controllers\Frontend\MyResumeController::class, 'storeEduSubSectionContent']);
Route::post('check-edu-subsection-content', [\App\Http\Controllers\Frontend\MyResumeController::class, 'checkEduSubSectionContent']);

Route::post('/save-endorsements', [\App\Http\Controllers\Frontend\EndorsementController::class, 'saveEndorsements']);
Route::post('/delete-endorsements', [\App\Http\Controllers\Frontend\EndorsementController::class, 'deleteEndorsements']);
Route::post('/get-endorsements', [EndorsementController::class, 'getEndorsements']);
Route::get('/get-endorsement-tooltip', [EndorsementController::class, 'getEndorsementTooltip']);
// api/get-title

Route::post('/get-title', [TitleController::class, 'getTitle']);
Route::post('/get-suggestion', [SuggestionController::class, 'getSingleWordSuggestion']);
// Route::get('db-fresh', [ScriptController::class, 'dbFresh']);
Route::get('del', [ScriptController::class, 'del']);
Route::get('cancel', [ScriptController::class, 'cancelSubscription']);


Route::get('sage', [ScriptController::class, 'sage']);

Route::get('/clear', function () {

    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    return 'Cache cleared.';
});
