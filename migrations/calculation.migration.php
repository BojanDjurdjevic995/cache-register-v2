<?php

$drop = 'DROP TABLE IF EXISTS calculation';
$create = 'CREATE TABLE IF NOT EXISTS calculation ( id uuid DEFAULT uuid_generate_v4 () PRIMARY KEY, name VARCHAR ( 300 ), object VARCHAR ( 300 ), date VARCHAR ( 300 ), document VARCHAR ( 300 ), invoice_value float DEFAULT NULL, discount float DEFAULT NULL, nf_value float DEFAULT NULL, tax float DEFAULT NULL, excise float DEFAULT NULL, customs float DEFAULT NULL, other_taxable_expenses float DEFAULT NULL, non_taxable_expenses float DEFAULT NULL, purchase_value float DEFAULT NULL, basis_for_pdv float DEFAULT NULL, input_pdv float DEFAULT NULL, price_difference float DEFAULT NULL, calculated_pdv float DEFAULT NULL, sales_value float DEFAULT NULL, created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP);';

$insert = 'INSERT INTO calculation (name, object, date, document, invoice_value, discount, nf_value, tax, excise, customs, other_taxable_expenses, non_taxable_expenses, purchase_value, basis_for_pdv, input_pdv, price_difference, calculated_pdv, sales_value) VALUES
(\'Prodavnica Pečeneg Ilova\', \'247 - VELEPRODAJA\', \'2020-07-27\', \'FAKTURA IF19+/44930\', 1715, 0, 1715, 1, 2, 3, 15, 2, 17, 3, 17, 9, 17, 27),
(\'Infomedia\', \'Banja Luka\', \'2020-07-14\', \'FAKTURA IF77+/223589\', 2590, 30, 1, 55, 3, 0.17, 99, 145, 350, 17, 17, 1356, 78, 780),
(\'Velika Ilova\', \'Objekat Ilova\', \'2020-07-16\', \'Dokument Ilova\', 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100);';

return [
    'drop' => $drop,
    'create' => $create,
    'insert' => $insert
];