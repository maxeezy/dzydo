<?php
require_once "admin_header.php";
?>

<div class="inviteTry">
    <div class="container">
        <div class="inviteTry-content">
            <div class="inviteTry-title">Вы точно хотите отклонить эту заявку?</div>
            <div class="iviteTry-field">
                <?php if (!$result):?>
                    <form action="" method="post" class="invite-try-form">
                        <input type="submit" name="submit" value="Да,удалить" class="register-form-button">
                        <div class="back"><a href="/admin/tournaments">Нет, вернуться назад</a></div>
                    </form>
                <?php else:?>
                    <div class="invite-done">Заявка откланена <a href="/admin/tournaments">Вы можете вернуться</a></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once "footer.php";
?>
