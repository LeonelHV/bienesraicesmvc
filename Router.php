<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {

        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {

        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas()
    {
        session_start();

        $auth = $_SESSION['login'] ?? null;
        //Arreglo de rutas Protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        // $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
//debuguear($urlActual);
//debuguear($_SERVER);
if(strpos($urlActual, '?')){ // tuve que crear este if para que cuando sea un get, tome el redirect y no el request
     $urlActual = $_SERVER['REDIRECT_URL'];
}
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null; //Accede al key del arreglo y le asigna el valor(funcion) a $fn .
        } else {

            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        //Proteger las rutas

        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location:/');
        }
        if ($fn) {
            //La URL existe y hay una función asociada
            call_user_func($fn, $this);
        } else {
            echo "Página no encontrada";
        }
    }

    //Muestra una Vista
    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start(); //Almacenamiento en memoria durante un momento...
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();    //limpia el Buffer

        include __DIR__ . "/views/layout.php";
    }
}
