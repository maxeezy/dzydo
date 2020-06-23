<?php
require_once "header.php";
?>
<div class="viewTourn">
    <div class="container">
        <div class="viewTourn-content">
            <div class="view-tourn-wrap">
                <div class="view-tourn-x-info">
                    <div class="view-tourn-x-field">
                        <div class="view-tourn-x-name"><?php echo $tournament->name; ?></div>
                        <div class="view-tourn-x-data">Дата проведения: <?php echo $tournament->data; ?></div>
                        <div class="view-tourn-x-img"><img
                                src="https://static.ngs.ru/news/99/preview/edb57bc1429df7825558c3acf8ae97080c6974d9_824_549_c.JPG"
                                alt="" class="img-tourn"></div>
                    </div>
                    <div class="view-tourn-wrap-2">
                        <div class="view-tourn-x-field">
                            <div class="view-tourn-x-sex">Пол: <?php echo $tournament->sex; ?></div>
                            <div class="view-tourn-x-age">Возраст:<?php echo $tournament->category; ?></div>
                            <div class="view-tourn-x-weight">Весовая категория:<?php echo $tournament->weight; ?></div>
                        </div>
                        <div class="view-tourn-x-field">
                            <div class="view-tourn-x-gold">Победитель: <?php Tournament::getUserForView($tournament->gold)?></div>
                            <div class="view-tourn-x-silver">Серебро: <?php Tournament::getUserForView($tournament->silver)?></div>
                            <div class="view-tourn-x-bronze">Бронза: <?php Tournament::getUserForView($tournament->bronze)?></div>
                        </div>
                    </div>
                    <div class="view-tourn-wrap-3">
                        <?php if (!$result):?>
                        <form action="" method="post" style="margin-bottom: 20px"><input type="submit" name="submit" value="Заявиться" class="register-form-button"></form>
                        <?php if (isset($errors) && (is_array($errors))): ?>
                            <div class="register-error-field">
                                <?php foreach ($errors as $error): ?>
                                    <div class="register-error"><?php echo $error; ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php else:?>
                        <div class="request-done">Заявка на турнир успешно подана</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="view-tourn-x-users">
                    <div class="participants-title">Участники</div>
                    <?php if (!$participants): ?>
                        <div class="participants-row">Нет участников</div>
                    <?php else: ?>
                        <table class="users-view-table">
                            <?php foreach ($participants as $key => $value): ?>
                                <tr>
                                    <td class="td-1"><?php echo $key + 1; ?></td>
                                    <td class="td-2"><?php echo $value['surname'] . " "; ?><?php echo $value['name'] . " "; ?><?php echo $value['patronymic']; ?></td>
                                    <td class="td-1"><?php echo $value['weight']; ?>кг</td>
                                    <td class="td-3"><?php echo $value['country']; ?></td>
                                    <td class="td-3"><?php echo $value['city']; ?></td>
                                    <td class="td-3"><?php echo $value['club']; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    <?php endif; ?>
                </div>
                <div class="view-tourn-x-grid">
                    <div class="participants-title">Сетка турнира</div>
                    <?php if (!$matches): ?>
                        <div class="view-tourn-x-no-matches">Сетка турнира будет доступна после жеребьвки</div>
                    <?php else: ?>
                    <div class="view-tourn-x-grid-wrap">
                        <div class="view-tourn-all-mathes">
                            <?php foreach ($pattern as $key => $value):?>
                                <div class="view-tourn-x-column stage-<?php echo $key?>">
                                    <?php for ($i=0;$i<$value;$i++):?>
                                        <a href="/tournaments/<?php echo $id?>/matches/<?php echo $matches[0]['id']?>" class="grid-a">
                                            <div class="view-tourn-x-match-stage"><?php echo $matches[0]['stage']?></div>
                                            <div class="view-tourn-x-match">
                                                <div class="view-tourn-x-match-fighter"><?php Tournament::getUserForView($matches[0]['fighter_1_id'])?></div>
                                                <div class="view-tourn-x-match-fighter"><?php Tournament::getUserForView($matches[0]['fighter_2_id'])?></div>
                                            </div>
                                        </a>
                                        <?php array_shift($matches)?>
                                    <?php endfor;?>
                                </div>

                            <?php endforeach;?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /.view-tourn-wrap -->
        </div>
        <!-- /.viewTourn-content -->
    </div>
    <!-- /.container -->
</div>
<!-- /.viewTourn -->

<?php
require_once "footer.php";
?>
