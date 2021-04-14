<?php
class App
{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        //si el url esta vacio redirige al login
        if (empty($url[0])) {

            error_log('APP::construct->no hay controlador especificado');

            //cargo el archivo del controlador
            $archivoController = 'controllers/login.php';
            require_once $archivoController;

            //inicializo una nueva instancia del controlador
            $controller = new Login();

            //cargo el modelo y renderizo la vista
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . '.php';

        if (file_exists($archivoController)) {
            require_once $archivoController;

            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if (isset($url[1])) {

                //validamos los metodos
                if (method_exists($controller, $url[1])) {
                    if (isset($url[2])) {
                        //saco el numero de parametros
                        $nparam = count($url) - 2;

                        //creo un array para contener los metodos
                        $params = [];
                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($params, $url[$i] + 2);
                        }

                        //paso al controlador el array con los metodos
                        $controller->{$url[1]}($params);
                    } else {
                        //no tiene mas parametros, se llama el metodo tal cual
                        $controller->{$url[1]}();
                    }
                } else {
                    //error, no existe el metodo
                }
            } else {
                //si no hay metodo a cargar, se carga el metodo render por default
                $controller->render();
            }
        } else {
        }
    }
}
