<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Europe/Sarajevo');
ob_start();
session_start();
define("ROOT_PATH", substr(__DIR__, 0, -6));
require_once ROOT_PATH . 'vendor/autoload.php';