<?php
include_once __DIR__ . '/../game/GameLogic.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['user_score'] = 120;
$_SESSION['hang_count'] = 0;

GameLogic::fetchNewWord();