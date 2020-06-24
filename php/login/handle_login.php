<?php
session_start();
include_once __DIR__ . '/../security/Login.php';

if(empty($_POST['username']) || empty($_POST['password']))
{
    $_SESSION['message'] = 'Missing login or password';
    header("Location: login");
    exit();
}
$username = $_POST['username'];
$password = $_POST['password'];

if(Login::loginUser($username,$password))
{
    header("Location: /");
    exit();
}
else
{
    $_SESSION['message'] = 'Invalid login or password';
    header("Location: login");
}