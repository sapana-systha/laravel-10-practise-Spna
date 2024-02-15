<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request){
       
        // $validated=$request->validate([
           
        // ]);
          
        // dd(auth()->user());
        // $path=$request->file('avatar')->store('avatar', 'public');
        $path=Storage::disk('public')->put('avatar',$request->file('avatar'));
        // dd($path);
        //  store avatars
        if($oldAvatar= $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar);
        };
        auth()->user()->update(['avatar'=> $path]);
         
        return redirect(route('profile.edit'))->with('message','Avatar is updated successfully!');

    }
}
