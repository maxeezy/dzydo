<?php
include_once('header.php');
?>
<div class="edit">
    <div class="container">
        <div class="edit-content">
            <div class="edit-title">Изменение данных</div>
            <?php if ($result): ?>
                <div class="register-done">Данные изменены.  <a href="/cabinet">Вернуться в кабинет</a> </div>
            <?php else: ?>
            <?php if (isset($errors) && (is_array($errors))): ?>
                <div class="register-error-field">
                    <?php foreach ($errors as $error): ?>
                        <div class="register-error"><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="edit-bio-wrap">
                <form action="" method="post">
                    <div class="edit-bio-group">
                        <div class="edit-bio-title">Учетные данные</div>
                        <div class="edit-bio-row">
                            <label for="name" class="register-form-label">Имя</label>
                            <input type="text" placeholder="Имя" name="name" id="name" class="register-form-some"
                                   value="<?php echo $userView->name ?>">
                        </div>
                        <div class="edit-bio-row">
                            <label for="surname" class="register-form-label">Фамилия</label>
                            <input type="text" placeholder="Фамилия" name="surname" id="surname"
                                   class="register-form-some" value="<?php echo $userView->surname ?>">
                        </div>
                        <div class="edit-bio-row">
                            <label for="patronymic" class="register-form-label">Отчество</label>
                            <input type="text" placeholder="Отчество" name="patronymic" id="patronymic"
                                   class="register-form-some" value="<?php echo $userView->patronymic ?>">
                        </div>
                        <div class="edit-bio-row">
                            <label for="email" class="register-form-label">E-mail</label>
                            <input type="text" placeholder="E-mail" name="email" id="email" class="register-form-some"
                                   value="<?php echo $userView->email ?>">
                        </div>
                        <div class="edit-bio-row">
                            <label for="password" class="register-form-label">Пароль</label>
                            <input type="password" placeholder="Пароль" name="password" id="password" class="register-form-some"
                                   value="<?php echo $userView->password?>">
                        </div>
                    </div>
                    <!-- /.edit-bio-group -->
                    <div class="edit-bio-group">
                        <div class="edit-bio-title">Биологические данные</div>
                        <div class="edit-bio-row">
                            <label for="sex" class="register-form-label">Пол</label>
                            <select name="sex" id="sex" class="edit-select">
                                <?php foreach ($getSex as  $value):?>
                                    <?php if ($user->sex_name == $value['name']):?>
                                        <option value="<?php echo $value['id']; ?>" selected="selected"><?php echo $value['name']; ?></option>
                                    <?php else:?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="edit-bio-row">
                            <label for="data" class="register-form-label">Дата рождения</label>
                            <?php if($user->data_of_birth==NULL):?>
                            <input type="date" placeholder="Дата рождения" name="data" id="data" class="register-form-some">
                            <?php else:?>
                            <input type="date" placeholder="Дата рождения" name="data" id="data" class="register-form-some" value="<?php echo $user->data_of_birth; ?>">
                            <?php endif;?>
                        </div>
                        <div class="edit-bio-row">
                            <label for="weight" class="register-form-label">Вес</label>
                            <input type="text" placeholder="Вес" name="weight" id="weight" class="register-form-some"
                                   value="<?php echo $userView->weight?>">
                        </div>
                    </div>
                    <!-- /.edit-bio-group -->
                    <div class="edit-bio-group">
                        <div class="edit-bio-title">Дополнительные данные</div>
                        <div class="edit-bio-row">
                            <label for="country" class="register-form-label">Страна</label>
                            <input type="text" placeholder="Страна" name="country" id="country"
                                   class="register-form-some" value="<?php echo $userView->country; ?>">
                        </div>
                        <div class="edit-bio-row">
                            <label for="city" class="register-form-label">Город</label>
                            <input type="text" placeholder="Город" name="city" id="city"
                                   class="register-form-some" value="<?php echo $userView->city; ?>">
                        </div>
                        <div class="edit-bio-row">
                            <label for="club_name_2" class="register-form-label">Клуб</label>
                            <select name="club_name_1" id="club_name_1" class="edit-select" onchange="check()">
                                <option value="write">Новый клуб</option>
                                <?php foreach ($clubs as  $value):?>
                                    <?php if ($user->club_name == $value['name']):?>
                                        <option value="<?php echo $value['id']; ?>" selected="selected"><?php echo $value['name']; ?></option>
                                    <?php else:?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <!-- /.edit-bio-group -->
                    <input type="submit" value="Изменить" name="submit" class="register-form-button">
                </form>
                <?php endif; ?>
            </div>
            <!-- /.edit-bio-wrap -->
        </div>
        <!-- /.edit-content -->
    </div>
    <!-- /.container -->
</div>

<?php
include_once('footer.php');
?>

