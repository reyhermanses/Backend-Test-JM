<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function employee()
    {
        return view('employee');
    }

    public function unit()
    {
        return view('unit');
    }

    public function menu($menu)
    {
        switch ($menu) {
            case "dashboard":
                return 'dashboard';
                break;
            case "unit":
                return 'unit';
                break;
            case "karyawan":
                return 'employee';
                break;
            default:
                return '';
                break;
        }

        // return view($menu);

        // return $menu;
    }

    public function login(){
        return view('auth.login');
    }
}
