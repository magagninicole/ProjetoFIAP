<?php


namespace App\Helpers;

function verificarLogin() {
    session_start();
    
    if (empty($_SESSION['logado'])) {
        header('Location: ' . url('Login'));
        exit;
    }
}