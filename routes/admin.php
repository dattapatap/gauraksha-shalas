<?php

use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CancellationPolicyController;
use App\Http\Controllers\Backend\DonorController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\PrivacyPolicyController;
use App\Http\Controllers\Backend\ProjectImageController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnAndRefundController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingPolicyController;
use App\Http\Controllers\Backend\TermsAndConditionController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\ImagesController;
use App\Http\Controllers\Backend\ServicesController;
use App\Http\Controllers\Backend\SevaController;
use App\Http\Controllers\Backend\SevaImageController;
use App\Http\Controllers\Backend\TrusteesController;
use App\Http\Controllers\Backend\VideosController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'admin', 'as'=>'admin.'], function() {

    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('login.post');

    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/request', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('password.email');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('admin/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.update');

    Route::group(['middleware'=>'admin'], function() {

        Route::get('/home', [DashboardController::class, 'index'])->name('home');

        Route::get('/chartdata', [DashboardController::class, 'getSalesChart']);
        Route::get('/topselling-products', [DashboardController::class, 'getTopSellingProducts']);


        // Route::get('/transactions', [TransactionController::class, 'index']);

        Route::get('/donations', [DonorController::class, 'donations']);
        Route::post('/donations/edit', [DonorController::class, 'editDonor'])->name('donation.edit');
        Route::post('/donations/update', [DonorController::class, 'updateDonor'])->name('donation.update');
        Route::get('/donations/show/{id}', [DonorController::class, 'viewDonor'])->name('donation.show');
        Route::get('/donations/downloadReceipt/{receipt_no}', [DonorController::class, 'downloadReceipt'])->name('donation.downloadReceipt');
        Route::post('/donations/sendMail', [DonorController::class, 'sendMail'])->name('donation.sendMail');


        Route::get('/donors-list', [DonorController::class, 'index']);

        Route::get('slider/change-status', [SliderController::class, 'changeStatus'])->name('slider.change-status');
        Route::resource('slider', SliderController::class);

        Route::get('images/change-status', [ImagesController::class, 'changeStatus'])->name('images.change-status');
        Route::resource('images', ImagesController::class);

        Route::get('videos/change-status', [VideosController::class, 'changeStatus'])->name('videos.change-status');
        Route::resource('videos', VideosController::class);


        Route::resource('abouts', AboutController::class);

        Route::get('trustees/change-status', [TrusteesController::class, 'changeStatus'])->name('trustees.change-status');
        Route::resource('/trustees', TrusteesController::class);



        Route::get('projects/change-status', [ProjectController::class, 'changeStatus'])->name('projects.change-status');
        Route::resource('/projects', ProjectController::class);

        // Project Images
        Route::get('projects/{slug}/gallery', [ProjectImageController::class, 'index'])->name('projects.gallery');
        Route::get('projects/{slug}/gallery/create', [ProjectImageController::class, 'create'])->name('projects.gallery.create');
        Route::post('projects/{slug}/gallery/store', [ProjectImageController::class, 'store'])->name('projects.gallery.store');
        Route::post('projects/gallery/delete', [ProjectImageController::class, 'destroy'])->name('projects.variants.delete');

        Route::get('sevas/change-status', [SevaController::class, 'changeStatus'])->name('sevas.change-status');
        Route::resource('/sevas', SevaController::class);
        // Seva Images
        Route::get('sevas/{slug}/gallery', [SevaImageController::class, 'index'])->name('sevas.gallery');
        Route::get('sevas/{slug}/gallery/create', [SevaImageController::class, 'create'])->name('sevas.gallery.create');
        Route::post('sevas/{slug}/gallery/store', [SevaImageController::class, 'store'])->name('sevas.gallery.store');
        Route::post('sevas/gallery/delete', [SevaImageController::class, 'destroy'])->name('sevas.gallery.delete');

        Route::resource('products', ProjectController::class);


        Route::get('/adopt-cow', [ServicesController::class, 'adoptCow']);
        Route::post('services/adopt-cow/update', [ServicesController::class, 'updateAdoptCow'])->name('adopt-cow.update');

        Route::get('/donations-form', [ServicesController::class, 'donations']);
        Route::post('services/donations-form/update', [ServicesController::class, 'updateDonationForm'])->name('donation-form.update');

        Route::get('/volunteer', [ServicesController::class, 'volunteer']);
        Route::post('services/volunteer/update', [ServicesController::class, 'updateVolunteerForm'])->name('volunteer.update');

        Route::resource('termsandcondition', TermsAndConditionController::class);
        Route::resource('cancellationpolicy', CancellationPolicyController::class);
        Route::resource('shippingpolicy', ShippingPolicyController::class);
        Route::resource('privacypolicy', PrivacyPolicyController::class);
        Route::resource('returnandrefund', ReturnAndRefundController::class);

        Route::get('blogs/change-status', [BlogController::class, 'changeStatus'])->name('blogs.change-status');
        Route::resource('blogs', BlogController::class);

        Route::get('testimonial/change-status', [TestimonialController::class, 'changeStatus'])->name('testimonial.change-status');
        Route::resource('testimonial', TestimonialController::class);



        Route::get('settings/profile', [DashboardController::class, 'avatar'])->name('settings.avatar');
        Route::post('settings/profile', [DashboardController::class, 'updateAvatar'])->name('settings.avatar');
        Route::post('settings/update-info', [DashboardController::class, 'updateProfile'])->name('settings.profile');

        Route::get('settings/mailsettings', [SettingController::class, 'mailsettings'])->name('settings.mailsettings');
        Route::post('settings/mailsettings', [SettingController::class, 'updateMailConfiguration'])->name('settings.updatemail');

        Route::get('settings/changepassword', [DashboardController::class, 'changepassword'])->name('settings.changepassword');
        Route::post('settings/changepassword', [DashboardController::class, 'updatepassword'])->name('settings.changepassword');


        Route::get('settings/appsettings', [SettingController::class, 'appsetting'])->name('settings.appsettings');
        Route::post('settings/appsettings/update', [SettingController::class, 'updateAppSetting'])->name('settings.appsettings.updateSettings');

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read-notification');
        Route::post('/mark-all-as-read', [NotificationController::class, 'markAsRead'])->name('mark-all-as-read-notification');



        // Reports
        Route::get('/reports/{category}', [ReportController::class, 'index']);
        Route::get('/reports/ajax/fetch', [ReportController::class, 'filterReports']);

        Route::post('/download/reports', [ReportController::class, 'downloadReport']);


        // Logout
        Route::post('/logout', [DashboardController::class, 'logoutAdmin'])->name('logout');
    });



});

