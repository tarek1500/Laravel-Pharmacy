<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pharmacy.auth:pharmacy');
    }

    /**
     * Show the Pharmacy dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return redirect()->route('dashboard.index');
    }
}
