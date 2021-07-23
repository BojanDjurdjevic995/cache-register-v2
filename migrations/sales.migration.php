<?php

$drop = 'DROP TABLE IF EXISTS sales';
$create = 'CREATE TABLE IF NOT EXISTS sales (
    id uuid DEFAULT uuid_generate_v4 () PRIMARY KEY, 
    customer VARCHAR ( 300 ) DEFAULT NULL, 
    customer_pib VARCHAR ( 300 ) DEFAULT NULL, 
    customer_jib VARCHAR ( 300 ) DEFAULT NULL, 
    invoice INTEGER DEFAULT NULL, 
    delivery_note INTEGER DEFAULT NULL, 
    date TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, 
    dpo VARCHAR ( 300 ) DEFAULT NULL, 
    currency VARCHAR ( 300 ) DEFAULT NULL, 
    delivery_date timestamp NULL DEFAULT NULL, 
    delivery_place VARCHAR ( 300 ) DEFAULT NULL, 
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP );';

$insert = 'SELECT * FROM sales';

return [
    'drop' => $drop,
    'create' => $create,
    'insert' => $insert
];