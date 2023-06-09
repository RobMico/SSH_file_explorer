<?php

namespace mymvc\core;

class Router
{
    public string $viewsPath;
    //['GET':['/users':function, '/hello':function], 'POST':['/users':function, '/hello':function]]
    protected array $routes = ['GET' => [], 'POST' => []];
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? null;
        if ($callback === null) {
            $path = $this->viewsPath . $this->request->getPath();
            echo $this->request->getPath();

            if (str_contains($path, '..')) {
                exit("NOT FOUND");
            } else {
                require $path;
            }
            return;
        }

        //T O D O
        if (is_string($callback)) {
            if (!empty($this->viewsPath)) {
                return $this->renderView($callback);
                ;
            }
            echo "Views path not specified";
            return;
        }

        return call_user_func($callback, $this->request->getArgs());
    }

    protected function layoutContent()
    {
        ob_start();
        include_once "$this->viewsPath/layouts/main.php";
        return ob_clean();
    }
    protected function viewContent($view)
    {
        ob_start();
        include_once "$this->viewsPath/$view.php";
        return ob_clean();
    }

    public function renderView($view)
    {
        require($this->viewsPath . '/' . $view);
    }

}