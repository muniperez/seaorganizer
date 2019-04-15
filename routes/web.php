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

Route::get('/', function () {

	if(!Auth::check())	{
    	
    	return view('frontend.index');
	}
    else {	return redirect()->route('dashboard');
	
	}
});

Route::get('/home', function () { return redirect('/dashboard');});

Auth::routes();

/* Join with invite code */

Route::get('/invitation/{code}', 'Extras\UserInviteController@register');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

/* Front end pages */
	
	Route::get('/features', function () {
	    return view('frontend.features');
	});

	Route::get('/about', function () {
	    return view('frontend.about-us');
	});

	Route::get('/pricing', function () {
	    return view('frontend.pricing');
	});

	Route::get('/tos', function () {
	    return view('frontend.tos');
	});

	Route::get('/faq', function () {
	    return view('frontend.faq');
	});

	Route::get('/privacy', function () {
	    return view('frontend.privacy');
	});

	Route::get('/contact-us', 'ContactFormController@show')->name('contact');

	Route::post('/contact-us', 'ContactFormController@send');

	// All authenticated routes

	// Route::middleware(['auth'])->group( function() {

	// 	Route::get('/account/support', 'Extras\SupportController@create');
	// 	Route::get('/account/support/submited', 'Extras\SupportController@created');
	// 	Route::get('/account/support/form', 'Extras\SupportController@form');
	// });

	Route::middleware(['auth', 'subscription', 'onboarding'])->group( function() {

		/* Dashboard */
		Route::get('/dashboard', 'HomeController@index')->name('dashboard');

		/* Certificates */

			Route::get('/certificates', 'CertificateController@index')->name('certificates');

			Route::get('/certificates/add', 'CertificateController@create')->name('certificates.add');

			Route::get('/certificates/{certificate}', 'CertificateController@show')->middleware('can:view,certificate');

			Route::get('/certificates/{certificate}/edit', 'CertificateController@edit')->middleware('can:view,certificate');

			Route::post('/certificates', 'CertificateController@store');
			Route::patch('/certificates/{certificate}', 'CertificateController@update')->middleware('can:update,certificate');
			
			Route::get('/certificates/{certificate}/file', 'CertificateController@getFile')->middleware('can:view,certificate');
			Route::patch('/certificates/{certificate}/file', 'CertificateController@updateFile')->middleware('can:update,certificate');

			Route::get('/certificates/{certificate}/delete', 'CertificateController@promptDestroy')->middleware('can:view,certificate');
			Route::get('/certificates/{certificate}/archive', 'CertificateController@archive')->middleware('can:view,certificate');
			Route::delete('/certificates/{certificate}', 'CertificateController@destroy')->middleware('can:delete,certificate');

		/* Account */
			Route::get('/account', 'AccountController@show')->name('account');
			Route::get('/account/edit', 'AccountController@edit');
			Route::patch('/account/edit', 'AccountController@update');

		/* Phone validation */
			
			// Ask change phone number
			Route::get('/account/changePhone', 'AccountController@changePhone');

		/* User Settings */
			
			Route::get('/settings', 'SettingsController@show');

		/* Subscriptions */
			Route::get('/account/subscription', 'SubscriptionController@show');

			Route::get('/account/subscription/edit', 'SubscriptionController@edit');

			Route::patch('/account/subscription', 'SubscriptionController@update');

			Route::delete('/account/subscription', 'SubscriptionController@destroy');

			Route::get('/account/subscription/invoice/{invoice}', 'SubscriptionController@invoice');
			
		/* Invite code */

			Route::get('/account/invite', 'Extras\UserInviteController@show')->name('invite.view');
			Route::post('/account/invite', 'Extras\UserInviteController@sendInvitation');
			Route::get('/account/invite/hide', 'Extras\UserInviteController@hide')->name('invite.hide');

	});

	Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {

		/* Certificates API */

			// List certificates
			Route::get('certificates', 'CertificateController@json');

			// View certificate
			Route::get('certificate/{certificate}', 'CertificateController@show')->middleware('can:view,certificate');

			// Store a certificate
			Route::post('certificate', 'CertificateController@store');

			// Store a certificate file
			Route::post('certificate/{certificate}/file', 'CertificateController@updateFile')->middleware('can:update,certificate');

			// Delete a certificate file
			Route::delete('certificate/{certificate}/file', 'CertificateController@destroyFile')->middleware('can:delete,certificate');

			// Update a certificate
			Route::patch('certificate/{certificate}', 'CertificateController@update')->middleware('can:update,certificate');

			// Get all flags that a user has
			Route::get('flags', 'FlagController@json');

			// User settings
			Route::get('settings', 'UserSettingController@index');
			Route::get('settings/{key}', 'UserSettingController@show');
			Route::patch('settings/{key}', 'UserSettingController@update');

		/* Data API */

			Route::get('data/countries', 'Extras\CountriesController');
			Route::get('data/generateCountries', 'Extras\GenerateCountriesController');

			Route::get('data/dashboard/certificates', 'Api\DataController@certificatesExpiring');
			Route::get('data/dashboard/flags', 'Api\DataController@flags');
			Route::get('data/newsFeed', 'Api\DataController@newsFeed');

		/* Handle coupons */

		Route::get('coupon/check', 'Extras\CouponController@checkInvite');	// Check if user has coupons in session
		Route::post('coupon/apply', 'Extras\CouponController@apply');	// Check if a coupon is valid


		// Route::get('stripe', function()	{

		// 	$user = auth()->user();

		// 	\Stripe\Stripe::setApiKey(config('services.stripe.secret'));

		// 	$subscription = \Stripe\Subscription::retrieve($user->subscription('main')->stripe_id);

		// 	$subscription->coupon = 'helloworld2';
		// 	$subscription->save();
			
		// 	return $subscription;
		// });
	});

	Route::group(['prefix' => 'onboarding', 'middleware' => 'auth'], function() {

		/* Onboarding process */
			Route::get('/', 'OnboardingController')->name('onboarding');

			Route::get('location', 'Onboarding\PhoneController@add');
			Route::post('location', 'Onboarding\PhoneController@store');

			Route::get('validatePhone', 'Onboarding\PhoneController@add')->name('validatePhone');

			Route::post('validatePhone', 'Onboarding\PhoneController@check');

			Route::get('personal', 'Onboarding\PersonalController@add');
			Route::post('personal', 'Onboarding\PersonalController@store');

			Route::get('certificates', 'Onboarding\CertificateController@add');
			Route::post('certificates', 'Onboarding\CertificateController@store');
	});

	Route::group(['prefix' => 'subscription', 'middleware' => 'auth'], function()	{

		Route::get('/', 'SubscriptionController@index');

		Route::get('choose', 'SubscriptionController@create')->name('subscribe');
		Route::post('choose', 'SubscriptionController@store');

		Route::delete('/', 'SubscriptionController@destroy');
	});

	// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

	// 	/* Certificates API */

	// 		// List certificates
	// 		Route::get('users/settings', 'Admin\UserSettingsController@index');
	// 		Route::patch('users/settings/{key}', 'Admin\UserSettingsController@update');

	// });

	Route::get('calendar', 'Extras\CalendarController@getUrl')->middleware('auth');
	Route::get('calendar/{calendar}', 'Extras\CalendarController@listEvents');


/* E-mail validation */

	// Send code
	Route::get('/account/sendVerification/email', 'VerificationController@sendEmailCode')->middleware('auth');

	// Receive code
	Route::get('/account/validateEmail/{email_token}', 'VerificationController@verifyEmailCode');


	Route::post(
	    'stripe/webhook',
	    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
	);

	Route::group(['prefix' => 'panel', 'middleware' => 'can:accessAdmin'], function() {

			Route::get('/', 'Admin\AdminController@index')->name('admin');

			Route::get('coupons', 'Admin\CouponController@index');
			Route::post('coupons', 'Admin\CouponController@store');
			Route::patch('coupons/{coupon}', 'Admin\CouponController@activate');
			Route::delete('coupons/{coupon}', 'Admin\CouponController@destroy');

			Route::get('users', 'Admin\UserController@index');
			Route::post('users', 'Admin\UserController@store');

			Route::get('user_settings', 'Admin\UserSettingController@index');
	});
