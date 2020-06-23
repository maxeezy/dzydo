<?php
require_once "header.php";
?>

<div class="index">
    <div class="background"></div>
    <div class="container">
        <div class="index-content">
            <div class="index-title">Последние 10 турниров</div>
            <div class="index-title-wrap">
                <?php foreach ($tournaments as $tournament):?>
                    <a href='/tournaments/<?php echo $tournament['id']?>' style="text-decoration: none">
                        <div class="index-tournament-x">
                            <div class="index-tournament-x-up">
                                <div class="index-tournament-x-some">Название</div>
                                <div class="index-tournament-x-some">Дата проведения</div>
                                <div class="index-tournament-x-some">Категория</div>
                                <div class="index-tournament-x-some">Весовая категория</div>
                                <div class="index-tournament-x-some">Пол</div>
                            </div>
                            <div class="index-tournament-x-down">
                                <div class="index-tournament-x-name"><?php echo $tournament['name']?></div>
                                <div class="index-tournament-x-date"><?php echo $tournament['data']?></div>
                                <div class="index-tournament-x-category"><?php echo $tournament['category']?> лет</div>
                                <div class="index-tournament-x-weight"><?php echo $tournament['weight']?>кг</div>
                                <div class="index-tournament-x-sex"><?php echo $tournament['sex']?></div>
                            </div>
                        </div>
                    </a>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

<?php
require_once "footer.php";
?>

