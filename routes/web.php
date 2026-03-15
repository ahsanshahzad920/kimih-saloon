<?php

use App\Http\Controllers\Admin\AboutController;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\ContactUs;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Middleware\BusinessAcountSetup;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DailySalesController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\CalenderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\User\ContactUsController;
use App\Http\Controllers\Admin\PaidPlansController;
use App\Http\Controllers\Admin\ScheduledController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\StockOrderController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\User\ShopProductController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogTypeController;
use App\Http\Controllers\Admin\BusinessCmsController;
use App\Http\Controllers\Admin\BusinessInfoController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Auth\AuthBusinessController;
use App\Http\Controllers\Auth\AuthCustomerController;
use App\Http\Controllers\SalePaymentTransactionController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\LeadsController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ReplyController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\BookingStripeController;
use App\Http\Controllers\BotFaqController;
use App\Http\Controllers\CancelAppointmentController;
use App\Http\Controllers\EmailSubscriptionController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\PlanServicesController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\User\AppointmentController as UserAppointmentController;
use App\Http\Controllers\User\CustomerCartController;
use App\Http\Controllers\User\ShopMembershipController;
use App\Models\User;

Route::get('optimize', function () {
    Artisan::call('optimize:clear');
    return 'optimized';
});

Route::get('fresh-start', function () {
    Artisan::call('migrate:fresh --seed');
    return 'fresh start is done';
});

Route::get('migrate', function () {
    Artisan::call('migrate');
    return 'migrate is done';
});
Route::get('run-seed/{class}', function ($class) {
    Artisan::call('db:seed --class=' . $class);
    return 'seed is done for ' . $class;
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return 'storage link updated';
});

Route::get('queue-work', function () {
    Artisan::call('queue:work');
    return 'Queue run updated';
});


// Clients Routes
Route::resource('/', HomeController::class);
Route::get('/search', [HomeController::class, 'searchShop'])->name('shop.search');
Route::get('/shop/{slug}', [HomeController::class, 'shopDetails'])->name('shop.details');


Route::get('/customer/appointments', [UserAppointmentController::class, 'index'])->name('customer.appointments');

Route::get(
    '/dashboard',
    function () {
        return view('admin.dashboard');
    }
)->middleware(['auth', 'verified', BusinessAcountSetup::class])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {

    // Comment and Replies
    Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/replies', [ReplyController::class, 'store'])->name('replies.store');

    // Social Media links
    Route::put('user/links', [UserController::class, 'updateLinks'])->name('user.update.links');


    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management Routes
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::resource('permissions', PermissionController::class);
    // Client Routes
    Route::resource('clients', ClientController::class);
    // Profile Routes
    Route::resource('profile', ProfileController::class);
    Route::put('/profile-image-update/{id}', [ProfileController::class, 'updateProfileImage']);
    Route::get('profileImageDelete/{id}', [ProfileController::class, 'deleteImage'])->name('profileImage-delete');
    // Password Update Route
    Route::put('password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    // Catalogue module routes
    Route::prefix('catalogues')->group(function () {
        // service routes
        Route::resource('/services', ServiceController::class);
        Route::post('/services/category/add', [ServiceController::class, 'addCategory'])->name('services.category.store');
        Route::put('/services/category/{id}', [ServiceController::class, 'editCategory'])->name('services.category.update');
        Route::delete('/services/category/{id}/delete', [ServiceController::class, 'deleteCategory'])->name('services.category.destroy');

        // product routes

        Route::resource('/products', ProductController::class);
        Route::post('/supplier/product', [ProductController::class, 'storeSupplier'])->name('product.supplier.store');
        Route::resource('/brands', BrandController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/suppliers', SupplierController::class);

        // memberships
        Route::resource('/memberships', MembershipController::class);
        Route::resource('/stock-orders', StockOrderController::class);
    });

    // sales routes
    Route::resource('sales', SaleController::class);
    Route::resource('/payment-transactions', SalePaymentTransactionController::class);
    Route::resource('daily-sales', DailySalesController::class);
    Route::resource('paid-plans', PaidPlansController::class);
    Route::post('paid-plans/change-status', [PaidPlansController::class, 'changeStatus'])->name('paid-plans.change-status');

    Route::get('/get-product-detail', [ProductController::class, 'getProductDetails'])->name('get-product-details');

    // Team Members Route
    Route::resource('team-members', TeamMemberController::class);
    Route::resource('scheduled-shifts', ScheduledController::class);
    Route::post('add-shift', [ScheduledController::class, 'addShift'])->name('shift.add');
    Route::put('edit-shift', [ScheduledController::class, 'editShift'])->name('shift.edit');
    Route::post('shift-delete/{id}', [ScheduledController::class, 'deleteShift'])->name('shift.delete');

    // Calender Routes
    Route::resource('calendar', CalendarController::class);
    Route::get('/appointments', [CalendarController::class, 'getAppointments'])->name('appointments');
    Route::put('/appointments/{eventId}', [CalendarController::class, 'updateAppointment'])->name('appointments.update');
    Route::delete('/appointments/{eventId}', [CalendarController::class, 'deleteAppointment'])->name('appointments.delete');

    // Appointments Routes
    Route::resource('appointment-list', AppointmentController::class);

    // Filter routes
    Route::post('/users/filter', [UserController::class, 'filterUsers'])->name('users.filter');

    // delete multiple record routes
    Route::post('/users/delete', [UserController::class, 'deleteMultiple'])->name('users.delete');

    // CMS routes
    Route::prefix('cms')->group(function () {
        Route::resource('landing-page', AdminHomeController::class);
        Route::resource('feedback', FeedbackController::class);
        Route::post('feedback-change-status', [FeedbackController::class, 'change_status']);
        Route::get('contact-us', function () {
            $contacts = ContactUs::latest()->get();
            return view('admin.cms.contact-us', compact('contacts'));
        })->name("cms.contactUs");
    });

    // Business CMS
    Route::resource('cms-business', BusinessCmsController::class);

    // Business info CMS
    Route::resource('business-info', BusinessInfoController::class);

    // About Us
    Route::resource('crm-about', AboutController::class);

    // Blog Type
    Route::resource('blog-types', BlogTypeController::class);

    // Blogs
    Route::resource('blogs', BlogController::class);
    Route::get('blog-search', [BlogController::class, 'search'])->name('blog.search');

    // Features
    Route::resource('features', FeatureController::class);
    Route::get('feature-page', [FeatureController::class, 'featurePageIndex'])->name('feature.page.index');
    Route::post('feature-page', [FeatureController::class, 'featurePageStore'])->name('feature.page.store');

    // Plants
    Route::resource('plans', PlanController::class);

    // Send SMS Routes
    Route::resource('send-sms', SMSController::class);

    // Marketing
    Route::resource('leads', LeadsController::class);

    // Email subscription
    Route::get('/subscribe', [EmailSubscriptionController::class, 'index'])->name('sub.index');
    Route::delete('/subscribe/{id}', [EmailSubscriptionController::class, 'destroy'])->name('sub.del');

    Route::get('send-mails', [EmailSubscriptionController::class, 'sendMailIndex'])->name('send.mails.index');
    Route::post('send-mails', [EmailSubscriptionController::class, 'sendMails'])->name('send.mails.send');

    //Recharge amount
    Route::post('recharge-amount', [EmailSubscriptionController::class, 'recharge'])->name('recharge-amount');
    Route::get('recharge-amount/stripe/checkout/successs', [EmailSubscriptionController::class, 'stripeCheckoutSuccess'])->name('recharge.stripe.checkout.success');


    // Settings
    Route::resource('settings', SettingController::class);

    // Bot Faqs
    Route::resource('bot-faqs', BotFaqController::class);

    // Cancel Appointment
    Route::post('cancel-appointment', [CancelAppointmentController::class, 'cancel'])->name('appointment.cancel');

    // Plan Services
    Route::resource('plan_services', PlanServicesController::class);
});

// contact us
Route::resource('/contact-us', ContactUsController::class)->withoutMiddleware(['auth']);


// Email Subscription
Route::post('/subscribe', [EmailSubscriptionController::class, 'store'])->name('subscribe.store');

// FAQs
Route::resource('faqs', FaqsController::class);

Route::get('frequently-asked-question', [FaqsController::class, 'frontFaqs'])->name('front.faqs');

// Login Routes for Socialite
Route::get('/socialite/{driver}/{role}', [SocialLoginController::class, 'toProvider'])->where(['driver' => 'google|facebook|github', 'role' => 'business|customer']);
Route::get('/auth/{driver}/login', [SocialLoginController::class, 'handleCallback'])->where('driver', 'google|facebook|github');
// Route::get('/socialite/{driver}/{role}', [SocialLoginController::class, 'toProvider'])->where('driver', 'google|facebook|github');
// Route::get('/auth/{driver}/login', [SocialLoginController::class, 'handleCallback'])->where('driver', 'google|facebook|github');

// Auth Routes
Route::get('user-flow', function () {
    return view('user.user-flow');
})->name('user-flow');

Route::get('auth/for-customer', [AuthCustomerController::class, 'index'])->name('auth-for-customer');
Route::get('auth/sign-up/for-customer/{email?}', [AuthCustomerController::class, 'signUpIndex'])->name('auth-customer-sign-up');
Route::post('auth/sign-up/for-customer/{email?}', [AuthCustomerController::class, 'signUp'])->name('auth-customer-sign-up');
Route::get('auth/for-business', [AuthBusinessController::class, 'index'])->name('auth-for-business');
Route::get('auth/sign-up/for-business/{email?}', [AuthBusinessController::class, 'signUpIndex'])->name('auth-business-sign-up');
Route::post('auth/sign-up/for-business/{email?}', [AuthBusinessController::class, 'signUp'])->name('auth-business-sign-up');
Route::get('/setup-business-account', [AuthBusinessController::class, 'setupAccountIndex'])->name('business.setup')->middleware(['auth']);
Route::post('/setup-business-account', [AuthBusinessController::class, 'setupAccount'])->name('business.setup');
Route::resource('businesses', BusinessController::class);



// Client Side Routes
// Profile Routes
Route::resource('user-profile', CustomerProfileController::class);
Route::put('user-profile-image-update/{id}', [CustomerProfileController::class, 'updateProfileImage']);
Route::get('user-profileImageDelete/{id}', [CustomerProfileController::class, 'deleteImage'])->name('profileImage-delete');
Route::get('/shop/{slug}/services/booking', [BookingController::class, 'create'])->name('shop.services');
Route::post('/get-member-timeslotes', [BookingController::class, 'getMemberTimeSlots'])->name('get-member-timeslotes');
Route::post('/booking-create', [BookingController::class, 'store'])->name('booking.store');
Route::prefix('shop/{slug}')->group(function () {
    Route::resource('products', ShopProductController::class)->names([
        'index' => 'shop.products.index',
        'create' => 'shop.products.create',
        'store' => 'shop.products.store',
        'show' => 'shop.products.show',
        'edit' => 'shop.products.edit',
        'update' => 'shop.products.update',
        'destroy' => 'shop.products.destroy',
    ]);
    Route::resource('memberships', ShopMembershipController::class)->names([
        'index' => 'shop.memberships.index',
        'create' => 'shop.memberships.create',
        'store' => 'shop.memberships.store',
        'show' => 'shop.memberships.show',
        'edit' => 'shop.memberships.edit',
        'update' => 'shop.memberships.update',
        'destroy' => 'shop.memberships.destroy',
    ]);
    Route::post('memberships/checkout', [ShopMembershipController::class, 'checkout'])->name('shop.membership.checkout');
    Route::post('checkout', [ShopProductController::class, 'checkout'])->name('shop.products.checkout');
});
Route::get('customer/product_orders', [ShopProductController::class, 'product_orders'])->name('customer.product.orders');
Route::get('customer/memberships', [ShopMembershipController::class, 'purchased_membership'])->name('customer.membership.purchased');
Route::resource('cart', CustomerCartController::class);


// Front end routes
Route::get('business', [BusinessCmsController::class, 'showOnFrontEnd'])->name('business.page');

Route::get('pricing', [PlanController::class, 'showOnFrontEnd'])->name('pricing');

Route::get('blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog.details');
Route::get('latest-blogs', [BlogController::class, 'blogsOnFrontEnd'])->name('blogs.show.front');
Route::get('blogs-by-type/{blogType}', [BlogController::class, 'blogsByTypes'])->name('blogs.by.type');
Route::get('blogs-by-tag/{tag}', [BlogController::class, 'blogsByTags'])->name('blogs.by.tags');

// Privacy
Route::view('privacy-policy', 'front.privacy')->name('privacy.index');
Route::view('term-of-service', 'front.term-of-service')->name('term_of_service.index');

Route::view('payment', 'front.payment')->name('payment');
Route::view('service-list', 'front.service-list')->name('services.list');
Route::view('cancellation-policy', 'front.cancellation-policy')->name('cancellation.policy');
Route::view('partner-terms', 'front.partner-terms')->name('partner.terms');
Route::get('about', [AboutController::class, 'frontEndShow'])->name('about');

// Comming Soon
Route::view('comming-soon', 'comming-soon');  // Route to display the coming soon page
// Route::redirect('/', 'comming-soon');

// Stripe Payment Controller
Route::controller(StripeController::class)->group(function () {
    Route::post('stripe/checkout', 'stripeCheckout')->name('stripe.checkout');
    Route::get('stripe/checkout/successs', 'stripeCheckoutSuccess')->name('stripe.checkout.success');
});

Route::post('/product-reviews', [ProductReviewController::class, 'store'])->name('product.review.store');
Route::get('/check-user-review', [ProductReviewController::class, 'checkUserReview'])->name('check.user.review');
Route::get('/product/{id}/reviews', [ProductReviewController::class, 'getReviews']);

Route::controller(BookingStripeController::class)->group(function () {
    Route::post('booking/stripe/checkout', 'stripeCheckout')->name('booking.stripe.checkout');
    Route::get('booking/stripe/checkout/successs', 'stripeCheckoutSuccess')->name('booking.stripe.checkout.success');
});

Route::view('my-wallet', 'user.my-wallet')->name('user.wallet');
// Route::get('google-reviews', [FeedbackController::class, 'frontEndShowReviews'])->name('reviews');


Route::post('get-answer', [BotFaqController::class, 'getAnswer']);

Route::get('customer-feedback', [FeedbackController::class, 'showUserFeedback'])->name('cutomer.feedback.index');
Route::post('customer-feedback', [FeedbackController::class, 'store'])->name('cutomer.feedback.store');
Route::put('customer-feedback/{id}', [FeedbackController::class, 'update'])->name('cutomer.feedback.update');

Route::get('/seed-faq', function () {
    Artisan::call('db:seed --class=FAQSeeder');
    return 'FAQ Seeder has been run successfully!';
});

require __DIR__ . '/auth.php';
require __DIR__ . '/configs.php';
