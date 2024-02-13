<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  Illuminate\Support\Facades\DB;
use  App\Models\User;
use App\Http\Controllers\Profile\AvatarController;

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
    return view('welcome');
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
    Route::patch('/profile/avatar',[AvatarController::class,'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
