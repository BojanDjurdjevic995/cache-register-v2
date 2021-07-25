<?php
    use App\Models\User;

    $user = User::whereId(session('userId'))->first();
    $page = explode('/', $_SERVER['SCRIPT_NAME']);
    $page = explode('.', end($page))[0];
    $username = $user->name ?? '';
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="page" content="<?= $page ?>">
    <?= csrf_meta(); ?>

    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" href="<?= asset('css/bootstrap-datatabkes-jqueryconfirm-fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css'); ?>">
</head>
<body>
<?php
if (session('success')) {
    echo '<div id="alertForSuccess" class="alert alert-success">'.session('success').'</div>';
    session(0,0,'success');
}
if (session('error')) {
    echo '<div id="alertForSuccess" class="alert alert-danger">'.session('error').'</div>';
    session(0,0,'error');
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand ml-5" href="<?= asset('admin'); ?>">Admin panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if ($user) { ?>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown <?= in_array($page, ['add-calc', 'index']) ? 'active' : '' ?>">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Kalkulacija</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item <?= $page == 'add-calc' ? 'active' : '' ?>" href="<?= asset('admin/add-calc.php') ?>">Dodaj</a>
                    <a class="dropdown-item <?= $page == 'index' ? 'active' : '' ?>" href="<?= asset('admin') ?>">Prikaži sve</a>
                </div>
            </li>
            <li class="nav-item dropdown <?= in_array($page, ['add-sale', 'sale']) ? 'active' : '' ?>">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Zbirna faktura</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item <?= $page == 'add-sale' ? 'active' : '' ?>" href="<?= asset('admin/add-sale.php') ?>">Dodaj</a>
                    <a class="dropdown-item <?= $page == 'sale' ? 'active' : '' ?>" href="<?= asset('admin/sale.php') ?>">Prikaži sve</a>
                </div>
            </li>
            <li class="nav-item dropdown <?= in_array($page, ['lager']) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= asset('admin/lager.php') ?>">Lager</a>
            </li>
        </ul>
        <?php } ?>

        <ul class="navbar-nav ml-auto mr-5">
            <?php if (session('userId')) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= $username ?></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= asset('admin/logout.php') ?>">Logout</a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>
<div class="container <?= $page == 'login' ? 'loginPageContainer' : '' ?>">