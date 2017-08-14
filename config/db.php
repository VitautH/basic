<?php

if (!empty($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'timegame.by') !== false) {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=timegame_main',
        'username' => 'timegame_user',
        'password' => 'qw-D199877-Uast',
        'charset' => 'utf8',
    ];
}
else {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=casino',
        'username' => 'vitaut',
        'password' => 'FONVORK',
        'charset' => 'utf8',
    ];
}

