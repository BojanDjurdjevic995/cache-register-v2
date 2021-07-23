<?php
require_once './config/config.php';
use App\Models\User;

__include('header', ['title' => 'Home']);
dd(User::all());
?>

<?php
__include('footer');
