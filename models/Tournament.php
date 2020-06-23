<?php


use http\Header;

class Tournament
{
    public static function checkName($name)
    {
        if ((strlen($name) > 0) && (is_string($name))) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkWeight($weight)
    {
        $weight2 = explode('-', $weight);
        if (isset($weight2[1])) {
            if ((((int)$weight2[0] > 0) && ((int)$weight2[1] > 0)) && ((int)$weight2[1] - (int)$weight2[0]) <= 3) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public static function checkData($data)
    {
        $parse = date_parse($data);
        $now = date('Y-m-d ');
        $dataTournament = new DateTime($data);
        $current = new DateTime($now);
        $dif = $dataTournament->diff($current)->format('%R%a');
        $dif = (int)$dif;
        if (checkdate($parse['month'], $parse['day'], $parse['year']) && $dif < 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkUserForTournament($tournId, $userId)
    {
        $db = new DB();
        $user = USER::getUser($userId);
        $tour = Tournament::getTournament($tournId);
        $weight = explode('-', $tour->weight);
        $datTourn = new  DateTime($tour->data);
        $now = date('Y-m-d ');
        $current = new  DateTime($now);
        $dif1 = $current->diff($datTourn)->format('%R%a');
        $dif1 = (int)$dif1;
        $dataUser = new  DateTime($user->data_of_birth);
        $dif = $dataUser->diff($current)->format('%R%a');
        $dif = (int)$dif;
        $total = round(($dif + $dif1) / 365, 0, PHP_ROUND_HALF_DOWN);
        if (($total != $tour->category) || ($user->sex_name != $tour->sex) || ($db->queryObj("SELECT * FROM tournament_participant where tournament_id = :id1 and user_id = :id2", [':id1' => $tour->id, ':id2' => $user->id])) || ($user->weight < (int)$weight[0]) || ($user->weight > (int)$weight[1])) {
            return false;
        } else {
            return true;
        }
    }

    public static function addUserToTournament($tournId, $userId)
    {
        $db = new DB();
        if ($db->queryObj("SELECT * FROM request where tournament_id = :idT and user_id = :idU", [':idT' => $tournId, ':idU' => $userId])) {
            $db->add("DELETE FROM request where tournament_id = :idT and user_id = :idU", [':idT' => $tournId, ':idU' => $userId]);
        }
        return $db->add("INSERT INTO `tournament_participant`(`tournament_id`, `user_id`, `result_id`) VALUES (:idT,:idU,1)", [':idT' => $tournId, ':idU' => $userId]);
    }

    public static function newTournament($name, $weight, $data, $sex, $category)
    {
        $db = new DB();
        $sql = "INSERT INTO `tournament`(`id`, `name`, `sex_id`, `category_id`, `weight`, `data`, `gold`, `silver`, `bronze`) VALUES (NULL ,:name,:sex_id,:category_id,:weight,:data,NULL ,NULL ,NULL)";
        return $db->add($sql, [':name' => $name, ':sex_id' => $sex, ':category_id' => $category, ':weight' => $weight, ':data' => $data]);
    }

    public static function editTournament($id, $name)
    {
        $db = new DB();
        return $db->add("UPDATE `tournament` SET `name`= :name where id = :id", [':name' => $name, ':id' => $id]);
    }

    public static function deleteTournament($t)
    {
        $db = new DB();
        if ($t->toss == "DONE") {
            return false;
        } else {
            $db->add("DELETE FROM `request` WHERE tournament_id = :id", [':id' => $t->id]);
            $db->add("DELETE FROM `tournament_participant` WHERE tournament_id = :id", [':id' => $t->id]);
            return $db->add("DELETE FROM `tournament` WHERE id = :id", [':id' => $t->id]);
        }
    }

    public static function getAllTournametsInfo()
    {
        $db = new DB();
        $sql = "SELECT tournament.id,tournament.name,tournament.weight,tournament.data,tournament.gold,tournament.silver,tournament.bronze,sex.name as 'sex',category.name AS 'category' FROM tournament INNER JOIN sex INNER JOIN category ON tournament.sex_id = sex.id AND category.id = tournament.category_id";
        return $db->queryAssocNoP($sql);
    }

    public static function get10LastTournaments()
    {
        $db = new DB();
        $sql = "SELECT tournament.id,tournament.name,tournament.weight,tournament.toss,tournament.data,tournament.gold,tournament.silver,tournament.bronze,sex.name as 'sex',category.name AS 'category' FROM tournament INNER JOIN sex INNER JOIN category ON tournament.sex_id = sex.id AND category.id = tournament.category_id LIMIT 10";
        return $db->queryAssocNoP($sql);
    }

    public static function getTournament($id)
    {
        $db = new DB();
        $sql = "SELECT tournament.id,tournament.name,tournament.weight,tournament.data,tournament.toss,tournament.gold,tournament.silver,tournament.bronze,sex.name as 'sex',category.name AS 'category' FROM tournament INNER JOIN sex INNER JOIN category ON tournament.sex_id = sex.id AND category.id = tournament.category_id where tournament.id = :id";
        return $db->queryObj($sql, [':id' => $id]);
    }

    public static function getTournamentsByIdUser($id)
    {
        if ($id) {
            $db = new DB();
            $sql = "SELECT tournament.id, tournament.name AS 'tournament_name',category.name AS 'category_name',tournament.weight ,tournament.data,result.name AS 'result_name',sex.name as 'sex' FROM tournament INNER JOIN category INNER JOIN tournament_participant INNER JOIN user INNER JOIN result INNER JOIN sex ON tournament.sex_id = sex.id AND user.id = tournament_participant.user_id AND tournament.id = tournament_participant.tournament_id AND category.id = tournament.category_id AND result.id = tournament_participant.result_id WHERE user.id = :user_id";
            return $db->queryAssoc($sql, [':user_id' => $id]);
        }
    }

    public static function issetTournament($id)
    {
        if (Tournament::getTournament($id)) {

        } else {
            header("Location: /admin/tournaments");
        }
    }

    public static function issetFight($id)
    {
        if (Tournament::getFightById($id)) {

        } else {
            header("Location: /admin/tournaments");
        }
    }

    public static function getUserByIdTournament($id)
    {
        $db = new DB();
        $sql = "SELECT user.id,user.name,user.surname,user.patronymic,user.data_of_birth,user.country,user.city,user.email,user.weight,sex.name as 'sex',club.name as 'club' FROM user INNER JOIN sex INNER JOIN club INNER JOIN tournament INNER JOIN tournament_participant ON user.sex_id = sex.id AND user.club_id = club.id AND user.id = tournament_participant.user_id AND tournament_participant.tournament_id = tournament.id WHERE  tournament.id = :id";
        return $db->queryAssoc($sql, [':id' => $id]);
    }

    public static function checkCountUserForToss($id)
    {
        $users = Tournament::getUserByIdTournament($id);
        if (count($users) < 2 || count($users) > 16) {
            return false;
        } else {
            return true;
        }
    }

    public static function checkRootForToss($id)
    {
        $tournament = Tournament::getTournament($id);
        if ($tournament->toss == NULL) {
            return true;
        } else {
            return false;
        }
    }

    public static function getFightsByIdTourn($id)
    {
        $db = new DB();
        return $db->queryAssoc("SELECT  fights.id,fights.tournament_id,fights.stage_id,fights.fight_after_id,fights.fighter_1_id,fights.fighter_2_id,fights.winner,fights.type_win_id,fights.tatami_name,fights.score_fighter_1,fights.score_fighter_2,stage.name as 'stage' FROM fights INNER JOIN stage ON fights.stage_id = stage.id   WHERE tournament_id = :id", [':id' => $id]);
    }

    public static function getFightById($id)
    {
        $db = new DB();
        $fight = $db->queryObj("SELECT  fights.id,fights.tournament_id,fights.stage_id,fights.fight_after_id,fights.fighter_1_id,fights.fighter_2_id,fights.winner,fights.type_win_id,fights.tatami_name,fights.score_fighter_1,fights.score_fighter_2,stage.name as 'stage',win.name as 'win' FROM fights INNER JOIN stage INNER JOIN win ON fights.stage_id = stage.id AND fights.type_win_id = win.id  WHERE fights.id = :id", [':id' => $id]);
        if ($fight == NULL) {
            $fight = $db->queryObj("SELECT fights.id,fights.tournament_id,fights.stage_id,fights.fight_after_id,fights.fighter_1_id,fights.fighter_2_id,fights.winner,fights.type_win_id,fights.tatami_name,fights.score_fighter_1,fights.score_fighter_2,stage.name as 'stage' FROM fights INNER JOIN stage ON fights.stage_id = stage.id WHERE fights.id = :id", [':id' => $id]);
        }
        return $fight;
    }

    public static function checkCorrectFighters($idM, $idF1, $idF2)
    {
        $db = new DB();
        if ($db->queryObj("SELECT * FROM fights where id = :idM AND fighter_1_id = :idF1 AND fighter_2_id = :idF2", [':idM' => $idM, ':idF1' => $idF1['id'], ':idF2' => $idF2['id']])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUserForMatch($id)
    {
        $db = new DB();
        $users = array();
        $sql1 = "SELECT user.id,user.name,user.surname,user.patronymic,user.country,user.country,user.city,user.email,user.data_of_birth,user.sex_id,user.weight,user.club_id,sex.name AS 'sex',club.name AS 'club' FROM user INNER JOIN sex INNER JOIN club INNER JOIN tournament_participant INNER JOIN tournament INNER JOIN fights ON user.id = tournament_participant.user_id AND user.sex_id = sex.id AND user.club_id = club.id AND tournament.id = tournament_participant.tournament_id WHERE fights.fighter_1_id = user.id AND fights.id = :id";
        $sql2 = "SELECT user.id,user.name,user.surname,user.patronymic,user.country,user.country,user.city,user.email,user.data_of_birth,user.sex_id,user.weight,user.club_id,sex.name AS 'sex',club.name AS 'club' FROM user INNER JOIN sex INNER JOIN club INNER JOIN tournament_participant INNER JOIN tournament INNER JOIN fights ON user.id = tournament_participant.user_id AND user.sex_id = sex.id AND user.club_id = club.id AND tournament.id = tournament_participant.tournament_id WHERE fights.fighter_2_id = user.id AND fights.id = :id";
        $users['fighter_1'] = $db->queryAssoc($sql1, [':id' => $id]);
        $users['fighter_2'] = $db->queryAssoc($sql2, [':id' => $id]);
        return $users;
    }

    public static function toss($id)
    {
        $db = new DB();
        $users = Tournament::getUserByIdTournament($id);
        $tournament = Tournament::getTournament($id);
        $stagesPath = ROOT . "/config/stages.php";
        $stages = include($stagesPath);
        $pattern = $stages[count($users)];
        $sql = "INSERT INTO `fights`(`id`, `tournament_id`, `stage_id`, `fight_after_id`, `fighter_1_id`, `fighter_2_id`, `winner`, `type_win_id`, `tatami_name`, `score_fighter_1`, `score_fighter_2`) VALUES (NULL,:idT,:stage,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
        foreach ($pattern as $key => $value) {
            for ($i = 0; $i < $value; $i++) {
                $db->add($sql, [':idT' => (int)$id, ':stage' => (int)$key]);
            }
        }

        $fights = Tournament::getFightsByIdTourn($id);

        foreach ($fights as $key => $value) {
            if (($value['stage_id'] != 5) && ($value['stage_id'] != 4)) {
                if ($value['stage_id'] == 3) {
                    $lastStage = $db->queryObj("SELECT * FROM `fights` WHERE stage_id = :id", [':id' => 5]);
                    $db->add("UPDATE `fights` SET `fight_after_id`= :id_fight WHERE id = :id", [':id' => $value['id'], ':id_fight' => $lastStage->id]);
                } else {
                    $nextStage = (int)$value['stage_id'] + 1;
                    $fightsNextStage = $db->queryAssoc("SELECT * FROM `fights` WHERE stage_id = :id", [':id' => $nextStage]);
                    foreach ($fightsNextStage as $f) {
                        $check = $db->queryAssoc("SELECT * FROM `fights` WHERE fight_after_id = :id", [':id' => $f['id']]);
                        if (count($check) < 2) {
                            $db->add("UPDATE `fights` SET `fight_after_id`= :id_fight WHERE id = :id", [':id' => $value['id'], ':id_fight' => $f['id']]);
                            break;
                        } else {
                            continue;
                        }
                    }
                }
            }
        }

        shuffle($users);

        foreach ($pattern as $key => $p) {
            shuffle($users);
            if ((int)$key != 4) {
                $currentStage = $db->queryAssoc("SELECT * FROM `fights` WHERE stage_id = :id", [':id' => $key]);
                if ($users) {
                    foreach ($currentStage as $current) {
                        $db->add("UPDATE `fights` SET `fighter_1_id` = :id_f  WHERE `tournament_id` = :id_t AND `id` = :id_m", [':id_f' => array_shift($users)['id'], 'id_t' => $id, ':id_m' => $current['id']]);
                        $db->add("UPDATE `fights` SET `fighter_2_id` = :id_f  WHERE `tournament_id` = :id_t AND `id` = :id_m", [':id_f' => array_shift($users)['id'], 'id_t' => $id, ':id_m' => $current['id']]);
                    }
                }
            }
        }

        return $db->add("UPDATE `tournament` SET `toss` = :toss  WHERE `id` = :id", [':toss' => "DONE", ':id' => $id]);
    }

    public static function getUserForView($id)
    {
        $db = new DB();
        $id = (int)$id;
        $user = $db->queryObj("SELECT name,surname FROM user where id = :id", [':id' => $id]);
        if ($user == NULL) {
            echo "";
        } else {
            echo $user->surname . " " . $user->name;
        }
    }

    public static function checkRequestForTournament($idT, $idU)
    {
        $db = new DB();
        if ($db->queryObj("SELECT * FROM request where tournament_id = :idT AND user_id = :idU", [':idT' => $idT, ':idU' => $idU])) {
            return false;
        } else {
            return true;
        }
    }

    public static function checkIssetToss($id)
    {
        $tournament = Tournament::getTournament($id);
        if ($tournament->toss == "DONE") {
            return false;
        } else {
            return true;
        }
    }

    public static function tryRequest($idT, $idU)
    {
        $db = new DB();
        return $db->add("INSERT INTO `request`(`id`, `tournament_id`, `user_id`) VALUES (NULL,:idT,:idU)", [':idT' => $idT, ':idU' => $idU]);
    }

    public static function deleteRequest($id)
    {
        $db = new DB();
        if ($db->queryObj("SELECT * FROM request where id = :id", [':id' => $id])) {
            return $db->add("DELETE FROM request where id = :id", [':id' => $id]);
        } else {
            header("Location: /admin/tournaments");
        }
    }
}