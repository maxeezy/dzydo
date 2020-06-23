<?php
require_once "admin_header.php";
?>
<div class="admin-toss">
    <div class="container">
        <div class="admin-toss-content">
            <div class="admin-toss-title">Удаление турнира <?php echo $tournament->name;?></div>
            <div class="admin-toss-wrap">
                <?php if (!$result):?>
                    <form action="" method="post" class="invite-try-form">
                        <input type="submit" name="submit" value="Да,удалить этот турнир" class="register-form-button">
                        <div class="back"><a href="/admin/tournaments/<?php echo $tournament->id;?>">Нет, вернуться назад</a></div>
                    </form>
                <?php else:?>
                    <div class="invite-done">Турнир удалён <a href="/admin/tournaments/<?php echo $id; ?>">Вы можете вернуться.</a></div>
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

