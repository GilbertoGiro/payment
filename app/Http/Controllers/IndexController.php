<?php

namespace App\Http\Controllers;

class IndexController extends AbstractController
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
