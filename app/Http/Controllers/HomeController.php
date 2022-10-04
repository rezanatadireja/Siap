<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function landingPage()
    {
        return view('guest.index');
    }

    public function index(Request $request)
    {
        // if (Auth::user()->hasRole('admin')) return $this->adminDashboard();
        // if (Auth::user()->hasRole('warga')) return $this->wargaDashboard();

        // return view('guest.index');
        $user = $request->user();
        
        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        }

        return $this->wargaDashboard();
    }

    protected function adminDashboard()
    {
        // dd(auth()->user()->hasRole('admin'));
        return view('admin.dashboard.index');
    }

    public function wargaDashboard()
    {
        return view('guest.index');
    } 
}