<?php
require_once "admin_header.php";
?>
<div class="admin-tournaments">
    <div class="container">
        <div class="admin-tournaments-title">
            Турниры
        </div>
        <div class="admin-tournaments-buttons-wrap">
            <a href="/admin" class="admin-tournaments-a ">Админ панель</a>
            <a href="/admin/tournaments" class="admin-tournaments-a active">Управление турнирами</a>
        </div>
        <div class="admin-tournaments-b-add">
            <a href="/admin/tournaments/add">+ Создать турнир</a>
        </div>
        <div class="admin-tournaments-wrap">
            <div class="admin-tournaments-title">Все турниры</div>
            <div class="admins-tournaments-all">
                <table>
                    <tr><th>id Турнира</th><th>Название турнира</th><th>Пол</th><th>Возрастная категория</th><th>Весовая категория</th><th>Дата проведения</th></tr>
                    <?php foreach ($tournaments as $value):?>
                    <tr><td style="width: 11%; text-align: center"><?php echo $value['id']?></td><td style="width: 11%; text-align: center"><?php echo $value['name']?></td><td style="width: 11%; text-align: center"><?php echo $value['sex'] ?></td><td style="width: 11%; text-align: center"><?php echo $value['category'] ?></td><td style="width: 11%; text-align: center"><?php echo $value['weight'] ?></td><td style="width: 11%; text-align: center"><?php echo $value['data'] ?></td><td style="width: 11%; text-align: center">
                            <a href="/admin/tournaments/<?php echo $value['id']?>" style="color:black">Просмотреть</a></td><td style="width: 11%; text-align: center"><a href="/admin/tournaments/edit/<?php echo $value['id']?>" style="color:black">Изменить</a><td style="width: 11%; text-align: center"><a href="/admin/tournaments/delete/<?php echo $value['id']?>" style="color:black">Удалить</a></td></td></tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>

</div>
<?php
require_once "footer.php";
?>
