<?php

namespace Core;

use App\Middlewares\GuestMiddleware;

class Routes
{

    public $routes = [];


    public function addRoute($uri, $controller, $httpMethod, $middleware = null)
    {

        if (is_string($controller)) {

            $data =  [
                'class' => $controller,
                'method' => '__invoke',
                'middleware' => $middleware
            ];
        } else if (is_array($controller)) {

            $data =  [
                'class' => $controller[0],
                'method' => $controller[1],
                'middleware' => $middleware
            ];
        }

        $this->routes[$httpMethod][$uri] = $data;
    }

    public function get($uri, $controller, $middleware)
    {

        $this->addRoute($uri, $controller, 'GET', $middleware);

        return $this;
    }

    public function post($uri, $controller, $middleware)
    {
        $this->addRoute($uri, $controller, 'POST', $middleware);

        return $this;
    }

    public function put($uri, $controller, $middleware)
    {
        $this->addRoute($uri, $controller, 'PUT', $middleware);

        return $this;
    }

    public function run()
    {

        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

        $httpMethod = isset($_POST['__method']) ? $_POST['__method'] : $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$httpMethod])) {

            abort(404);
        }

        $routeInfo = $this->routes[$httpMethod][$uri];


        $class = $routeInfo['class'];
        $method = $routeInfo['method'];
        $middleware = $routeInfo['middleware'];

        if ($middleware) {

            $m = new $middleware;

            $m->handle();
        }



        $classDinamic = new $class;

        $classDinamic->$method();
    }
}
