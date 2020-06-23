<?php

include_once ROOT.'/models/USER.php';
class UserController
{
    private $title;
    public function actionRegister(){
        if (!USER::isGuest()){
            header("Location: /cabinet");
        }
        $this->title = "Регистрация";
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        if (isset($_POST['submit'])){
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $errors = false;

            if (!USER::checkName($name)){
                $errors[] = "Имя должно содержать только буквы и не быть короче 1 символа";
            }

            if (!USER::checkEmail($email)){
                $errors[] = "E-mail должен содержать @ и .";
            }

            if (!USER::checkPassword($password)){
                $errors[] = "Пароль не должен быть короче 6 символов";
            }

            if (USER::checkRepeatEmail($email)){
                $errors[] = "Такой E-mail уже существует";
            }

            if ($errors == false){
                $result = USER::register($name,$email,$password);
            }

        }

        include_once ('views/register.php');
        return true;
    }

    public function actionLogin(){
        if (!USER::isGuest()){
            header("Location: /cabinet");
        }
        $this->title = "Вход";
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $errors = false;

            if (!USER::checkEmail($email)){
                $errors[] = "E-mail должен содержать @ и .";
            }

            if (!USER::checkPassword($password)){
                $errors[] = "Пароль не должен быть короче 6 символов";
            }

            if ($errors == false){
                $userid = USER::checkUserExist($email,$password);
                if ($userid==false){
                    $errors[] = "Неправильные данные для входа на сайт";
                }
                else{
                    USER::auth($userid);
                    if (USER::checkRoots()){
                        header("Location: /admin");
                    }
                    else{
                        header("Location: /cabinet");
                    }

                }
            }

        }
        include_once ('views/login.php');
        return true;
    }

    public function actionLogout(){
        unset($_SESSION['logged_user']);
        header("Location: /");
    }
}