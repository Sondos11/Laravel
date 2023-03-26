<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\TestController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


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
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

Route::group(['middleware' =>['auth']],function(){

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');


});

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/delete/{post}', [PostController::class, 'delete'])->name('posts.delete');
Route::post('/comments/{post}',[CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}',[CommentController::class, 'destroy'])->name('comments.destroy');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
    
});

Route::get('/auth/callback', function () {
try {
        $userData = Socialite::driver('github')->user();
        $user = User::where('email', $userData->email)->first();
        if ($user) {
            Auth::login($user);
            return to_route('posts.index');
            }
            $user = new User();
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = Hash::make(Str::random(24));
            $user->save();
            Auth::login($user);
            return to_route('posts.index');

             } catch (Exception $e) {
            dd($e->getMessage());
        }
});

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
try {
        $userData = Socialite::driver('google')->user();
        $user = User::where('google_id',$userData->id)->first();
        if ($user) {
            Auth::login($user);
            return to_route('posts.index');
            }
            $user = new User();
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = Hash::make(Str::random(24));
            $user->save();
            Auth::login($user);
            return to_route('posts.index');

             } catch (Exception $e) {
            dd($e->getMessage());
        }
});


