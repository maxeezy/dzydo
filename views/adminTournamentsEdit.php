<?php
require_once "admin_header.php";
?>
<div class="admin-tournaments-add">
    <div class="container">
        <div class="admin-tournaments-add-content">
            <div class="edit-main">
                <div class="admin-tournaments-add-title">Изменение турнира <?php echo $tournament->name; ?></div>
                <?php if ($result): ?>
                    <div class="register-done">Турнир изменён. <a href="/admin/tournaments/<?php echo $id; ?>" style="color: black;">Вернуться назад</a></div>
                <?php else: ?>
                <div class="admin-tournaments-add-field">
                    <form action="" class="admin-tournaments-add-form" method="post">
                        <div class="edit-bio-row">
                            <label for="name" class="register-form-label">Название турнира</label>
                            <input type="text" placeholder="Имя" name="name" id="name" class="register-form-some"
                                   value="<?php echo $tournament->name; ?>">
                        </div>
                        <input type="submit" value="Изменить" name="submit" class="register-form-button">
                    </form>
                    <?php endif; ?>
                </div>
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
    <!-- /.container -->
</div>
<?php
require_once "footer.php";
?>


