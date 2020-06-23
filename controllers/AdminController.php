<?php

include_once ROOT . '/models/USER.php';
include_once ROOT . '/models/Sex.php';
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Tournament.php';
include_once ROOT . '/models/Wins.php';
include_once ROOT . '/models/Match.php';
include_once ROOT . '/models/Club.php';
include_once ROOT . '/models/Request.php';

class AdminController
{
    private function checkRoots()
    {
        $userId = USER::isLogged();
        $user = USER::getUser($userId);
        if ($user->role == "admin") {
            return true;
        } else {
            header("Location: /");
        }
    }

    public function actionIndex()
    {
        $this->checkRoots();

        include_once 'views/adminIndex.php';
        return true;
    }

    public function actionTournaments()
    {
        $this->checkRoots();
        $tournaments = Tournament::getAllTournametsInfo();
        include_once 'views/adminTournaments.php';
        return true;
    }

    public function actionTournamentsView($id){
        $this->checkRoots();
        Tournament::issetTournament($id);

        $participants = Tournament::getUserByIdTournament($id);
        $stagesPath = ROOT . "/config/stages.php";
        $stages = include($stagesPath);
        $pattern = $stages[count($participants)];
        $tournament = Tournament::getTournament($id);
        $matches = Tournament::getFightsByIdTourn($id);

        include_once 'views/adminTournamentsView.php';
        return true;
    }



    public function actionTournamentsAdd()
    {
        $this->checkRoots();
        $getCategory = Category::getCategory();
        $getSex = Sex::getSexTrue();
        $result = false;
        $name = '';
        $weight = '';

        if (isset($_POST['submit'])){
            $name = trim($_POST['name']);
            $weight = trim($_POST['weight']);
            $sex = $_POST['sex'];
            $category = $_POST['category'];
            $date = $_POST['data'];
            $errors = false;

            if (!Tournament::checkName($name)){
                $errors[] = "Имя турнира не должно быть короче одного символа";
            }

            if (!Sex::checkSex($sex)){
                $errors[] = "Выберите корректный пол";
            }

            if (!Category::checkCategory($category)){
                $errors[] = "Выберите корректную категорию";
            }

            if (!Tournament::checkWeight($weight)){
                $errors[] = "Введите корректную весовую категорию. Минимальный вес - максимальный вес. Через тире";
            }

            if (!Tournament::checkData($date)){
                $errors[] = "Нельзя создать турнир задним числом";
            }

            if ($errors == false){
                $result = Tournament::newTournament($name,$weight,$date,$sex,$category);
            }


        }

        include_once 'views/adminTournAdd.php';
        return true;
    }
    public function  actionInvite($id){
        $this->checkRoots();
        Tournament::issetTournament($id);
        $users = USER::getUsersForInvite($id);
        $request = Request::getRequestsByIdTournament($id);

        $result = false;
        include_once 'views/adminInvite.php';
        return  true;
    }

    public  function actionRequestDelete($id){
        $this->checkRoots();
        $result = false;
        if (isset($_POST['submit'])){
            $result = Tournament::deleteRequest($id);
        }
        include_once 'views/adminDeleteRequest.php';
        return true;
    }

    public function actionInviteTry($idTour,$idUser){
        $this->checkRoots();
        Tournament::issetTournament($idTour);
        if (!Tournament::checkUserForTournament($idTour,$idUser)){
            header("Location: /admin/tournaments/invite/$idTour");
        }
        $user = USER::getUser($idUser);
        $tournament = Tournament::getTournament($idTour);
        $result = false;
        if (isset($_POST['submit'])){

            if (!Tournament::checkUserForTournament($idTour,$idUser)){
                header("Location: /admin/tournaments/invite/$idTour");
            }
            else{
                $result = Tournament::addUserToTournament($idTour,$idUser);

            }
        }

        include_once 'views/adminInviteTry.php';
        return true;
    }

    public function actionToss($id){
        $this->checkRoots();
        Tournament::issetTournament($id);
        $tournament = Tournament::getTournament($id);
        $result = false;

        if (isset($_POST['submit'])){

            $errors = false;

            if (!Tournament::checkCountUserForToss($id)){
                $errors[] = "Недопустимое количество участников. Минимальное количество 2, маскимальное 16";
            }
            if (!Tournament::checkRootForToss($id)){
                $errors[] = "Жеребьевка уже была проведена";
            }

            if ($errors == false){

                $result = Tournament::toss($id);
            }
        }
        include_once 'views/adminToss.php';
        return true;
    }

    public function actionMatchEdit($idT,$idM){
        $this->checkRoots();
        Tournament::issetTournament($idT);
        Tournament::issetFight($idM);
        $tournament = Tournament::getTournament($idT);
        $participants = Tournament::getUserForMatch($idM);
        $fight = Tournament::getFightById($idM);
        $winsType = Wins::getTypeWins();
        if (isset($_POST['submit'])){
            $errors = false;
            if (isset($_POST['winner'])){
                $winner  = $_POST['winner'];
            }
            else{
                $winner = "";
                $errors[] = "Выберите победителя";
            }
            $win = $_POST['type'];
            $score1 = $_POST['score1'];
            $score2 = $_POST['score2'];
            if (!Tournament::checkCorrectFighters($idM,$participants['fighter_1'][0],$participants['fighter_2'][0])){
                $errors[] = "Несовпадение участников";
            }
            if (!Match::checkScore($score1,$score2)){
                $errors[] = "Введите корректные числа в поля очки";
            }
            if (!Match::checkWinner($winner,$participants['fighter_1'][0],$participants['fighter_2'][0])){
                $errors[] = "Выберите сущетсвующего победителя";
            }
            if (!Match::checkRoots($fight)){
                $errors[] = "Матч уже прошел";
            }
            if ($errors == false){
                if (Match::checkRoots($fight)){
                    Match::edit($fight,$winner,$win,$participants['fighter_1'][0],$participants['fighter_2'][0],$score1,$score2);
                }
            }
        }

        include_once 'views/adminMatch.php';
        return true;
    }
    public function actionTournamentsEdit($id){
        $this->checkRoots();
        $tournament = Tournament::getTournament($id);

        $result = false;

        if (isset($_POST['submit'])){
            $name = trim($_POST['name']);

            $errors = false;

            if (!Tournament::checkName($name)){
                $errors[] = "Имя турнира не должно быть короче одного символа";
            }

            if ($errors == false){
                $result = Tournament::editTournament($id,$name);
            }

        }

        include_once 'views/adminTournamentsEdit.php';
        return true;
    }

    public function actionTournamentsDelete($id){
        $this->checkRoots();
        Tournament::issetTournament($id);
        $tournament = Tournament::getTournament($id);
        $result = false;

        if (isset($_POST['submit'])){
            $errors = false;

            if (!Tournament::checkIssetToss($id)){
                $errors[] = "Вы не можете удалить этот турнир,так как в нём уже была проведена жеребьевка";
            }

            if ($errors==NULL){
                $result = Tournament::deleteTournament($tournament);
            }
        }

        include_once 'views/adminTournamentsDelete.php';
        return true;
    }








    public function actionUsers(){
        $this->checkRoots();
        $users = USER::getAllUsersNoNull();
        include_once 'views/adminUsers.php';
        return true;
    }

    public function actionUsersAdd(){
        $this->checkRoots();

        $scripts = ['change'];
        $this->title = "Регистрация спортсмена";
        $name = "";
        $surname = "";
        $patronymic = "";
        $email = "";
        $password = "";
        $sex = "";
        $weight = "";
        $country = "";
        $city = "";
        $clubs = Club::getClubs();
        $getSex = Sex::getSex();
        $result = false;


        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $patronymic = $_POST['patronymic'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sex = $_POST['sex'];
            $data = $_POST['data'];
            $weight = $_POST['weight'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $club_name_1 = $_POST['club_name_1'];
            if (isset($_POST['club_name_2'])) {
                $club_name_2 = $_POST['club_name_2'];
            } else {
                $club_name_2 = null;
            }

            $errors = false;


            if (!USER::checkName($name)) {
                $errors[] = "Имя не должно быть короче 1 символа";
            }

            if (!USER::checkEmail($email)) {
                $errors[] = "E-mail должен содержать @ и .";
            }

            if (!USER::checkPassword($password)) {
                $errors[] = "Пароль не должен быть короче 6 символов";
            }

            if (USER::checkRepeatEmail($email)){
                $errors[] = "Такой мэйл уже зарегистрирован";
            }

            if (!USER::checkSurname($surname)) {
                $errors[] = "Фамилия не должно быть короче 1 символа";
            }

            if (!USER::checkOtchestvo($patronymic)) {
                $errors[] = "Отчество не должно быть короче 1 символа";
            }

            if (!USER::checkSex($sex)) {
                $errors[] = "Выберите пол";
            }

            if (!USER::checkWeight($weight)) {
                $errors[] = "Введи корректный вес";
            }

            if (!USER::checkData($data)) {
                $errors[] = "Чтобы зарегистрироваться как спортсмен вам должно быть от 7 до 13 лет";
            }

            if (!USER::checkCountry($country)) {
                $errors[] = "Введите корректное название страны";
            }

            if (!USER::checkCity($city)) {
                $errors[] = "Введите корректное название города";
            }

            if (!USER::checkClub($club_name_1, $club_name_2)) {
                $errors[] = "Выберите существующий клуб или введите корректный новый";
            }

            if ($errors == false) {
                if (!USER::checkRepeatEmail($email)){
                    $result = USER::adminRegister( $name, $surname, $patronymic, $email, $password, $sex, $data, $weight, $country, $city, $club_name_1, $club_name_2);
                }

            }
        }
        include_once 'views/adminUsersAdd.php';
        return true;
    }

    public function actionUsersView($id){
        $this->checkRoots();
        $this->title = "Просмотр спортсмена";
        $user = USER::getUser($id);
        include_once 'views/adminUsersView.php';
        return  true;
    }

    public function actionUsersEdit($id){
        $scripts = ['change'];
        $this->title = "Изменение данных спортсмена";
        $user = USER::getUser($id);

        $clubs = Club::getClubs();
        $getSex = Sex::getSex();
        $result = false;


        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $patronymic = $_POST['patronymic'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sex = $_POST['sex'];
            $data = $_POST['data'];
            $weight = $_POST['weight'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $club_name_1= $_POST['club_name_1'];
            if (isset($_POST['club_name_2'])){
                $club_name_2 = $_POST['club_name_2'];
            }
            else{
                $club_name_2 = null;
            }
            $errors = false;
            if (!USER::checkName($name)){
                $errors[] = "Имя не должно быть короче 1 символа";
            }

            if (!USER::checkEmail($email)){
                $errors[] = "E-mail должен содержать @ и .";
            }

            if (!USER::checkPassword($password)){
                $errors[] = "Пароль не должен быть короче 6 символов";
            }

            if (USER::checkHisEmail($email,$id)){
                $errors[] = "Такой E-mail уже существует";
            }

            if (!USER::checkSurname($surname)){
                $errors[] = "Фамилия не должно быть короче 1 символа";
            }

            if (!USER::checkOtchestvo($patronymic)){
                $errors[] = "Отчество не должно быть короче 1 символа";
            }

            if (!USER::checkSex($sex)){
                $errors[] = "Выберите пол";
            }

            if (!USER::checkWeight($weight)){
                $errors[] = "Введи корректный вес";
            }

            if (!USER::checkData($data)){
                $errors[] = "Чтобы зарегистрироваться как спортсмен вам должно быть от 7 до 13 лет";
            }

            if (!USER::checkCountry($country)){
                $errors[] = "Введите корректное название страны";
            }

            if (!USER::checkCity($city)){
                $errors[] = "Введите корректное название города";
            }

            if (!USER::checkClub($club_name_1,$club_name_2)){
                $errors[] = "Выберите существующий клуб или введите корректный новый";
            }

            if ($errors==false){
                $result = USER::edit($id,$name,$surname,$patronymic,$email,$password,$sex,$data,$weight,$country,$city,$club_name_1,$club_name_2);
            }

        }
        include_once 'views/adminUsersEdit.php';
        return true;
    }


}