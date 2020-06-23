<?php
include_once ROOT . '/models/USER.php';
include_once ROOT . '/models/Sex.php';
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Tournament.php';
include_once ROOT . '/models/Wins.php';
include_once ROOT . '/models/Match.php';

class TournamentsController
{
    private $title = "Турниры | Соревнования дзюдо";
    public function actionIndex(){
        $tournaments = Tournament::get10LastTournaments();
        include_once ("views/tournamentIndex.php");
        return true;
    }

    public function actionView($id){
        Tournament::issetTournament($id);
        $participants = Tournament::getUserByIdTournament($id);
        $stagesPath = ROOT . "/config/stages.php";
        $stages = include($stagesPath);
        $pattern = $stages[count($participants)];
        $tournament = Tournament::getTournament($id);
        $matches = Tournament::getFightsByIdTourn($id);
        $idU = USER::isLogged();
        $user = USER::getUser($idU);
        $result = false;
        if (isset($_POST['submit'])){
            $errors = false;
            if (!USER::isLogged()){
                $errors[] = "Вы должны быть авторизированы как спортсмен";
            }
            else{
                if (!Tournament::checkUserForTournament($id,$idU)){
                    $errors[] = "Вы не подходите для этого турнира";
                }
                if (!Tournament::checkRequestForTournament($id,$idU)){
                    $errors[] = "Ваша заявка уже была подана";
                }
                if (!Tournament::checkRootForToss($id)){
                    $errors[] = "Жеребьевка уже проведена";
                }

            }

            if ($errors==false){
               $result = Tournament::tryRequest($id,$idU);
            }
        }

        include_once ("views/tournamentView.php");
        return true;
    }

    public function actionMatchView($idT,$idM){
        Tournament::issetTournament($idT);
        Tournament::issetFight($idM);
        $tournament = Tournament::getTournament($idT);
        $participants = Tournament::getUserForMatch($idM);
        $fight = Tournament::getFightById($idM);
        $winsType = Wins::getTypeWins();


        include_once ("views/matchView.php");
        return true;
    }
}