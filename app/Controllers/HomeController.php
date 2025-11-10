<?php

namespace App\Controllers;

use App\Core\Controller;
use function App\Helpers\verificarLogin; 

/**
* Valida se o usuário está logado antes de acessar a home
*/
class HomeController extends Controller
{
   public function index() {
        verificarLogin();
        $this->view('home');
    }
}