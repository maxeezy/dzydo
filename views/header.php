<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->title; ?></title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
</head>
<body>
<header>
    <div class="container">
        <div class="header-content">
            <div class="header-content-left">
                <img src="/img/logo.jpg" alt="" class="logo">
                <div class="header-2-name">DZYUDO</div>
                <a href="/" class="header-2-a">Главная</a>
                <a href="/tournaments" class="header-2-a">Турниры</a>
            </div>
            <div class="header-content-right">

                <?php if (USER::isGuest()):?>
                <div class="header-content-right-some"><a href="/user/register">Зарегестрироваться</a></div>
                <div class="header-content-right-some"><a href="/user/login">Вход</a></div>
                <?php else: ?>
                <div class="header-content-right-some"><a href="/cabinet">Аккаунт</a></div>
                <div class="header-content-right-some"><a href="/user/logout">Выход</a></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>


