<?php
require_once '../config/config.php';

if (session('userId') === null)
    redirect('admin/login');

__include('admin-header', ['title' => 'Sale']);
?>
    <table class="table display dataTable mt-3" id="sale">
        <thead>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>PIB</th>
            <th>JIB</th>
            <th>Invoice</th>
            <th>Delivery place</th>
        </tr>
        </thead>
    </table>
<?php __include('admin-footer'); ?>