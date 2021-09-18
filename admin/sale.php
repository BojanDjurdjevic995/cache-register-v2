<?php
require_once '../config/config.php';

if (session('userId') === null)
    redirect('admin/login');

__include('admin-header', ['title' => 'Продаја']);
?>
    <table class="table display dataTable mt-3" id="sale">
        <thead>
        <tr>
            <th>#</th>
            <th>Kupac</th>
            <th>PIB</th>
            <th>JIB</th>
            <th>Faktura</th>
            <th>Mjesto dostave</th>
            <th>Akcija</th>
        </tr>
        </thead>
    </table>
<?php __include('admin-footer'); ?>