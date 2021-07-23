<?php
require_once '../config/config.php';
use Illuminate\Support\Arr;
$nizJedinica = [
    0 => '',
    1 => 'jedan',
    2 => 'dva',
    3 => 'tri',
    4 => 'četiri',
    5 => 'pet',
    6 => 'šest',
    7 => 'sedam',
    8 => 'osam',
    9 => 'devet',
];
$nizDesetica = [
    0 => '',
    1 => 'deset',
    2 => 'dvadeset',
    3 => 'trideset',
    4 => 'četrdeset',
    5 => 'petdeset',
    6 => 'šezdeset',
    7 => 'sedamdeset',
    8 => 'osamdeset',
    9 => 'devetdeset',
];
$nizStotica = [
    0 => '',
    1 => 'stotinu',
    2 => 'dvijestotine',
    3 => 'tristotine',
    4 => 'četiristotine',
    5 => 'petstotina',
    6 => 'šeststotine',
    7 => 'sedamstotina',
    8 => 'osamstotina',
    9 => 'devetstotina',
];

$nizRijeci = [];

$broj = 467.29;
$decimal = explode('.', (string)$broj);
$decimal = $decimal[1] ?? 0;

$br = 1;
while($broj > 0) {
    $tmp = $broj % 10;
    if ($br == 1)
        $nizRijeci[] = $nizJedinica[$tmp];
   
    if ($br == 2)
        $nizRijeci[] = $nizDesetica[$tmp];

    if ($br == 3)
        $nizRijeci[] = $nizStotica[$tmp];

    $br++;
    $broj /= 10;
}

$rijec = implode('',array_reverse($nizRijeci)) . ' KM i ' . $decimal . '/100';
dd($rijec);