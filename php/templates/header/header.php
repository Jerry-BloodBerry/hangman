<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hangman Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="SHORTCUT ICON" type="image/x-icon" href="/img/hangman.ico">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="/img/hangman36.png" width="36" height="36" class="d-inline-block align-top" alt="" loading="lazy">
        The Hangman
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
        </ul>
        <span class="navbar-text">
            <?php
                if(isset($_SESSION['username']))
                {
                    echo '
                    <a href="#" class="login-border">' .
                        $_SESSION['username'] .
                    '</a>
                    <a href="/logout">Logout</a>';
                }
                else
                {
                    echo '
                    <a href="/login" class="login-border">
                        Login
                    </a>
                    <a href="/register" style="padding-left: 10px;">
                        Register
                    </a>
                    ';
                }
            ?>
        </span>
    </div>
</nav>