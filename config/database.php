<?php
    return [
        'default' => env('DB_CONNECTION', 'postgres'),
        'connections' => [
            'postgres' => [
                'driver'            => 'postgres',
                'url'               => '',
                'host'              => 'cache_register_postgres',
                'port'              => '5439',
                'database'          => 'cache_register',
                'username'          => 'cache_register',
                'password'          => 'cache_register',
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