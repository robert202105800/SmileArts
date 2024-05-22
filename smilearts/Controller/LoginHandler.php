<?php

require_once 'UsersController.php'; // Assuming the LoginController class is defined in LoginController.php

// Assuming you have a database connection established
$connection = mysqli_connect("localhost", "root", "", "hms2");

// Create an instance of the LoginController
$loginController = new LoginController($connection);

// Handle the login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($loginController->loginUser($username, $password)) {
        // Login successful, redirect to the appropriate page based on user type
        session_start();
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $userType = $user->getUserType();
            switch ($userType) {
                case 'doctor':
                    header("Location: doctor.php");
                    break;
                case 'patient':
                    header("Location: patient.php");
                    break;
                case 'admin':
                    header("Location: admin.php");
                    break;
                default:
                    // Invalid user type
                    echo "Invalid user type.";
                    break;
            }
            exit();
        }
    } else {
        // Login failed, display an error message
        echo "Invalid credentials";
    }
}