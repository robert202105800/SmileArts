<?php
require 'vendor/autoload.php'; // Include Composer's autoloader for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create connection
include("../include/header.php");
include("../include/connection.php");

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Get the date two days from now
$two_days_later = date('Y-m-d', strtotime('+2 days'));

// Query to find appointments 2 days from now that have not been sent a reminder
$sql = "SELECT a.id, a.firstname, a.surname, a.appointment_date, p.email 
        FROM appointment a 
        JOIN patient p ON a.phone = p.phone 
        WHERE DATE(a.appointment_date) = '$two_days_later' 
        AND a.reminder_sent = FALSE";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'smilearts7@gmail.com'; // SMTP username
            $mail->Password = 'Miu_122333'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('smilearts7@gmail.com', 'Dental Health Care');
            $mail->addAddress($row['email'], $row['firstname'] . ' ' . $row['surname']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Appointment Reminder';
            $mail->Body    = 'Dear ' . $row['firstname'] . ' ' . $row['surname'] . ',<br><br>This is a reminder for your upcoming appointment on ' . date('Y-m-d H:i', strtotime($row['appointment_date'])) . '.<br><br>Thank you,<br>Dental Health Care';

            $mail->send();

            // Update the reminder_sent flag
            $update_sql = "UPDATE appointment SET reminder_sent = TRUE WHERE id = " . $row['id'];
            $connect->query($update_sql);
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
} else {
    echo "No reminders to send.";
}

$connect->close();
?>
