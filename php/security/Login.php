<?php
include_once __DIR__ . '/../config/Database.php';

class Login
{
    public static function loginUser($username, $password)
    {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT * FROM user WHERE login=?";
        $stmt = $db->prepare($query);

        //sanitize the string
        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(1,$username);

        if($stmt->execute())
        {
            if($stmt->rowCount()==1)
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if(password_verify($password,$row['hash'])) {
                    $_SESSION['username'] = $row['login'];
                    $_SESSION['user_id'] = $row['id'];
                    return true;
                }
                return false;
            }
            else
            {
                return false;
            }
        }
        else
        {
            throw new Exception('Cannot validate user credentials. Connection error.');
        }
    }
}