<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SevaController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about-us', [HomeController::class, 'aboutus']);

Route::get('/our-trustees', [HomeController::class, 'trustees']);

Route::get('/contact-us', [HomeController::class, 'contactus']);

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blog-detail/{slugs}', [BlogController::class, 'blogDetails']);

Route::get('/news', [BlogController::class, 'news']);
Route::get('/news-detail/{slugs}', [BlogController::class, 'newsDetails']);

Route::get('/events', [BlogController::class, 'events']);
Route::get('/event-detail/{slugs}', [BlogController::class, 'eventDetails']);

Route::get('/videos', [HomeController::class, 'videos']);
Route::get('/gallery', [HomeController::class, 'gallery']);


Route::get('/projects/{slugs}', [ProjectController::class, 'projects']);
Route::get('/sevas/{slugs}', [SevaController::class, 'sevas']);


Route::get('/service/adopt-cow', [ServicesController::class, 'adoptCow']);
Route::get('/service/volunteer', [ServicesController::class, 'volunteer']);
Route::get('/donate', [ServicesController::class, 'donate']);

Route::post('/enquiry-form', [ContactController::class, 'index'])->name('contact-form');

// Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');
// Route::get('/terms-and-conditions', [TermsAndConditionController::class, 'index'])->name('terms-and-conditions');
// Route::get('/shipping-policy', [ShippingPolicyController::class, 'index'])->name('shipping-policy');
// Route::get('/cancellation-policy', [CancellationPolicyController::class, 'index'])->name('cancellation-policy');
// Route::get('/returns-and-refunds', [ReturnAndRefundController::class, 'index'])->name('returns-and-refunds');
// Route::get('/dealers', [DealerController::class, 'index'])->name('dealers');


Route::post('/initilise-payment', [PaymentController::class, 'initilisePayment']);
Route::post('/payment-verify',[PaymentController::class,'paymentResponse']);


