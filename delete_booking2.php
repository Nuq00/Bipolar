<?php
include_once 'db3.php';
include_once 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingID'])) {
    $bookingID = $_POST['bookingID'];
    if ($category != "Client") {
        try {

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt3 = $conn->prepare("SELECT * FROM booking WHERE fld_booking_ID = :bookingID");
            $stmt3->bindParam(':bookingID', $bookingID);
            $stmt3->execute();
            $bookingDetail = $stmt3->fetch(PDO::FETCH_ASSOC);

            // Fetch user and booking details for email
            $stmt2 = $conn->prepare("SELECT * FROM user_data LEFT JOIN booking ON booking.fld_user_ID = user_data.fld_userID WHERE booking.fld_booking_ID = :bookingID");
            $stmt2->bindParam(':bookingID', $bookingID);
            $stmt2->execute();
            $useridemail = $stmt2->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchAll since you expect a single row

            // Send email notification
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'numanbasyir4@gmail.com';
            $mail->Password = 'rfavrhcimkpuugpr';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('numanbasyir4@gmail.com', "Bipolar Disorder Detection System");
            $mail->addAddress($useridemail['fld_email']); // Access the email directly from the array

            $mail->Subject = 'Status of Appointment';

            $mail->Body = "Dear " . $useridemail['fld_username'] . ",<br><br>"
                . "We would like to inform you that your appointment on " . $bookingDetail['fld_booking_date'] . " at " . $bookingDetail['fld_session_time'] . " has been cancelled by the counsellor.<br><br>"
                . "Now the status of the appointment has been changed to pending. If you have any further questions or need assistance, please feel free to contact us.<br><br>"
                . "Thank you for your understanding.<br><br>"
                . "Best regards,<br>"
                . $name . "<br>"
                . $category . "<br>"
                . "UKM Counselling";

            $mail->AltBody = "Dear " . $useridemail['fld_username'] . ",\n\n"
                . "We would like to inform you that your appointment on " . $bookingDetail['fld_booking_date'] . " at " . $bookingDetail['fld_session_time'] . " has been cancelled by the counsellor.\n\n"
                . "Now the status of the appointment has been changed to pending. If you have any further questions or need assistance, please feel free to contact us.\n\n"
                . "Thank you for your understanding.\n\n"
                . "Best regards,\n"
                . $name . "\n"
                . $category . "\n"
                . "UKM Counselling";

            $mail->send();

            $stmt = $conn->prepare("DELETE FROM booking WHERE fld_booking_ID = :bookingID");
            $stmt->bindParam(':bookingID', $bookingID);
            $stmt->execute();
            
            echo 'success';
        } catch (PDOException $e) {
            echo 'error: ' . $e->getMessage();
        }
    } else {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM booking WHERE fld_booking_ID = :bookingID");
            $stmt->bindParam(':bookingID', $bookingID);
            $stmt->execute();

            echo 'success';
        } catch (PDOException $e) {
            echo 'error: ' . $e->getMessage();
        }
    }
} else {
    echo 'error: Invalid request';
}
