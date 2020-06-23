<?php
require_once "admin_header.php";
?>

<div class="invite">
    <div class="container">
        <div class="invite-content">
            <div class="invite-title">Подходящие спортсмены для приглашения</div>

        <?php if (isset($errors) && (is_array($errors))): ?>
            <div class="register-error-field">
                <?php foreach ($errors as $error): ?>
                    <div class="register-error"><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
            <div class="invite-wrap">
                <?php if (!$users):?>
                <div class="users-no">Нет подходящих спортсменов для этого турнира</div>
                <?php else: ?>
                <table class="invite-table">
                    <tr><th>Ф.И.О спортсмена</th><th>Дата рождения:</th><th>Вес</th><th>Страна</th><th>Город</th><th>Клуб</th><th></th></tr>
                    <?php foreach ($users as $user):?>
                    <tr><td><?php echo $user['surname']." ".$user['name']." ".$user['patronymic'];?></td><td><?php echo $user['data_of_birth'];?></td><td><?php echo $user['weight'];?></td><td><?php echo $user['country'];?></td><td><?php echo $user['city'];?></td><td><?php echo $user['club_name'];?></td><td><a href="/admin/tournaments/invite/<?php echo $id;?>/user/<?php echo $user['id'];?>" class="admin-tournaments-a active">Добавить участника</a></td></tr>
                    <?php endforeach;?>
                </table>
                <?php endif; ?>
            </div>
            <div class="request-wrap">
                <?php if (!$request):?>
                <div class="users-no">Нет заявок от спортсменов на этот турнир</div>
                <?php else: ?>
                <div class="invite-title">Заявки от спортсменов на этот турнир</div>
                    <table class="invite-table">
                        <tr><th>Ф.И.О спортсмена</th><th>Дата рождения:</th><th>Вес</th><th>Страна</th><th>Город</th><th>Клуб</th><th></th><th></th></tr>
                        <?php foreach ($request as $user):?>
                            <tr><td><?php echo $user['surname']." ".$user['name']." ".$user['patronymic'];?></td><td><?php echo $user['data_of_birth'];?></td><td><?php echo $user['weight'];?></td><td><?php echo $user['country'];?></td><td><?php echo $user['city'];?></td><td><?php echo $user['club'];?></td><td><a href="/admin/tournaments/invite/<?php echo $id;?>/user/<?php echo $user['id'];?>" class="admin-tournaments-a active">Добавить участника</a></td><td><a href="/admin/request/delete/<?php echo $user['request'];?>" class="admin-tournaments-a " style="background-color: firebrick; color: white;">Отклонить заявку</a></td></tr>
                        <?php endforeach;?>
                    </table>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php
require_once "footer.php";
?>

