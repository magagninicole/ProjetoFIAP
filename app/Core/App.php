<?php
namespace App\Core;

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';             
    protected $params = [];

    protected $routes = [
        'Home' => 'HomeController@index',        
        'Aluno' => 'AlunoController@index',
        'Aluno/cadastrar' => 'AlunoController@cadastrar',
        'Aluno/atualizar' => 'AlunoController@atualizar',
        'Aluno/atualizarSenha' => 'AlunoController@atualizarSenha',
        'Aluno/deletar' => 'AlunoController@deletar',

        'Turma' => 'TurmaController@index',
        'Turma/cadastrar' => 'TurmaController@cadastrar',
        'Turma/deletar' => 'TurmaController@deletar',

        'Administrador' => 'AdministradorController@index',
        'Administrador/cadastrar' => 'AdministradorController@cadastrar',
        'Administrador/atualizar' => 'AdministradorController@atualizar',
        'Administrador/deletar' => 'AdministradorController@deletar',
        
        'Login' => 'LoginController@index', 
        'Login/autenticar' => 'LoginController@autenticar',  
        'Login/sair' => 'LoginController@sair',

        'Matricula/obterMatriculas' => 'MatriculaController@obterMatriculas',
        'Matricula/cadastrar' => 'MatriculaController@cadastrar',
        'Matricula/deletar' => 'MatriculaController@deletar',
    ];

    public function __construct() {
        $url = $this->parseUrl();

        $routeKey = implode('/', array_slice($url, 0, 2)); 

        if (array_key_exists($routeKey, $this->routes)) {
            $controllerMethod = explode('@', $this->routes[$routeKey]);
            $this->controller = $controllerMethod[0];
            $this->method = $controllerMethod[1];
            $this->params = array_slice($url, 2); 
        } else {
            $this->controller = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : $this->controller;
            $this->method = isset($url[1]) ? $url[1] : $this->method;
            $this->params = array_slice($url, 2);
        }

        $this->params = array_slice($url, 2);

        if (!class_exists("App\\Controllers\\" . $this->controller)) {
            die("Controller {$this->controller} não encontrado.");
        }

        $controllerInstance = "App\\Controllers\\" . $this->controller;
        $controller = new $controllerInstance;

        if (!method_exists($controller, $this->method)) {
            die("Método {$this->method} não encontrado no controller {$this->controller}.");
        }

        call_user_func_array([$controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
