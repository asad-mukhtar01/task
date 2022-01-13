<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invitation;
use Mail;
use App\Models\User;
use Hash;
class invitationController extends Controller
{
    //
    public function active(Request $request){
        $validated = $request->validate([
            'code' => 'required',
        ]);
    	$check = invitation::where('invitation_token',$request->token)->where('otp',$request->code)->first();
    	$check->status = 1;
    	$check->save();
    	$user = User::where('email',$check->email)->first();
    	$user->status = 1;
    	$user->save();
    	return redirect(route('login'));
    }

    public function check($token=""){
    	$check = invitation::where('invitation_token',$token)->first();
    	if($check){
    		return view('invitation',compact('check'));
    	} else {
    		return redirect()->back();
    	}
    }

    public function createnewuser(request $request){
        $validated = $request->validate([
            'name' => 'required|min:4|max:20|',
            'email' => 'required',
            'password' => 'required',
        ]);
    	$to = $request->token;
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
    	$user->save();

    	$otp = rand(100000,999999);
    	$token = invitation::where('invitation_token',$request->token)->first();
    	$token->otp = $otp;
    	$token->save();
    	$msg = array(
	            'Fname' => 'maroof khalid',
	            'otp' => $otp
	        );
	    Mail::send('email.opt', $msg , function($message) use ($request)
	    {
	        $message->from('maroofkhalid499@gmail.com');
	        $message->to($request->email, 'SkillInsiderz')->subject('I am invitation_token');
	    });
		return view('otp',compact('to'));

    }
    public function store(Request $request)
	{
		$em = $request->email;
		$token = $this->generateInvitationToken($em);
	    $invitation = new invitation;
	    $invitation->email = $request->email;
	    $invitation->invitation_token = $token;
	    $invitation->save();
	     $msg = array(
	            'Fname' => 'Asad Mukhtar',
	            'token' => $token
	        );
	    Mail::send('email.invitation', $msg , function($message) use ($request)
	    {
	        $message->from('maroofkhalid499@gmail.com');
	        $message->to($request->email, 'SkillInsiderz')->subject('We Invited you to create account');
	    });
	    return redirect()->back()->with('messsage','You Have Invited Successfully');

	}
	public function generateInvitationToken($em) {
	    $code = substr(md5(rand(0, 9) . $em . time()), 0, 32);
	    return $code;
	}
}