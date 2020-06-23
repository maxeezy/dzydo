<?php


class USER
{

    public static function register($name, $email, $password)
    {
        $db = new DB();
        $sql = "INSERT INTO `user`(`id`, `name`, `surname`, `patronymic`, `email`,`country`,`city`, `data_of_birth`, `sex_id`, `weight`, `club_id`, `role`, `password`) VALUES (NULL,:name,NULL,NULL,:email,NULL,NULL,NULL,0,NULL,1,:role,:password)";
        if ($db->add($sql, [':name' => $name, ':email' => $email, ':password' => $password, ':role' => "user"])) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkName($name)
    {
        if ((strlen($name) > 0) && (is_string($name)&&($name!="Не указано"))) {
            return true;
        } else {
            return false;
        }
    }


    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkPassword($password)
    {
        if ((strlen($password) >= 6) && (is_string($password))) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkRepeatEmail($email)
    {
        $db = new DB();
        if ($db->queryObj("SELECT email FROM user WHERE email = :email", [':email' => $email])) {
            return true;
        } else {
            return false;
        }

    }

    public static function checkHisEmail($email,$id){
           if (self::checkRepeatEmail($email)){
               $db = new DB();
               $user = $db ->queryObj("SELECT email FROM user WHERE  id = :id",[':id'=>$id]);
               if ($user->email == $email){
                   return false;
               }
               else return true;
           }
           else{
               return false;
           }

    }

    public static function checkUserExist($email, $password)
    {
        $db = new DB();
        if ($db->queryObj("SELECT * FROM user  where  email = :email ", [':email' => $email])) {
            $user = $db->queryObj("SELECT * FROM user  where  email = :email ", [':email' => $email]);
            if ($password == $user->password) {
                return $user->id;
            } else return false;
        } else {
            return false;
        }
    }

    public static function checkSurname($surname)
    {
        if ((strlen($surname) > 0) && (is_string($surname))&&($surname!="Не указано")) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkOtchestvo($otchestvo)
    {
        if ((strlen($otchestvo) > 0) && (is_string($otchestvo))&&($otchestvo!="Не указано")) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkSex($sex)
    {
        $true = [1, 2];
        if ($sex == $true[0] || $sex == $true[1]) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkData($data)
    {
        $parse = date_parse($data);
        $now = date('Y-m-d ');
        $dataBirht = new DateTime($data);
        $current = new DateTime($now);
        $dif = $dataBirht->diff($current)->format('%R%a');
        $dif = (int)$dif;
        if (checkdate($parse['month'], $parse['day'], $parse['year']) && $dif >= 2557 && $dif < 5114) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkWeight($weight)
    {
        if ((int)$weight > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkCountry($country)
    {
        if ((strlen($country) > 0) && (is_string($country)&&($country!="Не указано"))) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkCity($city)
    {
        if ((strlen($city) > 0) && (is_string($city)&&($city!="Не указано"))) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkClub($club_1, $club_2 = null)
    {
        if ($club_2 == null) {
            $clubs = Club::getClubs();
            foreach ($clubs as $club) {
                if ($club['id'] == $club_1) {
                    echo $club['id'];
                    return true;
                    break;
                }


            }
            return false;
        }
        else {
            if ((strlen($club_2) > 0) && (is_string($club_2))) {
                return true;
            } else {
                return false;
            }
        }
    }


    public static function auth($userid)
    {
        $_SESSION['logged_user'] = $userid;
    }

    public static function isGuest()
    {
        if (!isset($_SESSION['logged_user'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function isLogged()
    {
        if (isset($_SESSION['logged_user'])) {
            return $_SESSION['logged_user'];
        } else {
            return false;
        }
    }

    public static function checkRoots(){
        $userId = USER::isLogged();
        $user = USER::getUser($userId);
        if ($user->role == "admin") {
            return true;
        }
        else{
            return false;
        }
    }

    public static function getUser($id)
    {
        if ($id) {
            $db = new DB();
            $sql = "SELECT user.id,user.name,user.password, user.surname,user.patronymic,user.country,user.city,user.email,user.data_of_birth,user.role,sex.name as 'sex_name',user.weight,club.name as 'club_name' FROM user INNER JOIN club INNER JOIN sex ON user.club_id = club.id AND user.sex_id = sex.id WHERE user.id = :id";
            return $db->queryObj($sql, [':id' => $id]);
        }
    }

    public static function getUserView($id)
    {
        if ($id) {
            $db = new DB();
            $sql = "SELECT user.name,user.password, user.surname,user.patronymic,user.country,user.city,user.email,user.data_of_birth,sex.name as 'sex_name',user.weight,club.name as 'club_name' FROM user INNER JOIN club INNER JOIN sex ON user.club_id = club.id AND user.sex_id = sex.id WHERE user.id = :id";
            $user = $db->queryObj($sql, [':id' => $id]);
            $vars = get_object_vars($user);
            foreach ($vars as $key => $value) {
                if ($user->$key == NULL) {
                    $user->$key = "Не указано";
                }
            }
            return $user;
        }
    }

    public static function getAllUsersNoNull(){
        $sql = "SELECT user.id,user.name,user.password, user.surname,user.patronymic,user.country,user.city,user.email,user.data_of_birth,sex.name as 'sex',user.weight,club.name as 'club' FROM user INNER JOIN club INNER JOIN sex ON user.club_id = club.id AND user.sex_id = sex.id WHERE user.surname IS NOT NULL AND user.patronymic IS NOT NULL AND user.country IS NOT NULL AND user.city IS NOT NULL AND user.email IS NOT NULL AND user.data_of_birth IS NOT NULL AND user.weight IS NOT NULL AND sex.name IS NOT NULL AND club.name IS NOT NULL";
        $db = new DB();
        return $db->queryAssocNoP($sql);
    }



    public static function edit($id,$name,$surname,$patronymic,$email,$password,$sex,$data,$weight,$country,$city,$club_name_1,$club_name_2){
        $db = new DB();
        if ($club_name_2 == null){
            $sql = "UPDATE `user` SET `name`= :name,`surname` = :surname,`patronymic` = :patronymic,`country` = :country,`city` = :city,`email` = :email,`data_of_birth` = :data,`sex_id` = :sex,`weight` = :weight,`club_id` = :club_name_1,`password`= :password WHERE id = :id";
            return $db->add($sql,[':name'=>$name,':surname'=>$surname,':patronymic'=>$patronymic,':country'=>$country,':city'=>$city,':email'=>$email,':data'=>$data,':sex'=>$sex,':weight'=>$weight,':club_name_1'=>$club_name_1,':password'=>$password,':id'=>$id]);

        }
        else{
            $db->add("INSERT INTO `club`(`id`, `name`) VALUES (NULL ,:name)",[':name'=>$club_name_2]);
            $sql = "UPDATE `user` SET `name`= :name,`surname` = :surname,`patronymic` = :patronymic,`country` = :country,`city` = :city,`email` = :email,`data_of_birth` = :data,`sex_id` = :sex,`weight` = :weight,`club_id` = :club_name_2,`password`= :password WHERE id = :id";
            return $db->add($sql,[':name'=>$name,':surname'=>$surname,':patronymic'=>$patronymic,':country'=>$country,':city'=>$city,':email'=>$email,':data'=>$data,':sex'=>$sex,':weight'=>$weight,':club_name_2'=>$db->lastInsertId(),':password'=>$password,':id'=>$id]);
        }
    }

    public static function adminRegister($name,$surname,$patronymic,$email,$password,$sex,$data,$weight,$country,$city,$club_name_1,$club_name_2){
        $db = new DB();
        if ($club_name_2 == null){
            $sql = "INSERT INTO `user`(`id`, `name`, `surname`, `patronymic`, `country`, `city`, `email`, `data_of_birth`, `sex_id`, `weight`, `club_id`, `role`, `password`) VALUES (NULL ,:name,:surname,:patronymic,:country,:city,:email,:data,:sex,:weight,:club_name_1,:role,:password)";
            return $db->add($sql,[':name'=>$name,':surname'=>$surname,':patronymic'=>$patronymic,':country'=>$country,':city'=>$city,':email'=>$email,':data'=>$data,':sex'=>$sex,':weight'=>$weight,':club_name_1'=>$club_name_1,':password'=>$password,':role'=>"user"]);

        }
        else{
            $db->add("INSERT INTO `club`(`id`, `name`) VALUES (NULL ,:name)",[':name'=>$club_name_2]);
            $club = $db->lastInsertId();
            $sql = "INSERT INTO `user`(`id`, `name`, `surname`, `patronymic`, `country`, `city`, `email`, `data_of_birth`, `sex_id`, `weight`, `club_id`, `role`, `password`) VALUES (NULL ,:name,:surname,:patronymic,:country,:city,:email,:data,:sex,:weight,:club_name_2,:role,:password)";
            return $db->add($sql,[':name'=>$name,':surname'=>$surname,':patronymic'=>$patronymic,':country'=>$country,':city'=>$city,':email'=>$email,':data'=>$data,':sex'=>$sex,':weight'=>$weight,':club_name_2'=>$club,':password'=>$password,':role'=>"user"]);
        }
    }

    public static function getUsersForInvite($id){
        $db = new DB();
        $tournamet = Tournament::getTournament($id);
        $users = $db->queryAssocNoP("SELECT user.id,user.name,user.password, user.surname,user.patronymic,user.country,user.city,user.email,user.data_of_birth,sex.name as 'sex_name',user.weight,club.name as 'club_name' FROM user INNER JOIN club INNER JOIN sex ON user.club_id = club.id AND user.sex_id = sex.id ");
        $datTourn = new  DateTime($tournamet->data);
        $now = date('Y-m-d ');
        $current = new  DateTime($now);
        $dif1= $current->diff($datTourn)->format('%R%a');
        $dif1 = (int) $dif1;
        foreach ($users as $key => $value){
            $dataUser = new  DateTime($value['data_of_birth']);
            $dif = $dataUser->diff($current)->format('%R%a');
            $dif = (int)$dif;
            $total = round(($dif + $dif1)/365,0,PHP_ROUND_HALF_DOWN) ;
            if (($total!=$tournamet->category)||($value['sex_name']!=$tournamet->sex)||($db->queryObj("SELECT * FROM tournament_participant where tournament_id = :id1 and user_id = :id2",[':id1'=>$tournamet->id,':id2'=>$value['id']]))){
                unset($users[$key]);
            }
        }
        return $users;
    }


}