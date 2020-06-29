<?php
session_start();
include_once __DIR__ . '/../security/Register.php';

if(empty($_POST['username']) || empty($_POST['password']))
{
    $_SESSION['message'] = 'Missing login or password';
    header("Location: register");
    exit();
}
$username = htmlspecialchars(strip_tags($_POST['username']));
$password = htmlspecialchars(strip_tags($_POST['password']));

if(Register::registerUser($username,$password))
{
    $_SESSION['message'] = '1';
    header("Location: login");
    exit();
}
else
{
    $_SESSION['message'] = 'Username already taken. Please choose another one.';
    header("Location: register");
}