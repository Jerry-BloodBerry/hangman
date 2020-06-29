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
    public static function checkWordLetter($id, $letter)
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
            $word_array = explode(' ', $word);
            $word_counter = 0;
            $positions = array();
            foreach($word_array as $w)
            {
                $split_word = str_split($w);
                $j=0;
                foreach ($split_word as $char)
                {
                    if($char==$letter)
                    {
                        $positions [] = [
                            'word' => $word_counter,
                            'index' =>$j
                        ];
                    }
                    $j++;
                }
                $word_counter++;
            }
            echo json_encode(array("contains" => true, "positions" => $positions));
        }
        else
        {
            echo json_encode(array("contains" => false));
        }
    }

    /**
     * @param int $user_id user id
     * @param int $word_id word id
     * @param int $score user score
     */
    public static function saveUserScore($user_id, $word_id, $score)
    {
        $database = new Database();
        $db = $database->getConnection();

        $query = "INSERT INTO user_scores SET user_id=:u_id, score=:score, word_id=:w_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":u_id", $user_id);
        $stmt->bindParam(":score", $score);
        $stmt->bindParam("w_id", $word_id);

        if($stmt->execute())
        {
            echo json_encode(array("success" => true));
        }
    }

    public static function fetchWordLeaderboard($word_id)
    {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT login, MAX(score) AS top_score FROM user_scores INNER JOIN user ON user_id=user.id WHERE word_id=? GROUP BY user_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$word_id);

        $stmt->execute();

        $scores = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $scores [] = [
                $row['login'] => $row['top_score']
            ];
        }
        echo json_encode(array('scores' => $scores));
    }
}