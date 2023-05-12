<?php
declare(strict_types=1);

namespace App;

use App\Controller\ErrorController;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

final class Router
{
    protected $routes;

    private function __construct()
    {
        try {
            $this->routes = Yaml::parseFile('routes.yaml');
        } catch (ParseException $e) {
            echo 'Error parsing YAML file: ', $e->getMessage();
            exit;
        }
    }

    public static function getInstance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }

    public function match(Request $request)
    {
        $path = $request->getPath();
        $method = $request->getMethod();
        //$path = $_SERVER['REQUEST_URI'];
       // $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $name => $route) {
            $routePath = $route['path'];

            if (strpos($routePath, '{') !== false) {
                $routePath = preg_replace('#\{.*\}#', '.*', $routePath);
            }

            if (preg_match("#^$routePath$#", $path) && $route['method'] === $method) {
                return [
                    'name' => $name,
                    'controller' => $route['controller'],
                ];
            }
        }

        return false;
    }

    public function dispatch(Request $request)
    {
        $match = $this->match($request);

        if (!$match) {
            ErrorController::error404();
            exit;
        }

        $controller = $match['controller'];
        list($class, $method) = explode('::', $controller);

        call_user_func([new $class, $method]);
    }
}

