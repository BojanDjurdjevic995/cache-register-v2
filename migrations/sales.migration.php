<?php

$drop = 'DROP TABLE IF EXISTS sales';
$create = 'CREATE TABLE IF NOT EXISTS sales (
    id uuid DEFAULT uuid_generate_v4 () PRIMARY KEY, 
    customer VARCHAR ( 300 ) DEFAULT NULL, 
    customer_pib VARCHAR ( 300 ) DEFAULT NULL, 
    customer_jib VARCHAR ( 300 ) DEFAULT NULL, 
    web_address VARCHAR ( 300 ) DEFAULT NULL, 
    email VARCHAR ( 300 ) DEFAULT NULL, 
    invoice VARCHAR ( 300 ) DEFAULT NULL, 
    date TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, 
    dpo VARCHAR ( 300 ) DEFAULT NULL, 
    currency VARCHAR ( 300 ) DEFAULT NULL, 
    delivery_date timestamp NULL DEFAULT NULL, 
    delivery_place VARCHAR ( 300 ) DEFAULT NULL, 
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP );';

$insert = 'INSERT INTO sales (customer, customer_pib, customer_jib, web_address, email, invoice, dpo, currency, delivery_place) VALUES
(\'Kupac Bojan\', 235893, 748963, \'http://www.google.ba\', \'djurdjevicbojan12@gmail.com\', \'2/257\', \'DPO Neki\', \'BAM\', \'Prnjavor\')';

return [
    'drop' => $drop,
    'create' => $create,
    'insert' => $insert
];