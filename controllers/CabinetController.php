<?php

include_once ROOT.'/models/USER.php';
include_once ROOT.'/models/Club.php';
include_once ROOT . '/models/Sex.php';
include_once ROOT . '/models/Tournament.php';
include_once ROOT . '/models/Request.php';

class CabinetController
{
    private $title;
    public function actionIndex(){

        $this->title = "Личный кабинет";
        $id = USER::isLogged();
        if (!$id){
            header("Location: /user/login");
        }
        $user = USER::getUser($id);
        $userView = USER::getUserView($id);
        $tournaments = Tournament::getTournamentsByIdUser($id);
        $request = Request::getRequestsByIdUser($id);
        include_once("views/cabinet.php");
        return true;
    }

    public function actionEdit(){
        $scripts = ['change'];
        $this->title = "Личный кабинет || Изменение данных профиля";
        $id = USER::isLogged();
        if (!$id){
            header("Location: /user/login");
        }
        $user = USER::getUser($id);
        $userView = USER::getUserView($id);
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

//        $surname = $user->surname;
//        $patronymic = $user->patronymic;
//        $email = $user->email;
//        $data_of_birth = $user->data_of_birth;
//        $sex = $user->sex;
//        $weight = $user->weight;
//        $country = $user->country;
//        $city = $user->city;
//        $club_name = $user->club_name;



        require_once ("views/edit.php");
        return true;
    }
}