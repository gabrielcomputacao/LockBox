<?php

namespace Core;

class Routes
{

    public $routes = [];


    public function addRoute($uri, $controller, $httpMethod)
    {

        if (is_string($controller)) {

            $data =  [
                'class' => $controller,
                'method' => '__invoke'
            ];
        }
        if (is_array($controller)) {

            $data =  [
                'class' => $controller[0],
                'method' => $controller[1]
            ];
        }



        $this->routes[$httpMethod][$uri] = $data;
    }

    public function get($uri, $controller)
    {

        $this->addRoute($uri, $controller, 'GET');

        return $this;
    }

    public function post($uri, $controller)
    {
        $this->addRoute($uri, $controller, 'POST');

        return $this;
    }

    public function run()
    {

        $uri = '/' . str_replace('/', '', parse_url($_SERVER['REQUEST_URI'])['path']);

        $httpMethod = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$httpMethod])) {

            abort(404);
        }

        $routeInfo = $this->routes[$httpMethod][$uri];


        $class = $routeInfo['class'];
        $method = $routeInfo['method'];

        $classDinamic = new $class;

        $classDinamic->$method();
    }
}
