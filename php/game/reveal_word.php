<?php
include_once __DIR__ . '/../game/GameLogic.php';

$word_id = $_POST['word_id'];
GameLogic::revealWord($word_id);