<?php
require_once "admin_header.php";
?>

<div class="admin-tournaments-add">
    <div class="container">
        <div class="admin-tournaments-add-content">
            <div class="admin-tournaments-add-title">Добавление нового турнира</div>
            <div class="admin-tournaments-buttons-wrap">
                <a href="/admin" class="admin-tournaments-a ">Админ панель</a>
                <a href="/admin/tournaments" class="admin-tournaments-a">Управление турнирами</a>
                <a href="/admin/tournaments/add" class="admin-tournaments-a active">Добавление турнира</a>
            </div>
            <?php if ($result):?>
                <div class="register-done">Турнир добавлен.</div>
            <?php else: ?>
            <?php if (isset($errors) && (is_array($errors))): ?>
                <div class="register-error-field">
                    <?php foreach ($errors as $error): ?>
                        <div class="register-error"><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="admin-tournaments-add-field">
                <form action="" class="admin-tournaments-add-form" method="post">
                    <div class="edit-bio-row">
                        <label for="name" class="register-form-label">Название турнира</label>
                        <input type="text" placeholder="Имя" name="name" id="name" class="register-form-some" value="<?php echo $name;?>">
                    </div>
                    <div class="edit-bio-row">
                        <label for="sex" class="register-form-label">Пол</label>
                        <select name="sex" id="sex" class="edit-select">
                            <?php foreach ($getSex as $value):?>
                            <option value="<?php echo $value['id']?>"><?php echo $value['name'] ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="edit-bio-row">
                        <label for="category" class="register-form-label">Категория</label>
                        <select name="category" id="category" class="edit-select">
                            <?php foreach ($getCategory as $value):?>
                                <option value="<?php echo $value['id']?>"><?php echo $value['name'] ?> лет</option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="edit-bio-row">
                        <label for="weight" class="register-form-label">Вес</label>
                        <input type="text" placeholder="Писать через -" name="weight" id="weight" class="register-form-some" value="<?php echo $weight;?>">
                    </div>
                    <div class="edit-bio-row">
                        <label for="data" class="register-form-label">Дата проведения турнира</label>
                        <input type="date" placeholder="Дата рождения" name="data" id="data" class="register-form-some">
                    </div>
                    <input type="submit" value="Создать" name="submit" class="register-form-button">
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /.container -->
</div>

<?php
require_once "footer.php";
?>
