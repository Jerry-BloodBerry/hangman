<?php
include_once __DIR__ . '/Database.php';

$database = new Database();
$db = $database->getConnection();

$query = "TRUNCATE TABLE words";
$stmt = $db->prepare($query);
$stmt->execute();

$words_array = [];
$i = 0;
$file_handle = fopen(__DIR__ . "/../../data/words.txt", "r");
if ($file_handle) {
    while (($line = fgets($file_handle)) !== false) {
        $words_array [$i] = ['word' => trim($line)];
        $i++;
    }
    fclose($file_handle);
} else {
    throw new Exception("Error while opening the words file!");
}

$query = "INSERT INTO words (word) VALUES(:w)";
$stmt = $db->prepare($query);

foreach ($words_array as $word)
{
    $stmt->bindValue(':w',$word['word']);
    $stmt->execute();
}
echo 'Database loaded successfully';

