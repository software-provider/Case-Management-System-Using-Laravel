<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {

    public function show() {

        // check and show view according to account type
        switch(auth()->user()->account_type) {

            case 'Admin':
                return view('admin_dashboard');
                break;

            case 'Client':
                return view('client_dashboard');
                break;

            case 'Law Firm':
                return view('law_firm_dashboard');
                break;

            default:
                return redirect('/login');
        }
    }
}
