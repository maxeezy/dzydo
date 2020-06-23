<?php
require_once "admin_header.php";
?>
<div class="cabinet">
    <div class="container">
        <div class="cabinet-content">
            <div class="cabinet-up-wrap">
                <div class="cabinet-title">
                    Профиль <?php echo $user->surname." ".$user->name." ".$user->patronymic?></div>
                <!-- /.cabinet-title -->
                <a href="/admin/users/edit/<?php echo $id;?>">Изменить данные</a>
            </div>

            <div class="cabinet-info">
                <div class="cabinet-info-row">Фамилия: <?php echo $user->surname?></div>
                <div class="cabinet-info-row">Отчество: <?php echo $user->patronymic?></div>
                <div class="cabinet-info-row">E-mail: <?php echo $user->email?></div>
                <div class="cabinet-info-row">Дата рождения: <?php echo $user->data_of_birth?></div>
                <div class="cabinet-info-row">Пол: <?php echo $user->sex_name?></div>
                <div class="cabinet-info-row">Вес: <?php echo $user->weight?></div>
                <div class="cabinet-info-row">Страна: <?php echo $user->country?></div>
                <div class="cabinet-info-row">Город: <?php echo $user->city?></div>
                <div class="cabinet-info-row">Клуб: <?php echo $user->club_name?></div>
            </div>

        </div>
        <!-- /.cabinet-content -->
    </div>
</div>
<!-- /.cabinet -->
<?php
require_once "footer.php";
?>

