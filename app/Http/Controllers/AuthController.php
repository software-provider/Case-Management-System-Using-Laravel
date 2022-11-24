<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Middleware\VerifyCsrfToken;

class AuthController extends Controller {

    // login request handler
    public function doLogin(Request $request) {

        // get all the required attributes
        $attr = request([ 'email', 'password']);

        // validate form data
        $validation = Validator::make($request->all(),[
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:5'
        ], [
            'email' => 'Invalid email address provided!',
            'password' => 'Password length is too short!'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return view('login', ['message' => $validation->errors()->first()]);
        }

        // check if we had authentication error
        if (!Auth::attempt($attr)) {
            return view('login', ['message' => 'Combination of email and password not found!']);
        }

        // check if account status
        if(strtolower(Auth::user()['account_status']) == "inactive" || strtolower(Auth::user()['account_status']) == "banned") {

            // build custom error message
            $errorMessage = 'Login failed! Reason: Account '. Auth::user()['account_status'];

            // force logout inactive or banned account
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // return to login with error message
            return view('login', ['message' => $errorMessage]);
        }

        // login was successful return success response
        return redirect('/dashboard');;
    }

    // show login form
    public function showLoginForm() {

        // check if user already logged in
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        // not logged in show default login page
        return view('login');
    }

    // logout operation handler
    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
