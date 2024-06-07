<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountXController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('accounts/home');
    }

    public function index()
    {
        return view('accounts/index');
    }

    public function report()
    {
        return view('accounts/report');
    }

    public function add_expense()
    {
        return view('accounts/add-expense');
    }

    public function save_expense()
    {
        return view('accounts/add-expense');
    }
}