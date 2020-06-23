<?php
include_once ROOT.'/models/USER.php';
include_once ROOT.'/models/Tournament.php';


class MainController
{
    private $title = "Соревнования дзюдо";
    public function actionIndex(){
        $tournaments = Tournament::get10LastTournaments();
        include_once ("views/index.php");
        return true;
    }


}