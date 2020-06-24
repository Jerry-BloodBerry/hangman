<?php
$url = trim($_SERVER['REQUEST_URI'], '/');

/**
 * Route params array
 * @var string[]
 */
$routeParams = explode('/', $url);
if($routeParams === false) $routeParams = [];

$requestedScript = array_shift($routeParams);


$resources = [
  'login' => '/../php/login/login.php',
  'handle_login' => '../php/login/handle_login.php',
  'register' => '../php/register/register.php',
  'handle_register' => '../php/register/handle_register.php',
  'logout' => '../php/logout/logout.php'
];

foreach ($resources as $name => $path) {
  if($requestedScript === $name) {
        include_once __DIR__ . '/' . $path;
        exit();
  }
}

exit(json_encode(["message" => "Incorrect request - /{$url} not found"]));
