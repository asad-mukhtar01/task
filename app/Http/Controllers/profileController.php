<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use App\Models\User;
use Auth;
class profileController extends Controller
{
    //
    public function edit(){

    	return view('edit');
    }
    public function update(Request $request){
    	//return $request;
    	$validated = $request->validate([
            'avatar'  => 'required|dimensions:max_width=256,max_height=256',
            'name' => 'required|min:4|max:20|',
            'email' => 'required',
        ]);
    	if($request->has('avatar')){
            // profile photo
            $imageName = time().'.'.$request->avatar->extension(); 
            $img   = ImageManagerStatic::make($request->avatar)->encode('jpg');
            Storage::disk('public')->put($imageName, $img);
        }
        $user = User::find(Auth::id());
        $user->avatar = $imageName;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('message','Profile Updated Succesfully');
    }
}
