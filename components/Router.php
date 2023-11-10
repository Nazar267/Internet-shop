<?php

class Router {
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT. '/config/routes.php';
        $this->routes = include($routesPath);
    }


    public function run() {
       
        // Отримати стрічку запиту
        $uri = trim($_SERVER['REQUEST_URI'], '/');
       
        // Перевірити наявність такого запиту в роутах
        foreach ($this->routes as $uriPattern => $path) {

            if(preg_match("~$uriPattern~", $uri)) {
                // Якщо є співпадіння, то визначити,
                // controller та action
               
                // echo "<br> Де шукаємо(запит, який набрав користувач): $uri"; 
                // echo "<br> Що шукаємо(співпадіння з правила): $uriPattern"; 
                // echo "<br> Хто обробляє: $path"; 
                // echo "<br> Потрібно сформувати: $internalRoute";
                
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                

                $segments = explode('/', $internalRoute);
               

                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segments));

                

                // Підкючити клас контроллера
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                include_once($controllerFile);

                // Стоврити обє'кт, викликати метод(action)
                $controllerObject = new $controllerName;

                // $result = $controllerObject->$actionName($segments);

                $result = call_user_func_array(array($controllerObject, $actionName), $segments);


                if($result != null)
                    break;

            }

        }



       


    }

}