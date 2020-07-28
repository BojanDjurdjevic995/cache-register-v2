<?php
require_once '../config/config.php';
if (Session::exists('userId'))
    Redirect::to('admin/index');
__include('admin-header', ['title' => 'Register', 'page' => 'register']);

if (Request::isMethod('POST')) {
    $date    = new Date();
    $request =  new Request();
    Session::set('name_val', strip_tags($request->name));
    Session::set('email_val', strip_tags($request->email));
    if (strlen($request->name) > 0 && strlen($request->email) > 0) {
        $name               = strip_tags($request->name);
        $email              = strip_tags($request->email);
        $password           = strip_tags($request->password);
        $confirm_password   = strip_tags($request->confirm_password);
        if (empty(User::where('email', $email)->first())) {
            if ($password === $confirm_password && strlen($password) >= 8 && strlen($confirm_password) >= 8) {
                $user               = new User();
                $user->name         = $name;
                $user->email        = $email;
                $user->password     = password_hash($password, PASSWORD_BCRYPT);
                $user->created_at   = $date->createdAt();
                $user->updated_at   = $date->createdAt();
                $user->save();
                $user = User::orderBy()->first();
                Session::set('userId', $user->id);
                Session::destroy('name_val');
                Session::destroy('email_val');
                Session::destroy('error');
                Redirect::to('admin/login');
            } else {
                Session::set('error', 'Passwords must be at least eight characters and match the confirmation.');
                Redirect::to('admin/register');
            }
        } else {
            Session::set('error', 'This email already exists in the database');
            Redirect::to('admin/register');
        }
    } else {
        Session::set('error', 'Please enter all fields');
        Redirect::to('admin/register');
    }
}
?>

    <div class="card mt-5 p-4" style="width: 40rem;">
        <?php
        if (Session::exists('error'))
        {
            echo '<div class="alert alert-danger">'.Session::get('error').'</div>';
            Session::destroy('error');
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" placeholder="Enter name" name="name" value="<?= Session::exists('name_val') ? Session::get('name_val') : '' ?>" autofocus>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?= Session::exists('email_val') ? Session::get('email_val') : '' ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
<?php __include('footer'); ?>