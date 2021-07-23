<?php
require_once '../config/config.php';
use App\Controllers\Request;
use App\Models\User;

if (session('userId') !== null)
    redirect('admin/index');
__include('admin-header', ['title' => 'Login', 'page' => 'login']);
if (request()->isMethod('POST')) {
    $request    = new Request();
    $email      = strip_tags($request->email);
    $password   = strip_tags($request->password);
    session('email_val', $email);
    $user = User::where('email', $email)->first();

    if (!empty($user)) {
        if (password_verify($request->password, $user->password)) {
            session('userId', $user->id);
            session(0,0,'email_val');
            session(0,0,'error');
            redirect('admin/index');
        }
        else
            session('error', 'These credentials do not match our records.');
    } else
        session('error', 'The user does not exists in our database');
    redirect('admin/login');
}
?>
    <div class="card mt-5 p-4" style="width: 40rem;">
        <form action="" method="POST">
            <?php
            if (session('error'))
            {
                echo '<div class="alert alert-danger">'.session('error').'</div>';
                session(0,0,'error');
            }
            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?= session('email_val'); ?>" autofocus>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
<?php __include('admin-footer'); ?>