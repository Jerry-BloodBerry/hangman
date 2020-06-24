<?php
include_once __DIR__ . '/../config/Database.php';

class Register
{
    public static function registerUser($username, $password)
    {
        $database = new Database();
        $db = $database->getConnection();

        // sanitize username
        $username = htmlspecialchars(strip_tags($username));

        $query = "SELECT * FROM user WHERE login=?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$username);

        $stmt->execute();
        if($stmt->rowCount()>0)
        {
            return false;
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO user SET login=:login, hash=:hash";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':login', $username);
        $stmt->bindParam(':hash', $hash);

        if($stmt->execute())
            return true;
        else
            throw new Exception('Cannot create user. Connection error.');
    }
}