<?php

use App\Http\Controllers\Admin\About\AdminAboutCategoryController;
use App\Http\Controllers\Admin\About\AdminAboutController;
use App\Http\Controllers\Admin\AdminAppealController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\VolunteerController;
use App\Http\Controllers\Front\PhotoController;
use App\Http\Controllers\Front\VideoController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\CauseController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\TermsController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminCounterController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminVolunteerController;
use App\Http\Controllers\Admin\AdminPhotoCategoryController;
use App\Http\Controllers\Admin\AdminPhotoController;
use App\Http\Controllers\Admin\AdminVideoCategoryController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Admin\AdminPostCategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCauseController;
use App\Http\Controllers\Admin\AdminExecutiveController;
use App\Http\Controllers\Admin\AdminFacilityController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminOrphanController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminOtherPageController;
use App\Http\Controllers\Admin\AdminPagesBannerController;
use App\Http\Controllers\Admin\AdminProgramController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Front\AppealController;
use App\Http\Controllers\Front\ExecutiveController;
use App\Http\Controllers\Front\ProgramController;
use App\Http\Controllers\Front\TestimonialController;

require __DIR__.'/auth.php';

/* Front */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about/who-we-are', [AboutController::class, 'index'])->name('about');
Route::get('/about/history', [AboutController::class, 'history'])->name('about.history');

Route::get('/appeals', [AppealController::class, 'index'])->name('appeals.index');
Route::get('/appeals/{appeal:slug}', [AppealController::class, 'show'])->name('appeals.show');

// Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');

Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact');
    Route::post('/send-message', [ContactController::class, 'sendMessage'])->name('contact.send-message');
});

Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::prefix('executive')->group(function () {
    Route::get('/', [ExecutiveController::class, 'index'])->name('executive.index');
    Route::get('/{executive}', [ExecutiveController::class, 'show'])->name('executive.show');
});

// Route::prefix('volunteer')->group(function () {
//     Route::get('/', [VolunteerController::class, 'index'])->name('volunteer.index');
//     Route::get('/{volunteer}', [VolunteerController::class, 'show'])->name('volunteer.show');
//     Route::get('/create', [VolunteerController::class, 'create'])->name('volunteer.create');
//     Route::post('/store', [VolunteerController::class, 'store'])->name('volunteer.store');
// });
Route::resource('volunteer', VolunteerController::class);

Route::prefix('gallery')->group(function () {
    Route::get('/photo', [PhotoController::class, 'index'])->name('gallery.photo');
    Route::get('/video', [VideoController::class, 'index'])->name('gallery.video');
});

// Route::prefix('successful-story')->group(function () {
//     Route::get('/', [PostController::class, 'index'])->name('post.index');
//     Route::get('/{post_slug}', [PostController::class, 'show'])->name('post.show');
//     Route::get('/category/{category_slug}', [PostController::class, 'category'])->name('post.category');
//     Route::get('/tag/{tag_name}', [PostController::class, 'tag'])->name('post.tag');
//     Route::prefix('comment')->group(function () {
//         Route::post('/submit', [PostController::class, 'commentSubmit'])->name('post.comment.submit');
//         Route::post('/reply', [PostController::class, 'commentReply'])->name('post.comment.reply');
//     });
// });

Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/successful-stories', [PostController::class, 'successfulStory'])->name('successful.stories');
    Route::get('/{post_slug}', [PostController::class, 'show'])->name('post.show');
    Route::get('/successful-stories/{post_slug}', [PostController::class, 'showStory'])->name('successful-story.show');
    Route::get('/category/{category_slug}', [PostController::class, 'category'])->name('post.category');
    Route::get('/tag/{tag_name}', [PostController::class, 'tag'])->name('post.tag');
    Route::prefix('comment')->group(function () {
        Route::post('/submit', [PostController::class, 'commentSubmit'])->name('post.comment.submit');
        Route::post('/reply', [PostController::class, 'commentReply'])->name('post.comment.reply');
    });
});

Route::prefix('news')->group(function () {
    Route::get('/', [PostController::class, 'news'])->name('news.index');
    Route::get('/{news_slug}', [PostController::class, 'showNews'])->name('news.show');
});

Route::prefix('programs')->group(function () {
    Route::get('/', [ProgramController::class, 'index'])->name('programs.index');
    Route::get('/{programs_slug}', [ProgramController::class, 'show'])->name('programs.show');
    Route::post('/send-message', [ProgramController::class, 'sendMessage'])->name('programs.send-message');
    Route::prefix('ticket')->group(function () {
        Route::prefix('payment')->group(function () {
            Route::post('/', [ProgramController::class, 'payment'])->name('programs.ticket.payment');
            Route::get('/cancel', [ProgramController::class, 'paymentCancel'])->name('programs.ticket.payment.cancel');
            Route::get('/paypal', [ProgramController::class, 'paymentPaypal'])->name('programs.ticket.payment.paypal');
            Route::get('/stripe', [ProgramController::class, 'paymentStripe'])->name('programs.ticket.payment.stripe');
        });
        // Route::get('/invoice/{program:slug}', [ProgramController::class, 'ticketInvoice'])->name('programs.ticket.invoice');
        Route::post('/free-booking', [ProgramController::class, 'freeBooking'])->name('programs.ticket.free-booking');
    });
});

Route::get('/donate', [CauseController::class, 'donate'])->name('donate.index');
Route::prefix('cause')->group(function () {
    Route::get('/', [CauseController::class, 'index'])->name('cause.index');
    Route::get('/{slug}', [CauseController::class, 'show'])->name('cause.show');
    Route::get('/{slug}/donate', [CauseController::class, 'donate'])->name('donate.show');
    Route::post('/send-message', [CauseController::class, 'sendMessage'])->name('cause.send-message');

    Route::prefix('donation/payment')->group(function () {
        Route::post('/', [CauseController::class, 'payment'])->name('donation.payment');
        Route::get('/cancel', [CauseController::class, 'paymentCancel'])->name('donation.payment.cancel');
        Route::get('/paypal', [CauseController::class, 'paymentPaypal'])->name('donation.payment.paypal');
        Route::get('/stripe', [CauseController::class, 'paymentStripe'])->name('donation.payment.stripe');
    });
});

Route::get('/terms-and-conditions', [TermsController::class, 'index'])->name('terms');
Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy');

// Route::prefix('subscriber')->group(function () {
//     Route::post('/submit', [SubscriberController::class, 'subscriberSubmit'])->name('subscriber.submit');
//     Route::get('/verify/{email}/{token}', [SubscriberController::class, 'subscriberVerify'])->name('subscriber.verify');
// });
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/testimonials/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');

/* User */
Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::prefix('profile')->group(function () {
        Route::get('/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
        Route::patch('/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    });
    Route::prefix('program/ticket')->group(function () {
        Route::get('/', [UserController::class, 'programTicket'])->name('user.program.ticket');
        Route::get('/invoice/{invoice_id}', [UserController::class, 'programTicketInvoice'])->name('user.program.ticket.invoice');
    });

    Route::prefix('cause/donation')->group(function () {
        Route::get('/', [UserController::class, 'causeDonation'])->name('user.cause.donation');
        Route::get('/invoice/{invoice_id}', [UserController::class, 'causeDonationInvoice'])->name('user.cause.donation.invoice');
    });
});


/* Admin */
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/edit-profile', [AdminController::class, 'edit_profile'])->name('admin_edit_profile');
    Route::post('/edit-profile-submit', [AdminController::class, 'edit_profile_submit'])->name('admin_edit_profile_submit');
    Route::post('/change-password-submit', [AdminController::class, 'change_password_submit'])->name('admin_change_password_submit');

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [AdminSettingController::class, 'index'])->name('index');
        Route::post('/photo', [AdminSettingController::class, 'photoSetting'])->name('photo.store');
        Route::prefix('{setting}')->group(function () {
            Route::put('/photo', [AdminSettingController::class, 'photoSetting'])->name('photo.update');
            Route::put('/seo', [AdminSettingController::class, 'seoSetting'])->name('seo');
            Route::put('/topbar', [AdminSettingController::class, 'topbarSetting'])->name('topbar');
            Route::put('/contact', [AdminSettingController::class, 'contactSetting'])->name('contact');
            Route::put('/footer', [AdminSettingController::class, 'footerSetting'])->name('footer');
            Route::put('/map', [AdminSettingController::class, 'mapSetting'])->name('map');
        });
    });

    // Banners
    Route::prefix('banners')->name('banners.')->group(function () {
        Route::get('/', [AdminPagesBannerController::class, 'index'])->name('index');
        Route::post('/banner', [AdminPagesBannerController::class, 'pagesBanner'])->name('store');
        Route::prefix('{pages_banner}')->group(function () {
            Route::put('/banner', [AdminPagesBannerController::class, 'pagesBanner'])->name('update');
        });
    });

    // Sliders
    Route::resource('sliders', AdminSliderController::class);
    Route::patch('/sliders/{slider}/change-status', [AdminSliderController::class, 'changeStatus'])->name('sliders.changeStatus');

    // About
    Route::prefix('abouts')->group(function () {
        Route::resource('about-category', AdminAboutCategoryController::class); 
        Route::patch('/about-category/{about_category}/change-status', [AdminAboutCategoryController::class, 'changeStatus'])->name('about-category.changeStatus');

        Route::resource('about', AdminAboutController::class); 
        Route::patch('/about/{about}/change-status', [AdminAboutController::class, 'changeStatus'])->name('about.changeStatus');
    });

    // Features
    Route::resource('features', AdminFeatureController::class);
    Route::patch('/features/{feature}/change-status', [AdminFeatureController::class, 'changeStatus'])->name('features.changeStatus');

    // Facilities
    Route::resource('facilities', AdminFacilityController::class);
    Route::patch('/facilities/{facility}/change-status', [AdminFacilityController::class, 'changeStatus'])->name('facilities.changeStatus');

    // Appeals
    Route::resource('appeals', AdminAppealController::class)->parameters([
        'appeals' => 'appeal:slug'
    ]);
    Route::prefix('appeals')->group(function () {
        Route::patch('/{appeal:slug}/change-status', [AdminAppealController::class, 'changeStatus'])->name('appeals.changeStatus');
        Route::get('/{appeal:slug}/photos/{appeal_photo?}', [AdminAppealController::class, 'photos'])->name('appeals.photos');
        Route::post('/{appeal:slug}/photos', [AdminAppealController::class, 'storePhotos'])->name('appeals.photos.store');
        Route::put('/{appeal:slug}/photos/{appeal_photo}', [AdminAppealController::class, 'updatePhoto'])->name('appeals.photos.update');
        Route::delete('/{appeal:slug}/photos/{appeal_photo}', [AdminAppealController::class, 'destroyPhoto'])->name('appeals.photos.destroy');
        Route::get('/{appeal:slug}/videos/{appeal_video?}', [AdminAppealController::class, 'videos'])->name('appeals.videos');
        Route::post('/{appeal:slug}/videos', [AdminAppealController::class, 'storeVideos'])->name('appeals.videos.store');
        Route::put('/{appeal:slug}/videos/{appeal_video}', [AdminAppealController::class, 'updateVideo'])->name('appeals.videos.update');
        Route::delete('/{appeal:slug}/videos/{appeal_video}', [AdminAppealController::class, 'destroyVideo'])->name('appeals.videos.destroy');
    });

    // Programs
    Route::resource('programs', AdminProgramController::class);
    Route::prefix('programs')->group(function () {
        Route::patch('/{program:slug}/change-status', [AdminProgramController::class, 'changeStatus'])->name('programs.changeStatus');
        Route::get('/{program:slug}/photos/{program_photo?}', [AdminProgramController::class, 'photos'])->name('programs.photos');
        Route::post('/{program:slug}/photos', [AdminProgramController::class, 'storePhotos'])->name('programs.photos.store');
        Route::put('/{program:slug}/photos/{program_photo}', [AdminProgramController::class, 'updatePhoto'])->name('programs.photos.update');
        Route::delete('/{program:slug}/photos/{program_photo}', [AdminProgramController::class, 'destroyPhoto'])->name('programs.photos.destroy');
        Route::get('/{program:slug}/videos/{program_video?}', [AdminProgramController::class, 'videos'])->name('programs.videos');
        Route::post('/{program:slug}/videos', [AdminProgramController::class, 'storeVideos'])->name('programs.videos.store');
        Route::put('/{program:slug}/videos/{program_video}', [AdminProgramController::class, 'updateVideo'])->name('programs.videos.update');
        Route::delete('/{program:slug}/videos/{program_video}', [AdminProgramController::class, 'destroyVideo'])->name('programs.videos.destroy');
        Route::get('/{program:slug}/tickets', [AdminProgramController::class, 'tickets'])->name('programs.tickets');
        Route::get('/{program:slug}/tickets/{program_ticket}/invoice', [AdminProgramController::class, 'ticketInvoice'])->name('programs.ticket-invoice');
    });

    // Testimonials
    Route::resource('testimonials', AdminTestimonialController::class);
    Route::patch('/testimonials/{testimonial}/change-status', [AdminTestimonialController::class, 'changeStatus'])->name('testimonials.changeStatus');

    // Counters
    Route::prefix('counters')->group(function () {
        Route::get('/', [AdminCounterController::class, 'index'])->name('counters.index');
        Route::post('/', [AdminCounterController::class, 'update'])->name('counters.store');
        Route::put('/{counter}/update', [AdminCounterController::class, 'update'])->name('counters.update');
    });

    // Faqs
    Route::resource('faqs', AdminFaqController::class);
    Route::patch('/faqs/{faq}/change-status', [AdminFaqController::class, 'changeStatus'])->name('faqs.changeStatus');

    // Users
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::patch('/users/{user}/change-status', [AdminUserController::class, 'changeStatus'])->name('users.changeStatus');

    // Executives
    Route::resource('executives', AdminExecutiveController::class)->except(['show']);
    Route::patch('/executives/{executive}/change-status', [AdminExecutiveController::class, 'changeStatus'])->name('executives.changeStatus');

    // Volunteers
    Route::resource('volunteers', AdminVolunteerController::class)->except(['show']);
    Route::patch('/volunteers/{volunteer}/change-status', [AdminVolunteerController::class, 'changeStatus'])->name('volunteers.changeStatus');

    // Gallery
    Route::prefix('gallery')->name('gallery.')->group(function () {
        // Photo
        Route::prefix('photos')->group(function () {
            Route::resource('photo-category', AdminPhotoCategoryController::class); 
            Route::patch('/photo-category/{photo_category}/change-status', [AdminPhotoCategoryController::class, 'changeStatus'])->name('photo-category.changeStatus');
    
            Route::resource('photo', AdminPhotoController::class); 
            Route::patch('/photo/{photo}/change-status', [AdminPhotoController::class, 'changeStatus'])->name('photo.changeStatus');
        });

        // Video
        Route::prefix('videos')->group(function () {
            Route::resource('video-category', AdminVideoCategoryController::class); 
            Route::patch('/video-category/{video_category}/change-status', [AdminVideoCategoryController::class, 'changeStatus'])->name('video-category.changeStatus');
    
            Route::resource('video', AdminVideoController::class); 
            Route::patch('/video/{video}/change-status', [AdminVideoController::class, 'changeStatus'])->name('video.changeStatus');
        });
    });

    // Blogs
    Route::get('/post-category/index', [AdminPostCategoryController::class, 'index'])->name('admin_post_category_index');
    Route::get('/post-category/create', [AdminPostCategoryController::class, 'create'])->name('admin_post_category_create');
    Route::post('/post-category/create/submit', [AdminPostCategoryController::class, 'create_submit'])->name('admin_post_category_create_submit');
    Route::get('/post-category/edit/{id}', [AdminPostCategoryController::class, 'edit'])->name('admin_post_category_edit');
    Route::post('/post-category/edit/submit/{id}', [AdminPostCategoryController::class, 'edit_submit'])->name('admin_post_category_edit_submit');
    Route::delete('/post-category/delete/{id}', [AdminPostCategoryController::class, 'delete'])->name('admin_post_category_delete');
    Route::patch('/post-category/{post_category}/change-status', [AdminPostCategoryController::class, 'changeStatus'])->name('admin_post_category_changeStatus');

    Route::get('/post/index', [AdminPostController::class, 'index'])->name('admin_post_index');
    Route::get('/post/create', [AdminPostController::class, 'create'])->name('admin_post_create');
    Route::post('/post/create/submit', [AdminPostController::class, 'create_submit'])->name('admin_post_create_submit');
    Route::get('/post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin_post_edit');
    Route::post('/post/edit/submit/{id}', [AdminPostController::class, 'edit_submit'])->name('admin_post_edit_submit');
    Route::delete('/post/delete/{id}', [AdminPostController::class, 'delete'])->name('admin_post_delete');
    Route::patch('/post/{post:slug}/change-status', [AdminPostController::class, 'changeStatus'])->name('admin_post_changeStatus');
    Route::get('/comments', [AdminPostController::class, 'comment'])->name('admin_comment');
    Route::delete('/comments/delete/{id}', [AdminPostController::class, 'comment_delete'])->name('admin_comment_delete');
    Route::get('/comments/status-change/{id}', [AdminPostController::class, 'comment_status_change'])->name('admin_comment_status_change');

    Route::get('/replies', [AdminPostController::class, 'reply'])->name('admin_reply');
    Route::delete('/replies/delete/{id}', [AdminPostController::class, 'reply_delete'])->name('admin_reply_delete');
    Route::get('/replies/status-change/{id}', [AdminPostController::class, 'reply_status_change'])->name('admin_reply_status_change');

    Route::post('/reply-submit', [AdminPostController::class, 'reply_submit'])->name('admin_reply_submit');

    Route::resource('/orphans', AdminOrphanController::class);
    Route::patch('/orphans/{orphan}/change-status', [AdminOrphanController::class, 'changeStatus'])->name('orphans.changeStatus');

    // News
    Route::get('/news/index', [AdminNewsController::class, 'index'])->name('admin_news_index');
    Route::get('/news/create', [AdminNewsController::class, 'create'])->name('admin_news_create');
    Route::post('/news/create/submit', [AdminNewsController::class, 'create_submit'])->name('admin_news_create_submit');
    Route::get('/news/edit/{id}', [AdminNewsController::class, 'edit'])->name('admin_news_edit');
    Route::post('/news/edit/submit/{id}', [AdminNewsController::class, 'edit_submit'])->name('admin_news_edit_submit');
    Route::delete('/news/delete/{id}', [AdminNewsController::class, 'delete'])->name('admin_news_delete');
    Route::patch('/news/{news:slug}/change-status', [AdminNewsController::class, 'changeStatus'])->name('admin_news_changeStatus'); 

    // Causes
    Route::resource('/causes', AdminCauseController::class);
    Route::get('/cause/faq/{id}', [AdminCauseController::class, 'faq'])->name('admin_cause_faq');
    Route::post('/cause/faq', [AdminCauseController::class, 'faq_submit'])->name('admin_cause_faq_submit');
    Route::post('/cause/faq/update/{id}', [AdminCauseController::class, 'faq_update'])->name('admin_cause_faq_update');
    Route::delete('/cause/faq/delete/{id}', [AdminCauseController::class, 'faq_delete'])->name('admin_cause_faq_delete');
    // Route::patch('/causes/{cause}/change-status', [AdminCauseController::class, 'changeStatus'])->name('causes.changeStatus');
    Route::get('/causes/{cause:slug}/donations', [AdminCauseController::class, 'donations'])->name('causes.donations');
    Route::get('/donations', [AdminCauseController::class, 'donations'])->name('causes.donation');
    Route::get('/causes/{cause:slug}/donations/{cause_donation}/invoice', [AdminCauseController::class, 'donationInvoice'])->name('causes.donation-invoice');
    Route::get('/donations/{cause_donation}/invoice', [AdminCauseController::class, 'donationInvoice'])->name('causes.donation-invoices');
    Route::prefix('causes')->group(function () {
        Route::patch('/{cause:slug}/change-status', [AdminCauseController::class, 'changeStatus'])->name('causes.changeStatus');
        Route::get('/{cause:slug}/photos/{cause_photo?}', [AdminCauseController::class, 'photos'])->name('causes.photos');
        Route::post('/{cause:slug}/photos', [AdminCauseController::class, 'storePhotos'])->name('causes.photos.store');
        Route::put('/{cause:slug}/photos/{cause_photo}', [AdminCauseController::class, 'updatePhoto'])->name('causes.photos.update');
        Route::delete('/{cause:slug}/photos/{cause_photo}', [AdminCauseController::class, 'destroyPhoto'])->name('causes.photos.destroy');
        Route::get('/{cause:slug}/videos/{cause_video?}', [AdminCauseController::class, 'videos'])->name('causes.videos');
        Route::post('/{cause:slug}/videos', [AdminCauseController::class, 'storeVideos'])->name('causes.videos.store');
        Route::put('/{cause:slug}/videos/{cause_video}', [AdminCauseController::class, 'updateVideo'])->name('causes.videos.update');
        Route::delete('/{cause:slug}/videos/{cause_video}', [AdminCauseController::class, 'destroyVideo'])->name('causes.videos.destroy');
    });

    // Route::get('/home-page/index', [AdminHomePageController::class, 'index'])->name('admin_home_page_index');
    // Route::post('/home-page/update', [AdminHomePageController::class, 'update'])->name('admin_home_page_update');

    // Other pages
    Route::get('/other-pages/terms', [AdminOtherPageController::class, 'terms'])->name('terms.index');
    Route::post('/other-pages/terms-update', [AdminOtherPageController::class, 'termsUpdate'])->name('terms.update');

    Route::get('/other-pages/privacy', [AdminOtherPageController::class, 'privacy'])->name('privacy.index');
    Route::post('/other-pages/privacy-update', [AdminOtherPageController::class, 'privacyUpdate'])->name('privacy.update');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password-submit', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password-submit', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
});



