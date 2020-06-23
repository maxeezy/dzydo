<?php
include_once('header.php');
?>

<div class="cabinet">
    <div class="container">
        <div class="cabinet-content">
            <div class="cabinet-up-wrap">
                <div class="cabinet-title">
                    Здравствуйте <?php echo $userView->name?></div>
                <!-- /.cabinet-title -->
                <a href="/cabinet/edit">Изменить данные</a>
            </div>

            <div class="cabinet-info">
                <div class="cabinet-info-row">Фамилия: <?php echo $userView->surname?></div>
                <div class="cabinet-info-row">Отчество: <?php echo $userView->patronymic?></div>
                <div class="cabinet-info-row">E-mail: <?php echo $userView->email?></div>
                <div class="cabinet-info-row">Дата рождения: <?php echo $userView->data_of_birth?></div>
                <div class="cabinet-info-row">Пол: <?php echo $userView->sex_name?></div>
                <div class="cabinet-info-row">Вес: <?php echo $userView->weight?></div>
                <div class="cabinet-info-row">Страна: <?php echo $userView->country?></div>
                <div class="cabinet-info-row">Город: <?php echo $userView->city?></div>
                <div class="cabinet-info-row">Клуб: <?php echo $userView->club_name?></div>
            </div>

            <div class="cabinet-tournaments">
                <div class="cabinet-tournaments-title">Ваши турниры</div>
                <!-- /.cabinet-tournaments-title -->
                <div class="cabinet-tournaments-wrap">
                    <?php if ($tournaments == NULL):?>
                    <div class="cabinet-tournaments-no">Вы еще не участвовали ни в одном турнире</div>
                    <?else:?>
                        <?php foreach ($tournaments as $tournament):?>
                            <a href='/tournaments/<?php echo $tournament['id']?>' style="text-decoration: none">
                                <div class="index-tournament-x">
                                    <div class="index-tournament-x-up">
                                        <div class="index-tournament-x-some" style="width: 20%">Название</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Дата проведения</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Категория</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Весовая категория</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Пол</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Результат</div>
                                    </div>
                                    <div class="index-tournament-x-down">
                                        <div class="index-tournament-x-name" style="width: 20%"><?php echo $tournament['tournament_name']?></div>
                                        <div class="index-tournament-x-date" style="width: 20%"><?php echo $tournament['data']?></div>
                                        <div class="index-tournament-x-category" style="width: 20%"><?php echo $tournament['category_name']?> лет</div>
                                        <div class="index-tournament-x-weight" style="width: 20%"><?php echo $tournament['weight']?>кг</div>
                                        <div class="index-tournament-x-sex" style="width: 20%;border-right: 1px solid grey"><?php echo $tournament['sex']?></div>
                                        <div class="index-tournament-x-sex" style="width: 20%"><?php echo $tournament['result_name']?></div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
            <!-- /.cabinet-tournaments -->
            <div class="cabinet-request">
                <div class="cabinet-tournaments-title">Ваши заявки</div>
                <!-- /.cabinet-tournaments-title -->
                <div class="cabinet-tournaments-wrap">
                    <?php if ($request == NULL):?>
                        <div class="cabinet-tournaments-no">У вас нет поданных заявок на турниры</div>
                    <?else:?>
                        <?php foreach ($request as $tournament):?>
                            <a href='/tournaments/<?php echo $tournament['id']?>' style="text-decoration: none">
                                <div class="index-tournament-x">
                                    <div class="index-tournament-x-up">
                                        <div class="index-tournament-x-some" style="width: 20%">Название</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Дата проведения</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Категория</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Весовая категория</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Пол</div>
                                        <div class="index-tournament-x-some" style="width: 20%">Результат</div>
                                    </div>
                                    <div class="index-tournament-x-down">
                                        <div class="index-tournament-x-name" style="width: 20%"><?php echo $tournament['name']?></div>
                                        <div class="index-tournament-x-date" style="width: 20%"><?php echo $tournament['data']?></div>
                                        <div class="index-tournament-x-category" style="width: 20%"><?php echo $tournament['category_name']?> лет</div>
                                        <div class="index-tournament-x-weight" style="width: 20%"><?php echo $tournament['weight']?>кг</div>
                                        <div class="index-tournament-x-sex" style="width: 20%;border-right: 1px solid grey"><?php echo $tournament['sex']?></div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <!-- /.cabinet-content -->
    </div>
</div>
<!-- /.cabinet -->

<?php
include_once('footer.php');
?>
