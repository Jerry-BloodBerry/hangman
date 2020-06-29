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
            <h2>Register</h2>
            <form action="/handle_register" method="post">
                <?php
                if(isset($_SESSION['message']))
                {
                    echo '
                            <div class="alert alert-danger" role="alert">' .
                        $_SESSION['message'] .
                        '</div>
                        ';
                    unset($_SESSION['message']);
                }
                ?>
                <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" name="username" class="form-control" id="inputUsername" required>
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" required minlength="8">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../templates/footer/footer.php';
?>

