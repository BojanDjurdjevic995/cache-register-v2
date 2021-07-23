<?php

$drop = 'DROP TABLE IF EXISTS users';
$create = 'CREATE TABLE IF NOT EXISTS users (id uuid DEFAULT uuid_generate_v4 () PRIMARY KEY, name VARCHAR ( 300 ) DEFAULT NULL, email VARCHAR ( 300 ) UNIQUE DEFAULT NULL, password VARCHAR ( 300 ) DEFAULT NULL, created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP );';

$insert = 'INSERT INTO users (name, email, password) VALUES (\'Bojan Djurdjevic\', \'djurdjevicbojan12@gmail.com\', \'$2y$10$jM3vqXKADzc5oM2/oaQLzu4eDdTobHKmOkwfNGw39PdGkb.YQ/EUK\');';

return [
    'drop' => $drop,
    'create' => $create,
    'insert' => $insert
];