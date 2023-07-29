<?php
include_once 'db3.php';
include_once 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($category == 'Client') {
    echo '<script type="text/javascript">window.location.href = "restricted.php";</script>';
    exit;
}

if (isset($_POST['add-session'])) {
    // Update staff record
    try {
        $bookID = $_POST['book_id'];

        $stmt = $conn->prepare("UPDATE booking SET fld_booking_status = 'Approved',fld_staff_ID='$ID'  WHERE fld_booking_ID = '$bookID'");
        $stmt->execute();


        $stmt2 = $conn->prepare("SELECT * FROM user_data LEFT JOIN booking ON booking.fld_user_ID = user_data.fld_userID WHERE booking.fld_booking_ID = '$bookID'");
        $stmt2->execute();
        $useridemail = $stmt2->fetchAll();

        $stmt3 = $conn->prepare("SELECT * FROM booking WHERE fld_booking_ID = '$bookID'");
        $stmt3->execute();
        $bookingDetail = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'numanbasyir4@gmail.com';
        $mail->Password = 'rfavrhcimkpuugpr';
        $mail->SMTPSecure = 'tsl';
        $mail->Port = 587;

        $mail->setFrom('numanbasyir4@gmail.com', "Sistem Pengecaman Gejala Gangguan Bipolar");
        $mail->addAddress($useridemail[0]['fld_email']);

        $mail->Subject = 'Status of Appointment';

        $mail->Body = "Dear " . $useridemail[0]['fld_username'] . ",<br><br>"
            . "We are pleased to inform you that your appointment on " . $bookingDetail[0]['fld_booking_date'] . " at " . $bookingDetail[0]['fld_session_time'] . " has been approved by the counsellor.<br><br>"
            . "To ensure a smooth session, we kindly request that you follow the time and date regulations mentioned below:<br>"
            . "- Please arrive at least 10 minutes before the scheduled appointment.<br>"
            . "- Bring any necessary documents or materials for the session.<br>"
            . "- Be prepared with specific questions or topics you would like to discuss.<br>"
            . "- If you need to cancel or reschedule, please inform us at least 24 hours in advance.<br><br>"
            . "If you have any further questions or need assistance, please feel free to contact us.<br><br>"
            . "We look forward to seeing you at your scheduled appointment.<br><br>"
            . "Best regards,<br>"
            . $name . "<br>"
            . $category . "<br>"
            . "UKM Counselling";


        $mail->AltBody = "Dear " . $useridemail[0]['fld_username'] . ",<br><br>"
            . "We are pleased to inform you that your appointment on " . $bookingDetail[0]['fld_booking_date'] . " at " . $bookingDetail[0]['fld_session_time'] . " has been approved by the counsellor.<br><br>"
            . "To ensure a smooth session, we kindly request that you follow the time and date regulations mentioned below:<br>"
            . "- Please arrive at least 10 minutes before the scheduled appointment.<br>"
            . "- Bring any necessary documents or materials for the session.<br>"
            . "- Be prepared with specific questions or topics you would like to discuss.<br>"
            . "- If you need to cancel or reschedule, please inform us at least 24 hours in advance.<br><br>"
            . "If you have any further questions or need assistance, please feel free to contact us.<br><br>"
            . "We look forward to seeing you at your scheduled appointment.<br><br>"
            . "Best regards,<br>"
            . $name . "<br>"
            . $category . "<br>"
            . "UKM Counselling";

        $mail->send();

        // Redirect to the same page after successful update
        echo '<script type="text/javascript">window.location.href = "booking_list.php";</script>';
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} ?>

<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
    <style>
        /* Keyframes for fade-in animation s*/
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Apply animation to cards */
        .container {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <?php
    try {
        // create connection with database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // fetch data from the table question_list



        $stmt2 = $conn->prepare("SELECT * FROM user_data LEFT JOIN booking ON user_data.fld_userID = booking.fld_user_ID WHERE booking.fld_booking_status = 'Pending'");
        $stmt2->execute();
        $bookingSession = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        //fetch data from the anwer_list
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <h1 class="mt-3 mb-1 text-center">Available Booking Session</h1>
            <div class="my-5 shadow-4 rounded-3 py-3" style="background-color:white;">
                <table id="bokingSession" class="table table-striped table-bordered py-2">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>


                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($bookingSession as $book) {
                            $date = $book['fld_booking_date'];
                            $newDate = date("l, j F , Y", strtotime($date));
                            $time = $book['fld_session_time'];
                            $newTime = date("h:i A", strtotime($time)); ?>
                            <tr>
                                <td><?php echo $book['fld_booking_ID'] ?></td>
                                <td><?php echo $book['fld_user_ID'] ?></td>
                                <td><?php echo $book['fld_username'] ?></td>
                                <td><?php echo $newDate ?></td>
                                <td><?php echo $newTime ?></td>
                                <td class="text-center">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="book_id" value="<?php echo $book['fld_booking_ID']; ?>">
                                        <button class="btn btn-sm btn-success" name="add-session">+ Take Session</button>
                                    </form>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bokingSession').DataTable();
        });
    </script>
    <?php include_once 'script.php'; ?>

</body>

</html>