<?php
include_once('header.php');
?>

<div class="register">
    <div class="container">
        <div class="register-content">
            <div class="register-title">
                Авторизация
            </div>
            <!-- /.autoriz-content-title -->
            <?php if (isset($errors) && (is_array($errors))): ?>
                <div class="register-error-field">
                    <?php foreach ($errors as $error): ?>
                        <div class="register-error"><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
                <form action="" class="register-form" method="post">
                    <div class="register-form-row">
                        <label for="email" class="register-form-label">E-mail</label>
                        <input type="email" placeholder="E-mail" name="email" id="email" class="register-form-some"
                               value="<?php echo $email ?>">
                    </div>
                    <div class="register-form-row">
                        <label for="password" class="register-form-label">Пароль</label>
                        <input type="password" placeholder="Пароль" name="password" id="password"
                               class="register-form-some" value="<?php echo $password ?>">
                    </div>
                    <input type="submit" value="Авторизироваться" name="submit" class="register-form-button">
                </form>
        </div>
    </div>
</div>

<?php
include_once('footer.php');
?>
