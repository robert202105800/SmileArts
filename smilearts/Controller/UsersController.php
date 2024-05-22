<?php

require_once '../models/users.php';

class LoginController {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function loginUser($username, $password) {
        
        $username = mysqli_real_escape_string($this->connection, $username);

        
        $query = "SELECT * FROM users WHERE name = '$username' LIMIT 1";
        $result = mysqli_query($this->connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

          
            if (password_verify($password, $row['password'])) {
                
                $user = new User($row['id'], $row['name'], $row['email'], $row['password'], $row['userType']);

                // Start a session and store user information
                session_start();
                $_SESSION['user'] = $user;

                return true;
            }
        }

        // Login failed
        return false;
    }
}