<?php
require_once "admin_header.php";
?>
<div class="admin-tournaments">
    <div class="container">
        <div class="admin-tournaments-title">
            Пользователи
        </div>
        <div class="admin-tournaments-buttons-wrap">
            <a href="/admin" class="admin-tournaments-a ">Админ панель</a>
            <a href="/admin/users" class="admin-tournaments-a active">Управление пользователями</a>
        </div>
        <div class="admin-tournaments-b-add">
            <a href="/admin/users/add">+ Зарегистрировать спортсмена</a>
        </div>
        <div class="admin-tournaments-wrap">
            <div class="admin-tournaments-title">Все спортсмены</div>
            <div class="admins-tournaments-all">
                <table>
                    <tr><th style="width: 14%; padding: 5px;    ">id Спортсмена</th><th style="width: 14%; padding: 5px;    ">Фио</th><th style="width: 14%; padding: 5px;  ">Пол</th><th style="width: 14%; padding: 5px;  ">Дата рождения</th><th style="width: 14%; padding: 5px;    "></th><th style="width: 14%"></th></tr>
                    <?php foreach ($users as $user):?>
                        <tr style="text-align: center;"><td style="width: 14%; padding: 5px;    "><?php echo $user['id']?></td><td style="width: 14%; padding: 5px; "><?php echo $user['surname']." ".$user['name']." ".$user['patronymic']?></td><td style="width: 14%; padding: 5px;  "><?php echo $user['sex'] ?></td><td style="width: 14%; padding: 5px;   "><?php echo $user['data_of_birth'] ?></td><td style="width: 14%; padding: 5px; "><a href="/admin/users/<?php echo $user['id']?>" style="color:black;">Просмотреть</a></td><td style="width: 14%; padding: 5px;  "><a href="/admin/users/edit/<?php echo $user['id']?>" style="color:black;">Изменить</a></td></tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>

</div>
<?php
require_once "footer.php";
?>
