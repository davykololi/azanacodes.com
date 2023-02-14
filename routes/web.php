<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Editor\EditorController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Admin\EditorUserController;
use App\Http\Controllers\Admin\AuthorUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Author\ArticleController;
use App\Http\Controllers\Editor\EditorArticleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\FrontEndArticleController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\PagesController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Author\AuthorProfileController;
use App\Http\Controllers\Editor\EditorProfileController;
use App\Http\Controllers\User\NewsLetterController;
use App\Http\Controllers\Admin\FrontEndUsersController;
use App\Http\Controllers\User\SEODetailsController;
use App\Http\Controllers\User\TailwindCssController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserChangePasswordController;
use App\Http\Controllers\Admin\UserBanController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\All\CKEditorController;
use App\Http\Controllers\TinymceImageUploadController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//BlogController Route
Route::get('/blog',BlogController::class)->name('blog');
//SEODetails Route
Route::get('services/seo',SEODetailsController::class)->name('services.seo');
//Backend Programming Route
Route::get('services/taiwindcss',TailwindCssController::class)->name('services.tailwindcss');
//Comments Route
Route::post('comments/store', [CommentController::class, 'store'])->name('store.comment');
Route::controller(FrontEndArticleController::class)->group(function(){
	Route::get('/category/{slug}', 'category')->name('category.articles');
	Route::get('/article/{slug}', 'article')->name('article.details');
	Route::get('/tag/{slug}', 'tag')->name('tag.articles');
	Route::get('/article-by/{slug}', 'articleBy')->name('articleBy.articles');
});

//Blog Pages Routes
Route::controller(PagesController::class)->group(function(){
	Route::get('/contact', 'contact')->name('contact')->middleware('doNotCacheResponse');
	Route::post('/contact-store', 'store')->name('contact.store');
	Route::get('/portfolio', 'portfolio')->name('portfolio');
	Route::get('/about', 'about')->name('about');
	Route::get('/policy', 'policy')->name('policy');
	Route::get('/terms-of-service', 'termsOfService')->name('terms.of.servive');
});

//Newsletter Route
Route::post('newsletter', [NewsLetterController::class, 'store'])->name('newsletter');
// TinyMce Image Upload
Route::post('/file-upload',[TinymceImageUploadController::class, 'upload'])->middleware('auth');
// Social login routes
Route::controller(LoginController::class)->group(function(){
	Route::get('login/{provider}','redirectToProvider');
	Route::get('{provider}/callback','handleProviderCallback');
});
//Authorization routes
Route::group(['middleware'=>'doNotCacheResponse'],function(){
	Auth::routes(['register'=>false]);
});

Route::group(['middleware'=>'prevent-back-history'],function(){ // Start of prevent-back-history middleware
	
Route::prefix('vistor')->name('visitor.')->middleware(['auth','visitor'])->group(function(){
	Route::get('/change-password',[UserChangePasswordController::class,'index'])->name('change.password')->middleware('doNotCacheResponse');
	Route::post('/change-password',[UserChangePasswordController::class,'userChangePassword']);
	//Role User User Profile
	Route::get('/profile',  [UserProfileController::class, 'visitorProfile'])->name('profile')->middleware('doNotCacheResponse');
	Route::post('/profile-store',  [UserProfileController::class, 'store'])->name('store-profile')->middleware('doNotCacheResponse');
});

Route::prefix('admin')->name('admin.')->middleware(['auth','admin','impersonate.protect','can:isAdmin','doNotCacheResponse','password.confirm'])->group(function(){
	Route::get('/dashboard',AdminController::class)->name('dashboard');
	Route::resource('/editors',EditorUserController::class);
	Route::resource('/authors',AuthorUserController::class);
	Route::resource('/categories',CategoryController::class);
	Route::resource('/tags',TagController::class);
	Route::get('/front-end-users',FrontEndUsersController::class)->name('frontendusers');
	Route::get('/bann/{id}',[UserBanController::class,'ban'])->name('bann');
    Route::get('/revoke-bann/{id}',[UserBanController::class,'revoke'])->name('revoke');
	Route::get('impersonate/{id}',[ImpersonateController::class,'impersonate'])->name('impersonate');
	
});

Route::prefix('editor')->name('editor.')->middleware(['auth','editor','can:isEditor','admin_ban','doNotCacheResponse','password.confirm'])->group(function(){
	Route::get('/dashboard',EditorController::class)->name('dashboard');
	Route::resource('/articles',EditorArticleController::class);
	Route::get('impersonate-leave',[ImpersonateController::class,'impersonateLeave'])->name('impersonate-leave');
	//Role Editor Profile
	Route::get('/profile/dashboard',  [EditorProfileController::class, 'profileDashboard'])->name('profile.dashboard');
	Route::post('/profile/store',  [EditorProfileController::class, 'store'])->name('profile.store');
	Route::post('/profile/update/{profile}',  [EditorProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('author')->name('author.')->middleware(['auth','author','can:isAuthor','admin_ban','doNotCacheResponse','password.confirm'])->group(function(){
	Route::get('/dashboard',AuthorController::class)->name('dashboard');
	Route::resource('/articles',ArticleController::class);
	Route::get('impersonate-leave',[ImpersonateController::class,'impersonateLeave'])->name('impersonate-leave');
	Route::post('/upload-image',[CKEditorController::class,'upload'])->name('upload');
	//Role Author Profile
	Route::get('/profile/dashboard',  [AuthorProfileController::class, 'profileDashboard'])->name('profile.dashboard');
	Route::post('/profile/store',  [AuthorProfileController::class, 'store'])->name('profile.store');
	Route::post('/profile/update/{profile}',  [AuthorProfileController::class, 'update'])->name('profile.update');
});

}); // End of prevent-back-history middleware
//RSS Feed route
Route::feeds();