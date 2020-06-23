<?php

class Router{

    private $routes;

    public function __construct()
    {
        $routerPath = ROOT.'/config/routes.php'; // Путь к нашим роутам
        $this->routes = include($routerPath); // Присваиваем наш массив с роутами в свойство routes
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])){ // Если запрос не пустой
            return trim( $_SERVER['REQUEST_URI'] , '/'); // Делим запрос с помощью /
        }
    }

    public function run()
    {
        $uri = $this->getURI(); // Получили строку запроса
        $result =  null;
        foreach ($this->routes as $uriPattern => $path){ //Перебираем адрессную строку на совпадения с маршрутами

            if (preg_match("~^$uriPattern$~", $uri)) {

                $internalRoute = preg_replace("~^$uriPattern$~",$path,$uri); // Создаем внутренний путь


                $segments = explode('/', $internalRoute); // Разделяем для будещего контроллера и его метода

                $controllerName = ucfirst(array_shift($segments) . 'Controller'); // Записываем в переменную контроллер который надо будет вызвать. array_shift() Берёт первый
                //элемент массива и удаляет его. ucfirst() делает первый символ заглавным

                $actionName = 'action' . ucfirst(array_shift($segments)); // Тоже самое с action

                $parameters = $segments; // Тут остануться только нужные нам параметры($_GET)

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php'; // Конфигурируем путь до файла контроллера

                if (file_exists($controllerFile)) { // Если файл существует то подключаем его
                    include_once($controllerFile);
                }
                else{
                    continue;
                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject,$actionName),$parameters); // Вызываем нужный нам конфиг и метод с переданными в него параметрами
                if ($result != null) { // Если все ок то заканчиваем цикл
                    break;
                }
            }
        }

        if ($result == null){ //Если все же не было совпадений или было совпадение но нужного файла не нашлось, то собственно ручно вызываем контроллер с ошибкой
                include_once ( ROOT. '/controllers/ErrorController.php');
                $controllerObject = new ErrorController();
                $controllerObject->action404();
        }

    }


}
