<?php
session_start();
if(isset($_SESSION['username']))
{
    header("Location: /");
}
include_once __DIR__ . '/../templates/header/header.php';
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 login-field">
            <h2>Login</h2>
            <form action="/handle_login" method="post">
                <?php
                    if(isset($_SESSION['message']))
                    {
                        if($_SESSION['message']=='1')
                        {
                            echo '
                                <div class="alert alert-success" role="alert">' .
                                'Registration successful. Please login to your account' .
                                '</div>
                            ';
                        }
                        else
                        {
                            echo '
                                <div class="alert alert-danger" role="alert">' .
                                  $_SESSION['message'] .
                                '</div>
                            ';
                        }
                        unset($_SESSION['message']);
                    }
                ?>
                <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" name="username" class="form-control" id="inputUsername">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
                <p class="text-center">If you don't have an account please <a href="/register">Register</a></p>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../templates/footer/footer.php';
?>

