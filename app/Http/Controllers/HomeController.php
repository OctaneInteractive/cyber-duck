<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\MenuTrait;

class HomeController extends Controller
{

    use MenuTrait;

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
    public function index()
    {

        $sidebar = $this->getSidebar();

        return view('admin')->with($sidebar);

    }
}
