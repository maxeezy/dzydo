<?php


class Wins
{
    public static function getTypeWins(){
        $db = new DB();
        return $db->queryAssocNoP("SELECT * FROM win");
    }

}