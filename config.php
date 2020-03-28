<?php

/**
 * Config file for storing all configurations
 *
 * Including DB Connection, API Keys etc
 */

return [
    'database' => [
        'name' => 'ongeza_test',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
