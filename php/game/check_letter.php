<?php
include_once __DIR__ . '/../game/GameLogic.php';

$id = $_POST['id'];
$letter = $_POST['letter'];
GameLogic::checkWordLetter($id, $letter);