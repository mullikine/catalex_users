<?php

namespace App\Http\Controllers\Auth;

use App\FirstLoginToken;
use App\Http\Controllers\Controller;
use App\Library\Invite;
use App\Library\Mail;
use App\Library\Mail\InviteNewUserToSignDocument;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FirstLoginController extends Controller
{
    public function index(Request $request, $token = null)
    {
        if (!$token) {
            throw new NotFoundHttpException();
        }

        // Get the user
        $user = Invite::getUser($token);

        if (!$user) {
            throw new NotFoundHttpException();
        }

        return view('auth.first-login')->with([
            'token'            => $token,
            'user'             => $user,
            'userOrganisation' => $user->organisation,
            'next'             => $request->next,
        ]);
    }

    public function setPassword(Request $request)
    {
        // Validate token and password exist and password is confirmed
        $this->validate($request, [
            'token'    => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        // Get the user for this token
        $user = Invite::getUser($request->token);

        // Check we found a user
        if (!$user) {
            return redirect()->back()->with('errors', collect('Invalid token'));
        }

        // Change the user's password
        $user->password = Hash::make($request->password);
        $user->email_verified = true; // this route is accessed by an email, this means their account is verified
        $user->save();

        // Log the user in
        Auth::login($user);

        return $request->next ? redirect($request->next) : redirect('/')->with('status', 'Password set');
    }

    public function loginToSign(Request $request, $token = null)
    {
        if (!$token) {
            throw new NotFoundHttpException();
        }
        //if logged, just redirect
        if (!!Auth::user()) {
            return redirect($request->next);
        }

        $user = Invite::getUser($token);

        if (!$user) {
            // if you get here, then you are not logged in, better just redirect to login page
            return redirect('/auth/login?next=' . $request->next);
        }

        $user->email_verified = true; // this route is accessed by an email, this means their account is verified
        $user->save();

        // Login the user
        Auth::login($user);

        return redirect($request->next);
    }

    public function requestLoginToken(Request $request)
    {
        $user = $request->user();

        if ($user) {
            return redirect($request->next);
        }

        $user = User::find($request->user_id);

        if (!$user || !$user->is_shadow_user) {
            throw new NotFoundHttpException();
        }

        return view('auth.request-login-token');
    }

    public function sendLoginToken(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user || !$user->is_shadow_user) {
            throw new NotFoundHttpException();
        }

        $tokenInstance = FirstLoginToken::createToken($user);

        $data = [
            'name'  => $user->name,
            'token' => $tokenInstance->token,
            'next'  => $request->next,
        ];

        Mail::queueStyledMail('emails.login-token', $data, $user->email, $user->name, 'Login to CataLex');

        return view('auth.login-token-sent');
    }
}
