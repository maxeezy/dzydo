<?php
require_once "admin_header.php";
?>
<div class="edit">
    <div class="container">
        <div class="edit-content">
            <div class="edit-main">
                <div class="edit-title">Регистрация спортсмена</div>
                <?php if ($result): ?>
                    <div class="register-done">Спортсмен зарегистрирован.<a href="/admin/users" style="color: black;text-decoration: none">Вернуться назад</a> </div>
                <?php else: ?>
                <div class="edit-bio-wrap">
                    <form action="" method="post">
                        <div class="edit-bio-group">
                            <div class="edit-bio-title">Учетные данные</div>
                            <div class="edit-bio-row">
                                <label for="name" class="register-form-label">Имя</label>
                                <input type="text" placeholder="Имя" name="name" id="name" class="register-form-some"
                                       value="<?php echo $name ?>">
                            </div>
                            <div class="edit-bio-row">
                                <label for="surname" class="register-form-label">Фамилия</label>
                                <input type="text" placeholder="Фамилия" name="surname" id="surname"
                                       class="register-form-some" value="<?php echo $surname ?>">
                            </div>
                            <div class="edit-bio-row">
                                <label for="patronymic" class="register-form-label">Отчество</label>
                                <input type="text" placeholder="Отчество" name="patronymic" id="patronymic"
                                       class="register-form-some" value="<?php echo $patronymic ?>">
                            </div>
                            <div class="edit-bio-row">
                                <label for="email" class="register-form-label">E-mail</label>
                                <input type="text" placeholder="E-mail" name="email" id="email" class="register-form-some"
                                       value="<?php echo $email ?>">
                            </div>
                            <div class="edit-bio-row">
                                <label for="password" class="register-form-label">Пароль</label>
                                <input type="password" placeholder="Пароль" name="password" id="password" class="register-form-some"
                                       value="<?php echo $password?>">
                            </div>
                        </div>
                        <!-- /.edit-bio-group -->
                        <div class="edit-bio-group">
                            <div class="edit-bio-title">Биологические данные</div>
                            <div class="edit-bio-row">
                                <label for="sex" class="register-form-label">Пол</label>
                                <select name="sex" id="sex" class="edit-select">
                                    <?php foreach ($getSex as  $value):?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="edit-bio-row">
                                <label for="data" class="register-form-label">Дата рождения</label>
                                    <input type="date" placeholder="Дата рождения" name="data" id="data" class="register-form-some" value="<?php echo $data_of_birth; ?>">
                            </div>
                            <div class="edit-bio-row">
                                <label for="weight" class="register-form-label">Вес</label>
                                <input type="text" placeholder="Вес" name="weight" id="weight" class="register-form-some"
                                       value="<?php echo $weight?>">
                            </div>
                        </div>
                        <!-- /.edit-bio-group -->
                        <div class="edit-bio-group">
                            <div class="edit-bio-title">Дополнительные данные</div>
                            <div class="edit-bio-row">
                                <label for="country" class="register-form-label">Страна</label>
                                <input type="text" placeholder="Страна" name="country" id="country"
                                       class="register-form-some" value="<?php echo $country; ?>">
                            </div>
                            <div class="edit-bio-row">
                                <label for="city" class="register-form-label">Город</label>
                                <input type="text" placeholder="Город" name="city" id="city"
                                       class="register-form-some" value="<?php echo $city; ?>">
                            </div>
                            <div class="edit-bio-row">
                                <label for="club_name_2" class="register-form-label">Клуб</label>
                                <select name="club_name_1" id="club_name_1" class="edit-select" onchange="check()">
                                    <?php foreach ($clubs as  $value):?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach;?>
                                    <option value="write">Новый клуб</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.edit-bio-group -->
                        <input type="submit" value="Зарегистрировать" name="submit" class="register-form-button">
                    </form>
                    <?php endif; ?>
                </div>
                <!-- /.edit-bio-wrap -->
            </div>
            <?php if (isset($errors) && (is_array($errors))): ?>
                <div class="register-error-field" style="padding-top: 140px;">
                    <?php foreach ($errors as $error): ?>
                        <div class="register-error" ><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- /.edit-content -->
    </div>
    <!-- /.container -->
</div>

<?php
require_once "footer.php";
?>

