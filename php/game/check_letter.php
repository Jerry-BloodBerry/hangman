<?php
include_once __DIR__ . '/../game/GameLogic.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id = $_POST['id'];
$letter = $_POST['letter'];
GameLogic::checkWordLetter($id, $letter);