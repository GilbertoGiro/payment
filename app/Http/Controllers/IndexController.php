<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;

class IndexController extends Controller
{
    /**
     * Method to load application home page
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     */
    public function index()
    {
        return view('index.index');
    }
}
