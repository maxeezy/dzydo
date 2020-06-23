<?php
include_once('header.php');
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
        </div>
    </div>
</div>

<?php
include_once('footer.php');
?>
