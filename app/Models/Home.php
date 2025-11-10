<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{

    
    /**
    * Chama a view da home
    */
    public function index()
    {
        $this->view('home');
    }
}