<?php


class Match
{

    public static function edit($fight,$winner,$type,$f1,$f2,$score1,$score2){
        $db = new DB();
        if ($fight->stage == "1/2"){
            $db->add("UPDATE `fights` SET `winner`= :winner,`type_win_id`= :type ,`score_fighter_1`= :score_1,`score_fighter_2` = :score_2  WHERE id = :id",[':winner'=>$winner,':type'=>$type,':score_1'=>$score1,':score_2'=>$score2,':id'=>$fight->id]);
            $looser = "";
            if ($f1['id']!=$winner){
                $looser = $f1['id'];
            }
            else{
                $looser = $f2['id'];
            }

            $third = $db->queryObj("SELECT * from fights where stage_id = 4 AND tournament_id = :id",[':id'=>$fight->tournament_id]);
            $final = $db->queryObj("SELECT * from fights where id = :id",[':id'=>$fight->fight_after_id]);

            $db->add("UPDATE `tournament_participant` SET `result_id` = :result WHERE tournament_id = :idT AND user_id = :idU",[':result'=>5,':idT'=>$fight->tournament_id,':idU'=>$looser]);
            $db->add("UPDATE `tournament_participant` SET `result_id` = :result WHERE tournament_id = :idT AND user_id = :idU",[':result'=>6,':idT'=>$fight->tournament_id,':idU'=>$winner]);

            if ($final->fighter_1_id==NULL){
                $db->add("UPDATE `fights` SET `fighter_1_id` = :idF WHERE id = :id",[':id'=>$final->id,':idF'=>$winner]);
            }
            else{
                $db->add("UPDATE `fights` SET `fighter_2_id` = :idF WHERE id = :id",[':id'=>$final->id,':idF'=>$winner]);
            }

            if ($third->fighter_1_id==NULL){
                $db->add("UPDATE `fights` SET `fighter_1_id` = :idF WHERE id = :id",[':id'=>$third->id,':idF'=>$looser]);
            }
            else{
                $db->add("UPDATE `fights` SET `fighter_2_id` = :idF WHERE id = :id",[':id'=>$third->id,':idF'=>$looser]);
            }

        }
        if ($fight->stage == "low-final"){
            $db->add("UPDATE `fights` SET `winner`= :winner,`type_win_id`= :type ,`score_fighter_1`= :score_1,`score_fighter_2` = :score_2  WHERE id = :id",[':winner'=>$winner,':type'=>$type,':score_1'=>$score1,':score_2'=>$score2,':id'=>$fight->id]);
            $db->add("UPDATE `tournament` SET `bronze` = :idU WHERE id = :id",[':id'=>$fight->tournament_id,':idU'=>$winner]);

        }
        if ($fight->stage == "final"){
            $looser = "";
            if ($f1['id']!=$winner){
                $looser = $f1['id'];
            }
            else{
                $looser = $f2['id'];
            }
            $db->add("UPDATE `fights` SET `winner`= :winner,`type_win_id`= :type ,`score_fighter_1`= :score_1,`score_fighter_2` = :score_2  WHERE id = :id",[':winner'=>$winner,':type'=>$type,':score_1'=>$score1,':score_2'=>$score2,':id'=>$fight->id]);
            $db->add("UPDATE `tournament` SET `silver` = :idU WHERE id = :id",[':id'=>$fight->tournament_id,':idU'=>$looser]);
            $db->add("UPDATE `tournament` SET `gold` = :idU WHERE id = :id",[':id'=>$fight->tournament_id,':idU'=>$winner]);
        }
        else{
            $looser = "";
            if ($f1['id']!=$winner){
                $looser = $f1['id'];
            }
            else{
                $looser = $f2['id'];
            }
            $db->add("UPDATE `fights` SET `winner`= :winner,`type_win_id`= :type ,`score_fighter_1`= :score_1,`score_fighter_2` = :score_2  WHERE id = :id",[':winner'=>$winner,':type'=>$type,':score_1'=>$score1,':score_2'=>$score2,':id'=>$fight->id]);
            $db->add("UPDATE `tournament_participant` SET `result_id` = :result WHERE tournament_id = :idT AND user_id = :idU",[':result'=>(int)$fight->stage+2,':idT'=>$fight->tournament_id,':idU'=>$looser]);
            $db->add("UPDATE `tournament_participant` SET `result_id` = :result WHERE tournament_id = :idT AND user_id = :idU",[':result'=>(int)$fight->stage+1,':idT'=>$fight->tournament_id,':idU'=>$winner]);

            $next = $db->queryObj("SELECT * from fights where id = :id",[':id'=>(int)$fight->id+1]);
            if ($next->fighter_1_id==NULL){
                $db->add("UPDATE `fights` SET `fighter_1_id` = :idF WHERE id = :id",[':id'=>$next->id,':idF'=>$winner]);
            }
            else{
                $db->add("UPDATE `fights` SET `fighter_2_id` = :idF WHERE id = :id",[':id'=>$next->id,':idF'=>$winner]);
            }
        }
         header("Location: /admin/tournaments/$fight->tournament_id/matches/edit/$fight->id");
    }

    public static function checkScore($score1,$score2){
        if ((int)$score1>=0&&(int)$score2>=0){
            return true;
        }
        else{
            return false;
        }
    }
    public static function checkWinner($winner,$f1,$f2){
        if ($f1['id']!=$winner&&$f2['id']!=$winner){
            return false;
        }
        else{
            return true;
        }
    }
    public static function checkRoots($fight){
        if (!$fight->winner==NULL){
            return false;
        }
        else{
            return true;
        }
    }
}