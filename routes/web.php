<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BackupController as AdminBackupController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController as FrontendUserController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserPropertyController;

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

// Frontend Property Routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');

// Frontend News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Frontend Projects Routes
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::post('/projects/{project}/inquiry', [ProjectController::class, 'submitInquiry'])->name('projects.inquiry');

Route::get('/team', [TeamController::class, 'index'])->name('team.index');

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [FrontendUserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [FrontendUserController::class, 'updateProfile'])->name('user.profile.update');
});

// Frontend User Auth Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [UserAuthController::class, 'login'])->name('login.submit');
        Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
    });

    Route::middleware(['auth', 'user'])->group(function () {
        Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
    });
});

// Frontend User Property Routes
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/my-property', [UserPropertyController::class, 'index'])->name('myProperty');
    Route::get('/property/add', [UserPropertyController::class, 'create'])->name('property.add');
    Route::post('/property/add', [UserPropertyController::class, 'store'])->name('property.store');
    Route::get('/my-property/{property}/edit', [UserPropertyController::class, 'edit'])->name('user.properties.edit');
    Route::put('/my-property/{property}', [UserPropertyController::class, 'update'])->name('user.properties.update');
});

// Admin Property Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    
    // Profile Management Routes
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [AdminController::class, 'updatePassword'])->name('update-password');
    
    // Custom logout route for admin
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    
    // Property Management Routes
    Route::get('/property/add-property', [AdminController::class, 'addProperty'])->name('property.add');
    Route::get('/property/edit-property', [AdminController::class, 'editProperty'])->name('property.edit');
    Route::get('/property/property-table', [AdminController::class, 'propertyTable'])->name('property.table');
    
    // Property CRUD Routes
    Route::resource('properties', PropertyController::class);
    Route::post('properties/{id}/toggle-status', [PropertyController::class, 'toggleStatus'])->name('properties.toggle-status');
    Route::post('properties/{id}/toggle-sold', [PropertyController::class, 'toggleSold'])->name('properties.toggle-sold');
    Route::post('properties/{id}/toggle-deactivated', [PropertyController::class, 'toggleDeactivated'])->name('properties.toggle-deactivated');
    
    // Blog Management Routes
    Route::get('blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/create', [AdminBlogController::class, 'create'])->name('blogs.create');
    Route::post('blogs', [AdminBlogController::class, 'store'])->name('blogs.store');
    Route::get('blogs/{blog}', [AdminBlogController::class, 'show'])->name('blogs.show');
    Route::get('blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
    Route::put('blogs/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
    Route::delete('blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');
    Route::post('blogs/{blog}/toggle-status', [AdminBlogController::class, 'toggleStatus'])->name('blogs.toggle-status');
    Route::post('blogs/{blog}/toggle-featured', [AdminBlogController::class, 'toggleFeatured'])->name('blogs.toggle-featured');
    
    // Blog Category Management Routes
    Route::get('blog-categories', [BlogCategoryController::class, 'index'])->name('blog-categories.index');
    Route::get('blog-categories/create', [BlogCategoryController::class, 'create'])->name('blog-categories.create');
    Route::post('blog-categories', [BlogCategoryController::class, 'store'])->name('blog-categories.store');
    Route::get('blog-categories/{blogCategory}', [BlogCategoryController::class, 'show'])->name('blog-categories.show');
    Route::get('blog-categories/{blogCategory}/edit', [BlogCategoryController::class, 'edit'])->name('blog-categories.edit');
    Route::put('blog-categories/{blogCategory}', [BlogCategoryController::class, 'update'])->name('blog-categories.update');
    Route::delete('blog-categories/{blogCategory}', [BlogCategoryController::class, 'destroy'])->name('blog-categories.destroy');
    Route::post('blog-categories/{blogCategory}/toggle-status', [BlogCategoryController::class, 'toggleStatus'])->name('blog-categories.toggle-status');
    
    // Lead Management Routes
    Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('leads', [LeadController::class, 'store'])->name('leads.store');
    Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::get('leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::put('leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');
    Route::post('leads/{lead}/add-comment', [LeadController::class, 'addComment'])->name('leads.add-comment');
    Route::post('leads/{lead}/upload-attachment', [LeadController::class, 'uploadAttachment'])->name('leads.upload-attachment');
    Route::get('leads/attachment/{attachment}/download', [LeadController::class, 'downloadAttachment'])->name('leads.attachments.download');
    Route::patch('leads/{lead}/update-status', [LeadController::class, 'updateStatus'])->name('leads.update-status');
    Route::post('leads/{lead}', [LeadController::class, 'assign'])->name('leads.assign');
    Route::delete('leads/{lead}/comments/{comment}', [LeadController::class, 'deleteComment'])->name('leads.comments.destroy');
    Route::post('leads/{lead}/comments', [LeadController::class, 'addComment'])->name('leads.comments.store');
    Route::post('leads/bulk-action', [LeadController::class, 'bulkAction'])->name('leads.bulk-action');
    Route::get('leads/export', [LeadController::class, 'export'])->name('leads.export');
    
    // Contact Management Routes
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::patch('contacts/{contact}/update-status', [ContactController::class, 'updateStatus'])->name('contacts.update-status');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('contacts/bulk-action', [ContactController::class, 'bulkAction'])->name('contacts.bulk-action');
    Route::get('contacts/export', [ContactController::class, 'export'])->name('contacts.export');
    
    // Contact Lead Management Routes
    Route::patch('contacts/{contact}', [ContactController::class, 'updateLeadStatus'])->name('contacts.update-lead-status');
    Route::post('contacts/{contact}/assign-lead', [ContactController::class, 'assignLead'])->name('contacts.assign-lead');
    Route::post('contacts/{contact}/add-comment', [ContactController::class, 'addComment'])->name('contacts.add-comment');
    Route::delete('contacts/{contact}/comments/{comment}', [ContactController::class, 'deleteComment'])->name('contacts.comments.destroy');
    
    // Subscription Management Routes
    Route::get('subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('subscriptions/create', [AdminSubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('subscriptions', [AdminSubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('subscriptions/{subscription}', [AdminSubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::get('subscriptions/{subscription}/edit', [AdminSubscriptionController::class, 'edit'])->name('subscriptions.edit');
    Route::put('subscriptions/{subscription}', [AdminSubscriptionController::class, 'update'])->name('subscriptions.update');
    Route::delete('subscriptions/{subscription}', [AdminSubscriptionController::class, 'destroy'])->name('subscriptions.destroy');
    Route::post('subscriptions/{subscription}/toggle-status', [AdminSubscriptionController::class, 'toggleStatus'])->name('subscriptions.toggle-status');
    Route::post('subscriptions/bulk-action', [AdminSubscriptionController::class, 'bulkAction'])->name('subscriptions.bulk-action');
    Route::get('subscriptions/export', [AdminSubscriptionController::class, 'export'])->name('subscriptions.export');
    Route::get('subscriptions/stats', [AdminSubscriptionController::class, 'getStats'])->name('subscriptions.stats');
    
    // News Management Routes
    Route::get('news', [AdminNewsController::class, 'index'])->name('news.index');
    Route::get('news/create', [AdminNewsController::class, 'create'])->name('news.create');
    Route::post('news', [AdminNewsController::class, 'store'])->name('news.store');
    Route::get('news/{news}', [AdminNewsController::class, 'show'])->name('news.show');
    Route::get('news/{news}/edit', [AdminNewsController::class, 'edit'])->name('news.edit');
    Route::put('news/{news}', [AdminNewsController::class, 'update'])->name('news.update');
    Route::delete('news/{news}', [AdminNewsController::class, 'destroy'])->name('news.destroy');
    Route::post('news/{news}/toggle-status', [AdminNewsController::class, 'toggleStatus'])->name('news.toggle-status');
    Route::post('news/{news}/toggle-featured', [AdminNewsController::class, 'toggleFeatured'])->name('news.toggle-featured');
    Route::post('news/bulk-action', [AdminNewsController::class, 'bulkAction'])->name('news.bulk-action');
    Route::get('news/export', [AdminNewsController::class, 'export'])->name('news.export');
    Route::get('news/stats', [AdminNewsController::class, 'getStats'])->name('news.stats');
    
    // Projects Management
    Route::resource('project-categories', ProjectCategoryController::class);
    Route::post('project-categories/{projectCategory}/toggle-status', [ProjectCategoryController::class, 'toggleStatus'])->name('project-categories.toggle-status');
    Route::resource('projects', AdminProjectController::class);
    Route::delete('projects/{project}', [AdminProjectController::class, 'destroy'])->name('projects.destroy');
    Route::post('projects/{project}/toggle-status', [AdminProjectController::class, 'toggleStatus'])->name('projects.toggle-status');
    Route::post('projects/{project}/toggle-featured', [AdminProjectController::class, 'toggleFeatured'])->name('projects.toggle-featured');
    Route::get('projects/stats', [AdminProjectController::class, 'getStats'])->name('projects.stats');
    Route::post('projects/upload-image', [AdminProjectController::class, 'uploadImage'])->name('projects.upload-image');
    Route::get('projects/setup-storage', [AdminProjectController::class, 'setupStorage'])->name('projects.setup-storage');
    Route::get('projects/export', [AdminProjectController::class, 'export'])->name('projects.export');
    
    // Team Management Routes
    Route::resource('team', \App\Http\Controllers\Admin\TeamController::class)->parameters(['team' => 'teamMember']);
    Route::post('team/{teamMember}/toggle-status', [\App\Http\Controllers\Admin\TeamController::class, 'toggleStatus'])->name('team.toggle-status');
    Route::post('team/update-order', [\App\Http\Controllers\Admin\TeamController::class, 'updateOrder'])->name('team.update-order');
    Route::get('team/stats', [\App\Http\Controllers\Admin\TeamController::class, 'getStats'])->name('team.stats');
    Route::post('team/upload-image', [\App\Http\Controllers\Admin\TeamController::class, 'uploadImage'])->name('team.upload-image');
    
    // User Management Routes
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('users/{user}/toggle-portal-access', [UserController::class, 'togglePortalAccess'])->name('users.toggle-portal-access');
    Route::get('users/{user}/activities', [UserController::class, 'activities'])->name('users.activities');
    Route::get('users/export', [UserController::class, 'export'])->name('users.export');
    Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');
    Route::post('users/{user}/assign-loan', [UserController::class, 'assignLoan'])->name('users.assign-loan');
    Route::post('users/{user}/settle-loan', [UserController::class, 'settleLoan'])->name('users.settle-loan');
    Route::get('users/{user}/loan-details', [UserController::class, 'loanDetails'])->name('users.loan-details');
    
    // Attendance Management Routes
    // Define specific GET routes before the resource route to avoid conflicts with show route
    Route::get('attendance/stats', [\App\Http\Controllers\Admin\AttendanceController::class, 'getStats'])->name('attendance.stats');
    Route::get('attendance/export', [\App\Http\Controllers\Admin\AttendanceController::class, 'export'])->name('attendance.export');
    Route::get('attendance/export-enhanced', [\App\Http\Controllers\Admin\AttendanceController::class, 'exportEnhanced'])->name('attendance.export-enhanced');
    Route::get('attendance/enhanced-stats', [\App\Http\Controllers\Admin\AttendanceController::class, 'getEnhancedStats'])->name('attendance.enhanced-stats');
    Route::get('workload/audit-logs', [\App\Http\Controllers\Admin\WorkloadController::class, 'auditLogs'])->name('workload.audit-logs');
    Route::resource('attendance', \App\Http\Controllers\Admin\AttendanceController::class)->parameters(['attendance' => 'attendanceRecord']);
    Route::post('attendance/{attendanceRecord}/toggle-approval', [\App\Http\Controllers\Admin\AttendanceController::class, 'toggleApproval'])->name('attendance.toggle-approval');
    Route::post('attendance/bulk-action', [\App\Http\Controllers\Admin\AttendanceController::class, 'bulkAction'])->name('attendance.bulk-action');
    
    Route::get('attendance/user/{userId}/profile', [\App\Http\Controllers\Admin\AttendanceController::class, 'userProfile'])->name('attendance.user-profile');
    Route::post('attendance/process-late-calculation', [\App\Http\Controllers\Admin\AttendanceController::class, 'processLateCalculation'])->name('attendance.process-late-calculation');
    
        // Workload Management Routes
    Route::resource('workload', \App\Http\Controllers\Admin\WorkloadController::class)->parameters(['workload' => 'task']);
    Route::post('workload/{task}/toggle-status', [\App\Http\Controllers\Admin\WorkloadController::class, 'toggleStatus'])->name('workload.toggle-status');
    Route::post('workload/{task}/add-comment', [\App\Http\Controllers\Admin\WorkloadController::class, 'addComment'])->name('workload.add-comment');
    Route::get('workload/attachments/{attachment}/download', [\App\Http\Controllers\Admin\WorkloadController::class, 'downloadAttachment'])->name('workload.download-attachment');
    Route::delete('workload/attachments/{attachment}', [\App\Http\Controllers\Admin\WorkloadController::class, 'deleteAttachment'])->name('workload.attachments.destroy');
    Route::get('workload/stats', [\App\Http\Controllers\Admin\WorkloadController::class, 'getStats'])->name('workload.stats');
    Route::get('workload/export', [\App\Http\Controllers\Admin\WorkloadController::class, 'export'])->name('workload.export');
   
    
    Route::post('news/upload-image', [AdminNewsController::class, 'uploadImage'])->name('news.upload-image');
    Route::get('news/setup-storage', [AdminNewsController::class, 'setupStorage'])->name('news.setup-storage');

    // Reports & Backups
    Route::get('backups', [AdminBackupController::class, 'index'])->name('backups.index');
    Route::post('backups', [AdminBackupController::class, 'store'])->name('backups.store');
    Route::get('backups/download/{id}', [AdminBackupController::class, 'download'])->name('backups.download');
    Route::delete('backups/{id}', [AdminBackupController::class, 'destroy'])->name('backups.destroy');
    // One-time: migrate backups table without terminal
    Route::post('backups/migrate', [AdminBackupController::class, 'migrate'])->name('backups.migrate');
     
     // Other Admin Routes
    Route::get('/advance-table', [AdminController::class, 'advanceTable'])->name('advance.table');
    Route::get('/alert', [AdminController::class, 'alert'])->name('alert');
    Route::get('/auth-forgot-password', [AdminController::class, 'authForgotPassword'])->name('auth.forgot.password');
    Route::get('/auth-login', [AdminController::class, 'authLogin'])->name('auth.login');
    Route::get('/auth-register', [AdminController::class, 'authRegister'])->name('auth.register');
    Route::get('/auth-reset-password', [AdminController::class, 'authResetPassword'])->name('auth.reset.password');
    Route::get('/avatar', [AdminController::class, 'avatar'])->name('avatar');
    Route::get('/badge', [AdminController::class, 'badge'])->name('badge');
    Route::get('/basic-form', [AdminController::class, 'basicForm'])->name('basic.form');
    Route::get('/basic-table', [AdminController::class, 'basicTable'])->name('basic.table');
    Route::get('/blank', [AdminController::class, 'blank'])->name('blank');
    Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
    Route::get('/breadcrumb', [AdminController::class, 'breadcrumb'])->name('breadcrumb');
    Route::get('/buttons', [AdminController::class, 'buttons'])->name('buttons');
    Route::get('/calendar', [AdminController::class, 'calendar'])->name('calendar');
    Route::get('/card', [AdminController::class, 'card'])->name('card');
    Route::get('/carousel', [AdminController::class, 'carousel'])->name('carousel');
    Route::get('/chart-amchart', [AdminController::class, 'chartAmchart'])->name('chart.amchart');
    Route::get('/chart-apex', [AdminController::class, 'chartApex'])->name('chart.apex');
    Route::get('/chart-chartjs', [AdminController::class, 'chartChartjs'])->name('chart.chartjs');
    Route::get('/chart-echart', [AdminController::class, 'chartEchart'])->name('chart.echart');
    Route::get('/chart-morris', [AdminController::class, 'chartMorris'])->name('chart.morris');
    Route::get('/chart-sparkline', [AdminController::class, 'chartSparkline'])->name('chart.sparkline');
    Route::get('/checkbox-radio', [AdminController::class, 'checkboxRadio'])->name('checkbox.radio');
    Route::get('/collapse', [AdminController::class, 'collapse'])->name('collapse');
    Route::get('/contact', [AdminController::class, 'contact'])->name('contact');
    Route::get('/create-post', [AdminController::class, 'createPost'])->name('create.post');
    Route::get('/datatables', [AdminController::class, 'datatables'])->name('datatables');
    Route::get('/dropdown', [AdminController::class, 'dropdown'])->name('dropdown');
    Route::get('/editable-table', [AdminController::class, 'editableTable'])->name('editable.table');
    Route::get('/email-compose', [AdminController::class, 'emailCompose'])->name('email.compose');
    Route::get('/email-inbox', [AdminController::class, 'emailInbox'])->name('email.inbox');
    Route::get('/email-read', [AdminController::class, 'emailRead'])->name('email.read');
    Route::get('/empty-state', [AdminController::class, 'emptyState'])->name('empty.state');
    Route::get('/errors-403', [AdminController::class, 'errors403'])->name('errors.403');
    Route::get('/errors-404', [AdminController::class, 'errors404'])->name('errors.404');
    Route::get('/errors-500', [AdminController::class, 'errors500'])->name('errors.500');
    Route::get('/errors-503', [AdminController::class, 'errors503'])->name('errors.503');
    Route::get('/export-table', [AdminController::class, 'exportTable'])->name('export.table');
    Route::get('/flags', [AdminController::class, 'flags'])->name('flags');
    Route::get('/forms-advanced', [AdminController::class, 'formsAdvanced'])->name('forms.advanced');
    Route::get('/forms-editor', [AdminController::class, 'formsEditor'])->name('forms.editor');
    Route::get('/forms-validation', [AdminController::class, 'formsValidation'])->name('forms.validation');
    Route::get('/form-wizard', [AdminController::class, 'formWizard'])->name('form.wizard');
    Route::get('/gallery1', [AdminController::class, 'gallery1'])->name('gallery1');
    Route::get('/gmaps-advanced', [AdminController::class, 'gmapsAdvanced'])->name('gmaps.advanced');
    Route::get('/gmaps-draggable', [AdminController::class, 'gmapsDraggable'])->name('gmaps.draggable');
    Route::get('/gmaps-geocoding', [AdminController::class, 'gmapsGeocoding'])->name('gmaps.geocoding');
    Route::get('/gmaps-geolocation', [AdminController::class, 'gmapsGeolocation'])->name('gmaps.geolocation');
    Route::get('/gmaps-marker', [AdminController::class, 'gmapsMarker'])->name('gmaps.marker');
    Route::get('/gmaps-multiple-marker', [AdminController::class, 'gmapsMultipleMarker'])->name('gmaps.multiple.marker');
    Route::get('/gmaps-route', [AdminController::class, 'gmapsRoute'])->name('gmaps.route');
    Route::get('/gmaps-simple', [AdminController::class, 'gmapsSimple'])->name('gmaps.simple');
    Route::get('/icon-feather', [AdminController::class, 'iconFeather'])->name('icon.feather');
    Route::get('/icon-font-awesome', [AdminController::class, 'iconFontAwesome'])->name('icon.font.awesome');
    Route::get('/icon-ionicons', [AdminController::class, 'iconIonicons'])->name('icon.ionicons');
    Route::get('/icon-material', [AdminController::class, 'iconMaterial'])->name('icon.material');
    Route::get('/icon-weather', [AdminController::class, 'iconWeather'])->name('icon.weather');
    Route::get('/invoice', [AdminController::class, 'invoice'])->name('invoice');
    Route::get('/light-gallery', [AdminController::class, 'lightGallery'])->name('light.gallery');
    Route::get('/list-group', [AdminController::class, 'listGroup'])->name('list.group');
    Route::get('/mail-inbox', [AdminController::class, 'mailInbox'])->name('mail.inbox');
    Route::get('/media-object', [AdminController::class, 'mediaObject'])->name('media.object');
    Route::get('/modal', [AdminController::class, 'modal'])->name('modal');
    Route::get('/multiple-upload', [AdminController::class, 'multipleUpload'])->name('multiple.upload');
    Route::get('/navbar', [AdminController::class, 'navbar'])->name('navbar');
    Route::get('/owl-carousel', [AdminController::class, 'owlCarousel'])->name('owl.carousel');
    Route::get('/pagination', [AdminController::class, 'pagination'])->name('pagination');
    Route::get('/popover', [AdminController::class, 'popover'])->name('popover');
    Route::get('/portfolio', [AdminController::class, 'portfolio'])->name('portfolio');
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::get('/pricing', [AdminController::class, 'pricing'])->name('pricing');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('/progress', [AdminController::class, 'progress'])->name('progress');
    Route::get('/subscribe', [AdminController::class, 'subscribe'])->name('subscribe');
    Route::get('/sweet-alert', [AdminController::class, 'sweetAlert'])->name('sweet.alert');
    Route::get('/tabs', [AdminController::class, 'tabs'])->name('tabs');
    Route::get('/timeline', [AdminController::class, 'timeline'])->name('timeline');
    Route::get('/toastr', [AdminController::class, 'toastr'])->name('toastr');
    Route::get('/tooltip', [AdminController::class, 'tooltip'])->name('tooltip');
    Route::get('/typography', [AdminController::class, 'typography'])->name('typography');
    Route::get('/vector-map', [AdminController::class, 'vectorMap'])->name('vector.map');
    Route::get('/widget-chart', [AdminController::class, 'widgetChart'])->name('widget.chart');
    Route::get('/widget-data', [AdminController::class, 'widgetData'])->name('widget.data');

    // Accounts (Salaries & Expenses)
    Route::get('accounts', [\App\Http\Controllers\Admin\AccountsController::class, 'dashboard'])->name('accounts.dashboard');
    // Salaries
    Route::get('accounts/salaries', [\App\Http\Controllers\Admin\AccountsController::class, 'salariesIndex'])->name('accounts.salaries.index');
    Route::get('accounts/salaries/create', [\App\Http\Controllers\Admin\AccountsController::class, 'salariesCreate'])->name('accounts.salaries.create');
    Route::post('accounts/salaries', [\App\Http\Controllers\Admin\AccountsController::class, 'salariesStore'])->name('accounts.salaries.store');
    Route::get('accounts/salaries/{payment}', [\App\Http\Controllers\Admin\AccountsController::class, 'salariesShow'])->name('accounts.salaries.show');
    Route::get('accounts/salaries/{payment}/edit', [\App\Http\Controllers\Admin\AccountsController::class, 'salariesEdit'])->name('accounts.salaries.edit');
    Route::put('accounts/salaries/{payment}', [\App\Http\Controllers\Admin\AccountsController::class, 'salariesUpdate'])->name('accounts.salaries.update');
    Route::post('accounts/salaries/{payment}/notes', [\App\Http\Controllers\Admin\AccountsController::class, 'salariesAddNote'])->name('accounts.salaries.notes.add');
    Route::delete('accounts/salaries/{payment}', [\App\Http\Controllers\Admin\AccountsController::class, 'salariesDestroy'])->name('accounts.salaries.destroy');
    // Salary Advances
    Route::get('accounts/advances', [\App\Http\Controllers\Admin\AccountsController::class, 'advancesIndex'])->name('accounts.advances.index');
    Route::post('accounts/advances', [\App\Http\Controllers\Admin\AccountsController::class, 'advancesStore'])->name('accounts.advances.store');
    Route::post('accounts/advances/{advance}/settle', [\App\Http\Controllers\Admin\AccountsController::class, 'advancesSettle'])->name('accounts.advances.settle');
    // Employee salary summary
    Route::get('accounts/employee/{user}/summary', [\App\Http\Controllers\Admin\AccountsController::class, 'employeeSummary'])->name('accounts.employee.summary');
    // Expenses
    Route::get('accounts/expenses', [\App\Http\Controllers\Admin\AccountsController::class, 'expensesIndex'])->name('accounts.expenses.index');
    Route::get('accounts/expenses/create', [\App\Http\Controllers\Admin\AccountsController::class, 'expensesCreate'])->name('accounts.expenses.create');
    Route::get('accounts/expenses/{expense}', [\App\Http\Controllers\Admin\AccountsController::class, 'expensesShow'])->name('accounts.expenses.show');
    Route::get('accounts/expenses/{expense}/edit', [\App\Http\Controllers\Admin\AccountsController::class, 'expensesEdit'])->name('accounts.expenses.edit');
    Route::put('accounts/expenses/{expense}', [\App\Http\Controllers\Admin\AccountsController::class, 'expensesUpdate'])->name('accounts.expenses.update');
    Route::post('accounts/expenses', [\App\Http\Controllers\Admin\AccountsController::class, 'expensesStore'])->name('accounts.expenses.store');
    Route::delete('accounts/expenses/{expense}', [\App\Http\Controllers\Admin\AccountsController::class, 'expensesDestroy'])->name('accounts.expenses.destroy');
    // Categories
    Route::get('accounts/categories', [\App\Http\Controllers\Admin\AccountsController::class, 'categoriesIndex'])->name('accounts.categories.index');
    Route::get('accounts/categories/{category}/edit', [\App\Http\Controllers\Admin\AccountsController::class, 'categoriesEdit'])->name('accounts.categories.edit');
    Route::put('accounts/categories/{category}', [\App\Http\Controllers\Admin\AccountsController::class, 'categoriesUpdate'])->name('accounts.categories.update');
    Route::post('accounts/categories', [\App\Http\Controllers\Admin\AccountsController::class, 'categoriesStore'])->name('accounts.categories.store');
    Route::post('accounts/categories/{category}/toggle', [\App\Http\Controllers\Admin\AccountsController::class, 'categoriesToggle'])->name('accounts.categories.toggle');
});

// Home Pages
Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/home02', [FrontController::class, 'home02'])->name('home02');
Route::get('/home03', [FrontController::class, 'home03'])->name('home03');
Route::get('/home04', [FrontController::class, 'home04'])->name('home04');
Route::get('/home05', [FrontController::class, 'home05'])->name('home05');

// Blog Pages (Dynamic)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Static Blog Pages (For templates)
Route::get('/blog/list', [FrontController::class, 'blogList'])->name('blog.list');
Route::get('/blog/grid', [FrontController::class, 'blogGrid'])->name('blog.grid');
Route::get('/blog/detail', [FrontController::class, 'blogDetail'])->name('blog.detail');
Route::get('/blog/single', [FrontController::class, 'blogSingle'])->name('blog.single');

// Property Pages
Route::get('/property/detail/v{version}', [FrontController::class, 'propertyDetail'])->name('property.detail');
Route::get('/property/filter-popup', [FrontController::class, 'propertyFilterPopup'])->name('property.filterPopup');
Route::get('/property/grid', [FrontController::class, 'propertyGrid'])->name('property.grid');
Route::get('/property/grid-left-sidebar', [FrontController::class, 'propertyGridLeftSidebar'])->name('property.gridLeftSidebar');
Route::get('/property/grid-right-sidebar', [FrontController::class, 'propertyGridRightSidebar'])->name('property.gridRightSidebar');
Route::get('/property/grid-search', [FrontController::class, 'propertyGridSearch'])->name('property.gridSearch');
Route::get('/property/full-width', [FrontController::class, 'propertyFullWidth'])->name('property.fullWidth');
Route::get('/property/half-map', [FrontController::class, 'propertyHalfMap'])->name('property.halfMap');

// Agency Pages
Route::get('/agency/list', [FrontController::class, 'agencyList'])->name('agency.list');
Route::get('/agency/details', [FrontController::class, 'agencyDetails'])->name('agency.details');

// User Account Pages
Route::get('/my-profile', [FrontController::class, 'myProfile'])->name('myProfile');
Route::get('/my-package', [FrontController::class, 'myPackage'])->name('myPackage');
Route::get('/my-save-search', [FrontController::class, 'mySaveSearch'])->name('mySaveSearch');

// Additional Pages
Route::get('/faq', [FrontController::class, 'faq'])->name('faq');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Subscription Routes
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe.store');
Route::post('/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('subscribe.unsubscribe');
Route::post('/resubscribe', [SubscriptionController::class, 'resubscribe'])->name('subscribe.resubscribe');
Route::get('/subscription/status', [SubscriptionController::class, 'checkStatus'])->name('subscription.status');
// Route::get('/contact/test', function() {
//     return response()->json(['message' => 'Contact route is working!']);
// });
Route::get('/dashboard', [FrontController::class, 'dashboard'])->name('dashboard');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('pricing');
Route::get('/review', [FrontController::class, 'review'])->name('review');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/career', [FrontController::class, 'about'])->name('career');
Route::get('/service-details', [FrontController::class, 'serviceDetails'])->name('serviceDetails');
Route::get('/home-loan-process', [FrontController::class, 'homeLoanProcess'])->name('homeLoanProcess');
Route::get('/welcome', [FrontController::class, 'welcome'])->name('welcome');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
