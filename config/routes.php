<?php

// Возращаем массив с путями на сайте
return array(
    'tournaments/([0-9]+)/matches/([0-9]+)' => 'tournaments/matchView/$1/$2',
    'tournaments/([0-9]+)' => 'tournaments/view/$1',
    'tournaments' => 'tournaments/index',
    'admin/request/delete/([0-9]+)' => 'admin/requestDelete/$1',
    'admin/tournaments/([0-9]+)/matches/edit/([0-9]+)' => 'admin/matchEdit/$1/$2',
    'admin/tournaments/toss/([0-9]+)' => 'admin/toss/$1',
    'admin/tournaments/invite/([0-9]+)/user/([0-9]+)' => 'admin/inviteTry/$1/$2',
    'admin/tournaments/invite/([0-9]+)' => 'admin/invite/$1',
    'admin/tournaments/delete/([0-9]+)' => 'admin/tournamentsDelete/$1',
    'admin/tournaments/edit/([0-9]+)' => 'admin/tournamentsEdit/$1',
    'admin/tournaments/([0-9]+)' => 'admin/tournamentsView/$1',
    'admin/tournaments/add' => 'admin/tournamentsAdd',
    'admin/tournaments' => 'admin/tournaments',
    'admin/users/edit/([0-9]+)' => 'admin/usersEdit/$1',
    'admin/users/([0-9]+)' => 'admin/usersView/$1',
    'admin/users/add' => 'admin/usersAdd',
    'admin/users' => 'admin/users',
    'admin' => 'admin/index',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    'user/logout' => 'user/logout',
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    '' => 'main/index',
);