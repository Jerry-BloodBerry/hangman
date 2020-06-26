<?php
include_once __DIR__ . '/../config/Database.php';

class GameLogic
{
    public static function fetchNewWord()
    {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT id, word FROM words";
        $stmt = $db->prepare($query);

        $stmt->execute();

        $ids = array();
        $words = array();
        $i = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $ids[$i] = $row['id'];
            $words[$i] = $row['word'];
            $i++;
        }
        $random_index = rand(0,count($ids)-1);
        $random_word_id = $ids[$random_index];

        $word = $words[$random_index];
        $words = explode(' ', $word);
        $num_of_words = sizeof($words);

        $sizes = [];
        foreach ($words as $w)
        {
            $sizes [] = strlen($w);
        }
        echo json_encode(array("word_id" => $random_word_id, "word_count" => $num_of_words, "sizes" => $sizes));
    }

    /**
     * @param int $id id of the word in which we are looking for the letter
     * @param string $letter the letter entered by the user which we are checking against
     */
    public static function checkWordLetter(int $id, string $letter)
    {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT word FROM words WHERE id=?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $word = strtolower($row['word']);
        $letter = strtolower($letter);

        if (strpos($word, $letter) !== false) {
            echo json_encode(array("contains" => true));
        }
        else
        {
            echo json_encode(array("contains" => false));
        }
    }
}