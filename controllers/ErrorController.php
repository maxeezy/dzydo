<?php

include_once ROOT . '/models/USER.php';
class ErrorController
{
    private $title = "404";
    public function action404(){
        include_once ("views/404.php");
        return true;
    }
}