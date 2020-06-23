<?php


class Club
{
    public static function getClubs(){
        $db = new DB();
        return $db->queryAssocNoP("SELECT * FROM club");
    }
}