<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  Illuminate\Support\Facades\DB;
use  App\Models\User;
use App\Http\Controllers\Profile\AvatarController;
use OpenAI\Laravel\Facades\OpenAI;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('home');
    // return view('home');

    // fetch all users
    // $users = DB::select("select * from users");
    // $users= User::find(1)->name;
    $user = new User(); // Assuming User is the class for your user entity
   
     


    // create users
    // $user= DB::insert("insert into users (name,email,password) values (?,?,?,?)",['Mary','mary31@gmail.com','mary']);
    // $user=DB::table('users')->insert([
    //     'name'=>'Mary',
    //     'email'=>'mary@gmail.com',
    //     'password'=>'4648791sdfafa'
    // ]);
    // $user=User ::create( [ 
    //     'name'=>'Harry',
    //     'email'=>'hari8@gmail.com',
    //     'password'=>'password'
    // ]);
    // $user=User ::create( [ 
    //     'name'=>'Marry',
    //     'email'=>'marri@gmail.com',
    //     'password'=>'password'
    // ]);
    // $user=User ::create( [ 
    //     'name'=>'John',
    //     'email'=>'john2@gmail.com',
    //     'password'=>('password')
    // ]);

    // update users
    // $user=DB::update("update users set email =? where id=?",['mary21@gmail.com','2']);
    // $user=DB::table('users')->where('id',3)->update([
    //     'email'=>'mary21@gmail.com'
    // ]
    // );
    // $user=User::find(6);
    // $user->update([
    //     'email'=>"johndoe@gmail.com"
    // ]);

    // delete users
    // $user=DB::delete("Delete from users where id=?",[2]);
    // $user=DB::table('users')->where('id',3)->delete();
    // 
    // $user=User::find(7);
    // $user->delete();
    // dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar',[AvatarController::class,'update'])->name('profile.avatar');
    Route::post('/profile/avatar/ai',[AvatarController::class,'generateAvatar'])->name('profile.avatar.ai');

});

require __DIR__.'/auth.php';

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    // Get the user from the github
    $user = Socialite::driver('github')->user();
    // using the user model if the user is available if availavle update if not create
    $user=User::updateOrCreate(['email'=>$user->email],[
        'name'=>$user->name,
        'password'=>'password',
    ]);
    Auth::login($user);
    return redirect('/dashboard');
    // dd($user);
});

