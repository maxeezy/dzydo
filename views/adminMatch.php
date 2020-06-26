<?php
include_once "admin_header.php";
?>

<div class="match">
    <div class="container">
        <div class="match-content">
            <div class="match-title">Матч стадии <?php echo $fight->stage ?>,
                турнира <?php echo $tournament->name ?></div>
            <div class="match-wrap">
                <div class="match-player" style="text-align: left">
                    <?php if ($participants['fighter_1']==NULL):?>
                        <div class="match-player-fio"><?php echo "Пока неизвестно" ?></div>
                        <div class="match-player-country-sity"><?php  echo "Пока неизвестно" ?></div>
                        <div class="match-player-weight"><?php  echo "Пока неизвестно" ?>кг</div>
                    <?php else:?>
                    <div class="match-player-fio"><?php echo $participants['fighter_1'][0]['surname'] . " " . $participants['fighter_1'][0]['name'] ?></div>
                    <div class="match-player-country-sity"><?php echo $participants['fighter_1'][0]['country'] . ", " . $participants['fighter_1'][0]['city'] ?></div>
                    <div class="match-player-weight"><?php echo $participants['fighter_1'][0]['weight'] ?>кг</div>
                    <?php endif; ?>
                </div>
                <div class="match-info">
                    <?php if ($fight->winner == NULL): ?>
                        <div class="match-no-time">Бой еще не состоялся</div>
                    <?php else: ?>
                        <div class="match-score"><?php echo $fight->score_fighter_1 ?>: <?php echo $fight->score_fighter_2 ?></div>
                        <div class="match-type_win"><?php echo $fight->win ?></div>
                    <?php endif; ?>
                    <div class="match-category"><?php echo $tournament->category ?> лет</div>
                    <div class="match-weight"><?php echo $tournament->weight ?>кг</div>
                </div>
                <div class="match-player" style="text-align: right">
                    <?php if ($participants['fighter_2']==NULL):?>
                        <div class="match-player-fio"><?php echo "Пока неизвестно" ?></div>
                        <div class="match-player-country-sity"><?php  echo "Пока неизвестно" ?></div>
                        <div class="match-player-weight"><?php  echo "Пока неизвестно" ?>кг</div>
                    <?php else:?>
                    <div class="match-player-fio"><?php echo $participants['fighter_2'][0]['surname'] . " " . $participants['fighter_2'][0]['name'] ?></div>
                    <div class="match-player-country-sity"><?php echo $participants['fighter_2'][0]['country'] . ", " . $participants['fighter_2'][0]['city'] ?></div>
                    <div class="match-player-weight"><?php echo $participants['fighter_2'][0]['weight'] ?>кг</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="match-edit">
                <div class="match-edit-title">Изменение результата</div>
                <?php if ($tournament->toss!="DONE"):?>
                <div class="match-edit-no">Изменение результата матча недоступно, жеребьвька не будет закончена</div>
                <?php else:?>
                <div class="match-edit-field">
                    <form action="" class="match-edit-form" method="post">
                        <div class="match-edit-form-groupt">
                            <div class="match-edit-who">Победитель</div>
                            <?php if ($participants['fighter_2']==NULL):?>
                                <input type="radio" name="winner" value="<?php echo "Неизвестно"?>" id="f1">
                                <label for="f1"><?php  echo "Неизвестно"?></label>
                                <input type="radio" name="winner" value="<?php  echo "Неизвестно"?>" id="f2">
                                <label for="f2"><?php  echo "Неизвестно" ?></label>
                            <?php else:?>
                            <input type="radio" name="winner" value="<?php  echo "Неизвестно"?>" id="f1">
                            <label for="f1"><?php  echo "Неизвестно"?></label>
                            <input type="radio" name="winner" value="<?php  echo "Неизвестно"?>" id="f2">
                            <label for="f2"><?php  echo "Неизвестно"?></label>
                            <?php endif;?>
                        </div>
                        <select class="match-win-type" name="type">
                            <?php foreach ($winsType as  $win):?>
                                <?php if ($fight->type_win_id == $win['name']):?>
                                    <option value="<?php echo $win['id']; ?>" selected="selected"><?php echo $win['name']; ?></option>
                                <?php else:?>
                                    <option value="<?php echo $win['id']; ?>"><?php echo $win['name']; ?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <div class="match-edit-form-groupt">
                            <?php if ($participants['fighter_1']==NULL):?>
                                <label for="score1">Очки <?php echo "Неизвестно"?></label>
                                <input type="text" id="score1" name="score1" class="match-input-score">
                                <label for="score2">Очки <?php echo "Неизвестно" ?></label>
                                <input type="text" id="score2" name="score2" class="match-input-score">
                            <?php else:?>
                            <label for="score1">Очки <?php echo "Неизвестно" ?></label>
                            <input type="text" id="score1" name="score1" class="match-input-score">
                            <label for="score2">Очки <?php echo "Неизвестно"?></label>
                            <input type="text" id="score2" name="score2" class="match-input-score">
                            <?php endif;?>
                        </div>
                        <input type="submit" value="Изменить" name="submit" class="edit-match-butt">
                    </form>
                </div>
                <?php endif;?>
                <?php if (isset($errors) && (is_array($errors))): ?>
                    <div class="register-error-field">
                        <?php foreach ($errors as $error): ?>
                            <div class="register-error"><?php echo $error; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
include_once "footer.php";
?>
