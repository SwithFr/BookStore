<?php

return [
    'host' => 'localhost',
    'dbName' => 'library',
    'username' => 'LOGIN',
    'password' => 'PASSWORD',
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];