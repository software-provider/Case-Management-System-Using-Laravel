<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Hash;

class UserDataController extends Controller{

    // get all users from database
    public function getUserList() {

        // check if user already logged in and has permission
        if (Auth::check() && Auth::user()->account_type == 'Admin') {

            // return response with all account type data
            return response()->json(array("response" => "success", "data" => User::where('id', '!=', Auth::user()->id)->orderBy('id')->get()->all()));
        } else if (Auth::check() && Auth::user()->account_type == 'Manager') {

            // return response with user type data
            return response()->json(array("response" => "success", "data" => User::where('id', '!=', Auth::user()->id)->where('account_type', '=', 'User')->orderBy('id')->get()->all()));
        } else {

            // user authentication failed so response with error message
            return response()->json(array("response" => "failed", "message" => "Authentication failed! Please re-login and try again!"));
        }
    }

    // get all lf type users from database
    public function getLfList() {

        return response()->json(array("response" => "success", "data" => User::where('account_type', '=', 'Law Firm')->orderBy('name')->select('id', 'name')->get()->all()));
    }

    // get all allowed users from database
    public function getAllowedUserList(Request $request) {

        return response()->json(array("response" => "success", "data" => User::select('id', 'name')->orderBy('name')->get()->all()));
    }

    // get all client users from database
    public function getClientList() {

        return response()->json(array("response" => "success", "data" => User::select('id', 'name')->orderBy('name')->where('account_type', '=', 'Client')->get()->all()));
    }

    // add new user
    public function addUser(Request $request) {

        // check if user already logged in and has permission
        if (Auth::check() && (Auth::user()->account_type == 'Admin' || Auth::user()->account_type == 'Manager')) {

            // check if user has ability to create certain type of account
            if(Auth::user()->account_type == 'Client' || Auth::user()->account_type == 'LF') {
                return response()->json(array("response" => "failed", "message" => "You don't have permission to create new account!"));
            }

            // validate data
            $validation = Validator::make($request->all(),[
                'name' => 'required|min:2|max:50',
                'email' => 'unique:users,email|required|email:rfc,dns',
                'password' => 'required|min:5',
                'account_type' => 'in:Admin,Law Firm,Client',
                'account_status' => 'in:Active,Inactive,Banned',
                'phone' => 'nullable|min:5|max:20',
                'address' => 'nullable|min:5|max:1000'
            ]);

            // check if validation fails occured and return the first error
            if($validation->fails()) {
                return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
            }

            // declare new user object
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->account_type = $request->account_type;
            $user->account_status = $request->account_status;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if($user->save()) {
                return response()->json(array("response" => "success", "message" => "User account added successfully!"));
            } else {
                return response()->json(array("response" => "failed", "message" => "Email already exist in our database!"));
            }
        } else {

            // user authentication failed so response with error message
            return response()->json(array("response" => "failed", "message" => "Authentication failed! Please re-login and try again!"));
        }
    }

    // update old user
    public function updateUser(Request $request) {

        // check if user already logged in and has permission
        if (Auth::check() && Auth::user()->account_type == 'Admin') {

            // validate data
            $validation = Validator::make($request->all(),[
                'name' => 'required|min:2|max:50',
                'email' => 'required|email:rfc,dns',
                'password' => 'nullable|min:5',
                'account_type' => 'in:Admin,Law Firm,Client',
                'account_status' => 'in:Active,Inactive,Banned',
                'phone' => 'nullable|min:5|max:20',
                'address' => 'nullable|min:5|max:1000'
            ]);

            // check if validation fails occured and return the first error
            if($validation->fails()) {
                return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
            }

            // check if email being used by other user
            $countEmailUsage = User::where('id', '!=', $request->id)->where('email', '=', $request->email)->count();
            if($countEmailUsage > 0 && Auth::user()->email != $request->email) {
                return response()->json(array("response" => "failed", "message" => "Email already being used by another user!"));
            }

            // get user from database
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if(strlen($request->password) >= 5) {
                $user->password = Hash::make($request->password);
            }
            $user->account_type = $request->account_type;
            $user->account_status = $request->account_status;
            $user->phone = $request->phone;
            $user->address = $request->address;

            // update user
            if($user->save()) {
                return response()->json(array("response" => "success", "message" => "User data updated successfully!"));
            } else {
                return response()->json(array("response" => "failed", "message" => "Email already exist in our database!"));
            }
        } else {

            // user authentication failed so response with error message
            return response()->json(array("response" => "failed", "message" => "Authentication failed! Please re-login and try again!"));
        }
    }

    // delete old user
    public function deleteUser(Request $request) {

        // check if user already logged in and has permission
        if (Auth::user()->account_type == 'Admin') {

            // delete by id
            if(User::where('id', $request->id)->delete()) {

                // return with response
                return response()->json(array("response" => "success", "message" => "User account deleted successfully!"));
            } else {

                // return with response
                return response()->json(array("response" => "failed", "message" => "Unable to delete account! Please try again later!"));
            }
        } else {

            // user authentication failed so response with error message
            return response()->json(array("response" => "failed", "message" => "Authentication failed! Please re-login and try again!"));
        }
    }
}
