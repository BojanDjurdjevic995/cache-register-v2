<?php
require_once '../config/config.php';
session(0,0,'userId');
redirect('admin/login');