<?php
include_once __DIR__ . '/../game/GameLogic.php';

$word_id = $_POST['id'];
GameLogic::fetchWordLeaderboard($word_id);