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

Route::GET('/', 'webapp\HomeController@index');
Route::GET('/index', 'webapp\HomeController@index');

Route::GET('/register', 'webapp\HomeController@register');
Route::POST('/sendotp', 'webapp\HomeController@sendotp');
Route::GET('/verify-email', 'webapp\HomeController@verifyemail');
Route::POST('/verifyuserotp', 'webapp\HomeController@verifyuserotp');
Route::GET('/resendotp', 'webapp\HomeController@resendotp');
Route::GET('/fill-details/{id}', 'webapp\HomeController@filluserdetails');
Route::POST('/registerform', 'webapp\HomeController@registerform');
Route::POST('/getuservehicledata', 'webapp\HomeController@getuservehicledata');

Route::POST('/checkotp/{id}', 'webapp\HomeController@checkotp');
Route::GET('/my-location/{id}', 'webapp\HomeController@mylocation');
Route::GET('/dashboard', 'webapp\UserController@dashboard');
Route::GET('/my-profile/{id}', 'webapp\UserController@myprofile');
Route::POST('/update-profile/{id}', 'webapp\UserController@updateprofile');
Route::POST('/saveuser', 'webapp\HomeController@saveuser');
Route::POST('/saveuserlocation/{id}', 'webapp\HomeController@saveuserlocation');

Route::GET('/login', 'webapp\HomeController@login');
Route::POST('/checklogin', 'webapp\HomeController@checklogin');

Route::GET('/create-listing', 'webapp\UserController@createlisting');
Route::POST('/savelisting', 'webapp\UserController@savelisting');

Route::GET('/all-listings', 'webapp\HomeController@alllistings');
Route::GET('/listing/{id}', 'webapp\HomeController@listing');

Route::GET('/my-listings', 'webapp\UserController@mylistings');
Route::GET('/edit-listing/{id}', 'webapp\UserController@editlisting');
Route::POST('/updatelisting/{id}', 'webapp\UserController@updatelisting');

Route::GET('/my-messages', 'webapp\UserController@mymessages');
Route::GET('/view-messages/{listingid}/{from}/{to}', 'webapp\UserController@viewmessages');
Route::POST('/sendmessage', 'webapp\UserController@sendmessage');
Route::GET('/faviourites', 'webapp\UserController@faviourites');
Route::GET('/listingremove/{id}', 'webapp\UserController@listingremove');
Route::GET('/addtofaviourite/{listingid}/{userid}', 'webapp\UserController@addtofaviourite');
Route::GET('/payment-verify', [
    'uses' => 'PaymentVerificationCOntroller@verify',
    'as' => 'payment.verify',
]);

Route::GET('/sellcar/{listingid}/{sellto}', 'webapp\UserController@sellcar');
Route::GET('/notifications', 'webapp\UserController@notifications');

Route::GET('/forgot-password', 'webapp\HomeController@forgotpassword');
Route::POST('/sendresetmail', 'webapp\HomeController@sendresetmail');

Route::GET('/change-password', 'webapp\HomeController@changepassword');
Route::GET('/reset-password', 'webapp\HomeController@resetpassword');
Route::POST('/changeuserpassword', 'webapp\HomeController@changeuserpassword');

Route::GET('/logout', 'webapp\HomeController@logout');

Route::get('handle-payment', 'webapp\PayPalPaymentController@handlePayment')->name('make.payment');

Route::get('cancel-payment', 'webapp\PayPalPaymentController@paymentCancel')->name('cancel.payment');

Route::get('payment-success', 'webapp\PayPalPaymentController@paymentSuccess')->name('success.payment');


//ADMIN
Route::GET('/admin', 'admin\LoginController@login');
Route::GET('/admin/login', 'admin\LoginController@login');
Route::POST('/admin/checklogin', 'admin\LoginController@checklogin');
Route::GET('/admin/dashboard', 'admin\HomeController@dashboard');
Route::GET('/admin/notifications', 'admin\AdminController@notifications');
//users
Route::GET('/admin/users', 'admin\UserController@users');
Route::POST('/admin/saveuser', 'admin\UserController@saveuser');
Route::GET('/admin/edituser/{id}', 'admin\UserController@edituser');
Route::POST('/admin/updateuser/{id}', 'admin\UserController@updateuser');
Route::GET('/admin/deleteuser/{id}', 'admin\UserController@deleteuser');
Route::GET('/admin/logout', 'admin\AdminController@logout');
Route::GET('/admin/adduser', 'admin\UserController@adduser');


Route::POST('/changepassword', 'admin\UserController@changepassword');

Route::GET('/admin/inactivestatus/{id}', 'admin\AdminController@inactivestatus');
Route::GET('/admin/activestatus/{id}', 'admin\AdminController@activestatus');

//Listings
Route::GET('/admin/addlisting', 'admin\ListingController@addlisting');
Route::POST('/admin/savelisting', 'admin\ListingController@savelisting');
Route::GET('/admin/listings', 'admin\ListingController@listings');
Route::GET('/admin/listing/{id}', 'admin\ListingController@listing');
Route::GET('/admin/editlisting/{id}', 'admin\ListingController@editlisting');
Route::POST('/admin/updatelisting/{id}', 'admin\ListingController@updatelisting');
Route::GET('/admin/deletelisting/{id}', 'admin\ListingController@deletelisting');
Route::GET('/admin/listinginactivestatus/{id}', 'admin\ListingController@listinginactivestatus');
Route::GET('/admin/listingactivestatus/{id}', 'admin\ListingController@listingactivestatus');

//about us
Route::GET('/about-us', 'webapp\HomeController@about');//displaying about page
Route::GET('/contact', 'webapp\HomeController@contact');//displaying contact page
