<?php
include_once __DIR__ . '/../game/GameLogic.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$u_id = $_SESSION['user_id'];
$word_id = $_POST['word_id'];
$score = $_POST['score'];

GameLogic::saveUserScore($u_id, $word_id, $score);