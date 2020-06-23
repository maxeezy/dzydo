<?php
return array(
    'host' => 'localhost',
    'dbname' => 'a0440803_dzydo',
    'user' => 'a0440803_dzydo',
    'password' => '123456',
    'option' =>[
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
);