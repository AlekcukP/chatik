<?php
    class Route
    {
        public static function start()
        {
            $controller_name = 'login';
            $action_name = 'index';

            $routes = explode('/', $_SERVER['REQUEST_URI']);

            if (!empty($routes[1])) {
                $controller_name = $routes[1];
            }

            if (!empty($routes[2])) {
                $action_name = $routes[2];
            }

            $model_name = 'Model_'.$controller_name;
            $model_file = strtolower($model_name).'.php';
            $model_path = 'application/models/'.$model_file;

            $controller_file = 'controller_'.$controller_name.'.php';
            $controller_name = 'Controller'.ucfirst($controller_name);
            $controller_path = "application/controllers/".$controller_file;

            $action_name = 'action'.ucfirst($action_name);

            if (file_exists($model_path)) {
                include $model_path;
            }

            if(file_exists($controller_path)) {
                include $controller_path;
            } else {
                Route::ErrorPage404();
            }

            $controller = new $controller_name;
            $action = $action_name;

            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                Route::ErrorPage404();
            }
        }

        static function ErrorPage404()
        {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';

            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location:'.$host.'404');
        }
    }
