<?php

$drop = 'DROP TABLE IF EXISTS sale_details';
$create = 'CREATE TABLE IF NOT EXISTS sale_details (
    id uuid DEFAULT uuid_generate_v4 () PRIMARY KEY, 
    sale_id VARCHAR(255) DEFAULT NULL,
    code VARCHAR(255) DEFAULT NULL,
    article_name VARCHAR(255) DEFAULT NULL,
    unit_of_measure VARCHAR(255) DEFAULT NULL,
    quantity VARCHAR(255) DEFAULT NULL,
    price float DEFAULT NULL,
    excise float DEFAULT NULL,
    discount float DEFAULT NULL,
    value float DEFAULT NULL,
    pdv float DEFAULT NULL,
    total float DEFAULT NULL,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP );';

$insert = 'SELECT * FROM sale_details';

return [
    'drop' => $drop,
    'create' => $create,
    'insert' => $insert
];