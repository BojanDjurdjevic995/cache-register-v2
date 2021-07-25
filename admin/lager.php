<?php
require_once '../config/config.php';

if (session('userId') === null)
    redirect('admin/login');

__include('admin-header', ['title' => 'Lager']);
?>
    <div class="alert alert-success">Lager lista</div>
<?php __include('admin-footer'); ?>