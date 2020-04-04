<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
     /**
     * Show the Doctor dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        
        return redirect()->route('dashboard.index');
    }
}
