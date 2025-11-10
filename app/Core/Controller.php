<?php

namespace App\Core;

class Controller {

    /**
     * Instancia um model pelo nome
     *
     * @param string $model 
     * @return object
     */
    public function model($model) {
        $modelClass = "App\\Models\\$model";

        if (!class_exists($modelClass)) {
            throw new \Exception("Model '$model' não encontrado.");
        }

        return new $modelClass();
    }

    /**
     * Carrega uma view
     *
     * @param string $view Caminho da view
     * @param array $dados Dados a serem usados na view
     */
    public function view($view, $dados = []) {
        $viewPath = __DIR__ . "/../Views/$view.php"; 
        if (!file_exists($viewPath)) {
            throw new \Exception("View '$view' não encontrada em '$viewPath'.");
        }
        extract($dados);
        require $viewPath;
    }
    

}
