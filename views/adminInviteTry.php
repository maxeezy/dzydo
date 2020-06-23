<?php
require_once "admin_header.php";
?>

<div class="inviteTry">
    <div class="container">
        <div class="inviteTry-content">
            <div class="inviteTry-title">Вы точно хотите добавить <?php echo $user->surname." ".$user->name." ".$user->patronymic." ";?>в турнир <?php echo " ".$tournament->name." "?>в категорию <?php echo $tournament->category."лет, весовая категория ".$tournament->weight." кг?"?></div>
            <div class="iviteTry-field">
                <?php if (!$result):?>
                <form action="" method="post" class="invite-try-form">
                    <input type="submit" name="submit" value="Да,добавить" class="register-form-button">
                    <div class="back"><a href="/admin/tournaments/invite/<?php echo $tournament->id;?>">Нет, вернуться назад</a></div>
                </form>
                <?php else:?>
                <div class="invite-done">Участник добавлен <a href="/admin/tournaments/invite/<?php echo $tournId; ?>"></a><a href="/admin/tournaments/invite/<?php echo $tournament->id;?>">Вы можете вернуться</a></div>
                <?php endif; ?>
            </div>
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

<?php
require_once "footer.php";
?>


