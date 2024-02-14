<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request){
       
        // $validated=$request->validate([
           
        // ]);
        
        
        // dd(auth()->user());
        $path=$request->file('avatar')->store('avatar');
        //  store avatars
        auth()->user()->update(['avatar'=> storage_path("app").("/$path")]);
        
        
        return redirect(route('profile.edit'))->with('message','Avatar is updated successfully!');

    }
}
