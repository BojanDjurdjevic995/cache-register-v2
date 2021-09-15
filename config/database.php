<?php
    return [
        'default' => env('DB_CONNECTION', 'postgres'),
        'connections' => [
            'postgres' => [
                'driver'            => 'postgres',
                'url'               => '',
                'host'              => 'localhost',
                'port'              => '5432',
                'database'          => 'cache_register',
                'username'          => 'postgres',
                'password'          => 'postgres',
                'unix_socket'       => '',
                'charset'           => 'utf8mb4',
                'collation'         => 'utf8mb4_unicode_ci',
                'prefix'            => '',
                'prefix_indexes'    => true,
                'strict'            => true,
                'engine'            => null,
                'options'           => extension_loaded('pdo_mysql') ? array_filter([\PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),]) : [],
            ]
        ]
    ];