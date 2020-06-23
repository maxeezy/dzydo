<?php


class Request
{
    public static function getRequestsByIdUser($id){
        $db = new DB();
        return $db->queryAssoc("SELECT  tournament.id, tournament.name ,category.name AS 'category_name',tournament.weight ,tournament.data,sex.name as 'sex' FROM user INNER JOIN sex INNER JOIN tournament  INNER JOIN request INNER JOIN category ON user.sex_id = sex.id AND  user.id = request.user_id AND tournament.id = request.tournament_id AND tournament.category_id = category.id WHERE  user.id = :id",[':id'=>$id]);
    }

    public static function getRequestsByIdTournament($id){
        $db = new DB();
        return $db->queryAssoc("SELECT user.id,user.name,user.surname,user.patronymic,user.data_of_birth,user.country,user.city,user.email,user.weight,sex.name as 'sex',club.name as 'club',request.id as 'request' FROM user INNER JOIN sex INNER JOIN club INNER JOIN tournament  INNER JOIN request ON user.sex_id = sex.id AND user.club_id = club.id AND  user.id = request.user_id AND tournament.id = request.tournament_id WHERE  tournament.id = :id",[':id'=>$id]);
    }
}