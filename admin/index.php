<?php
require_once '../config/config.php';

if (session('userId') === null)
    redirect('admin/login');

__include('admin-header', ['title' => 'Home']);
?>
    <table class="table display dataTable mt-3" id="calculation">
        <thead>
        <tr>
            <th>#</th>
            <th>Naziv</th>
            <th>Objekat</th>
            <th>Datum</th>
            <th>Dokument</th>
            <th>Akcija</th>
        </tr>
        </thead>
    </table>
<?php __include('admin-footer'); ?>