<?php


class Sex
{
    public static function getSex(){
        $db = new DB();
        return $db->queryAssocNoP("SELECT * FROM sex");
    }

    public static function getSexTrue(){
        $db = new DB();
        return $db->queryAssoc("SELECT * FROM sex where id = :id1 OR id = :id2",[':id1'=>1,':id2'=>2]);
    }

    public static function checkSex($sex){
        $sex2 = Sex::getSex();
        foreach ($sex2 as $value){
            if ($value['id']==$sex){
                return true;
                break;
            }
        }
        return false;
    }
}