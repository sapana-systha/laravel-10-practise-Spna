<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;


class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {

        // $validated=$request->validate([

        // ]);

        // dd(auth()->user());
        // $path=$request->file('avatar')->store('avatar', 'public');
        $path = Storage::disk('public')->put('avatar', $request->file('avatar'));
        // dd($path);
        //  store avatars
        if ($oldAvatar = $request->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        };
        auth()->user()->update(['avatar' => $path]);

        return redirect(route('profile.edit'))->with('message', 'Avatar is updated successfully!');
    }
     public function generateAvatar(Request $request){
         $result = OpenAI::images()->create([
            "prompt" =>"Design an avatar that embodies the qualities of a young, cool, and cute girl IT professional.",
            'n'=> 1,
            'size'=>"256x256",
        ]);
       
        $contents=file_get_contents($result->data[0]->url);
        // dd($contents);
        $filename=Str::random(25);
        if ($oldAvatar = $request->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        };

       Storage::disk('public')->put("avatar/$filename.jpg", $contents);

        auth()->user()->update(['avatar' => "avatar/$filename.jpg"]);
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated successfully!');
       
     }

}
