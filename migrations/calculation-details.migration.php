<?php

$firstID = $ids[0]['id'];
$secondID = $ids[1]['id'];
$thirdID = $ids[2]['id'];

$drop = 'DROP TABLE IF EXISTS calculation_details';
$create = 'CREATE TABLE IF NOT EXISTS calculation_details (id uuid DEFAULT uuid_generate_v4 () PRIMARY KEY, calculation_id VARCHAR ( 300 ) DEFAULT NULL, code VARCHAR ( 300 ) NOT NULL, article_name VARCHAR ( 300 ) DEFAULT NULL, purchase_price float DEFAULT NULL, purchase_value float DEFAULT NULL, unit_of_measure VARCHAR ( 300 ) DEFAULT NULL, quantity float DEFAULT NULL, input_pdv float DEFAULT NULL, price_invoice float DEFAULT NULL, ruc_perc float DEFAULT NULL, discount float DEFAULT NULL, discount_value float DEFAULT NULL, ruc float DEFAULT NULL, nf_value float DEFAULT NULL, calculated_pdv float DEFAULT NULL, tac float DEFAULT NULL, value float DEFAULT NULL, zt float DEFAULT NULL, price float DEFAULT NULL, created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP );';

$insert = 'INSERT INTO calculation_details (calculation_id, code, article_name, purchase_price, purchase_value, unit_of_measure, quantity, input_pdv, price_invoice, ruc_perc, discount, discount_value, ruc, nf_value, calculated_pdv, tac, value, zt, price) VALUES
(\''.$firstID.'\', \'0531705\', \'Richard\', 2.5, 5, \'KOM\', 20, 0, 2.5, 0, 0, 0, 0, 1, 85, 0, 1, 85, 2.5),
(\''.$firstID.'\', \'0236985\', \'Chips\', 2, 3, \'KOM\', 30, 0, 2.5, 0, 0, 0, 0, 1, 85, 0, 1, 85, 2.5),
(\''.$firstID.'\', \'0431437\', \'Coca Cola\', 0.9, 0.9, \'KOM\', 95, 0.17, 1.3, 3, 2, 22, 14, 7, 17, 3, 9, 7, 1.2),
(\''.$secondID.'\', \'2369856\', \'Napolitanke\', 4, 3, \'KOM\', 10, 3, 1, 1, 1, 1, 1, 1, 1, 1, 13, 3, 43),
(\''.$secondID.'\', \'0431291\', \'Takovo\', 3, 4, \'KOM\', 400, 4, 4, 4, 4, 4, 4, 4, 4, 4, 34, 4, 8),
(\''.$thirdID.'\', \'0430984\', \'Monitor\', 35, 35, \'KOM\', 15, 17, 33, 2, 3, 17, 2, 25, 15, 2, 17, 3, 258),
(\''.$thirdID.'\', \'0430355\', \'Tastatura\', 38, 33, \'KOM\', 20, 2, 2, 2, 3, 41, 23, 5, 6, 7, 5, 2, 28),
(\''.$thirdID.'\', \'0161340\', \'Mis\', 17, 14, \'KOM\', 40, 17, 13, 43, 22, 45, 98, 43, 19, 30, 17, 3, 18);';

return [
    'drop' => $drop,
    'create' => $create,
    'insert' => $insert
];