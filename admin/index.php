<?php
require_once '../config/config.php';
if (!session('userId'))
    redirect('admin/login');

__include('admin-header', ['title' => 'Home']);
?>
    <table class="table display dataTable mt-3" id="calculation">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Object</th>
            <th>Date</th>
            <th>Document</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
<?php __include('admin-footer'); ?>