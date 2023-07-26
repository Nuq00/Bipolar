<?php
include_once 'db3.php';
include_once 'session.php';
include_once 'head.php';

// Retrieve the selected booking date and session time from the form submission
$bookingDate = $_POST['booking_date'];
$sessionTime = $_POST['session_time'];
$userID = $_POST['clientMatric'];

try {
    // Adjust the database connection details as per your configuration

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the selected session time for the given date is available
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM booking WHERE fld_booking_date = :bookingDate AND fld_session_time = :sessionTime");
    $stmt->bindParam(':bookingDate', $bookingDate);
    $stmt->bindParam(':sessionTime', $sessionTime);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $bookingCount = $result['count'];

    if ($bookingCount >= 12) {
        echo '<script type="text/javascript">window.location.href = "booking_failed.php";</script>';
        exit;
    } else {
        if ($category == 'Client') {
            // Check if the user has already made a booking for the same date and time
            $checkStmt = $conn->prepare("SELECT COUNT(*) AS count FROM booking WHERE fld_user_ID = :uid AND fld_booking_date = :bookingDate AND fld_session_time = :sessionTime");
            $checkStmt->bindParam(':uid', $uid);
            $checkStmt->bindParam(':bookingDate', $bookingDate);
            $checkStmt->bindParam(':sessionTime', $sessionTime);
            $checkStmt->execute();
            $check = $checkStmt->fetch(PDO::FETCH_ASSOC);
            $bookingCount = $result['count'];

            if ($bookingCount > 0) {
                // Double booking detected, show an error message
                echo '<script type="text/javascript">alert("You have already made a booking for the same date and time");</script>';
                echo '<script type="text/javascript">window.location.href = "history.php";</script>';
                exit;
            } else {
                // No double booking, proceed with the booking insertion
                $stmt = $conn->prepare("INSERT INTO booking (fld_booking_ID, fld_user_ID, fld_staff_ID, fld_booking_date, fld_session_time, fld_booking_status, fld_booking_report) VALUES (:bookingID, :uid, :sid, :bookingDate, :sessionTime, :status, :report)");
                $stmt->bindParam(':bookingDate', $bookingDate);
                $stmt->bindParam(':sessionTime', $sessionTime);
                $stmt->bindParam(':bookingID', $bookingID);
                $stmt->bindParam(':uid', $uid);
                $stmt->bindParam(':sid', $sid);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':report', $report);

                $bookingID = uniqid('Booking_', true);
                $uid = $matricNumber;
                $status = 'Pending';
                $sid = 'None';
                $report = 'No report written yet';
                $stmt->execute();

                echo '<script type="text/javascript">window.location.href = "booking_success.php";</script>';
                exit;
            }
        } else {
            // Check if there is already a booking by the counselor for the same date and time
            $checkStmt = $conn->prepare("SELECT COUNT(*) FROM booking WHERE fld_staff_ID = :sid AND fld_booking_date = :bookingDate AND fld_session_time = :sessionTime");
            $checkStmt->bindParam(':sid', $sid);
            $checkStmt->bindParam(':bookingDate', $bookingDate);
            $checkStmt->bindParam(':sessionTime', $sessionTime);
            $checkStmt->execute();
            $check = $checkStmt->fetch(PDO::FETCH_ASSOC);
            $bookingCount = $result['count'];

            if ($bookingCount > 0) {
                // Double booking detected, show an error message
                echo '<script type="text/javascript">alert("You have already made a booking for the same date and time");</script>';
                echo '<script type="text/javascript">window.location.href = "history.php";</script>';
                exit;
            } else {
                // No double booking, proceed with the booking insertion
                $stmt = $conn->prepare("INSERT INTO booking (fld_booking_ID, fld_user_ID, fld_staff_ID, fld_booking_date, fld_session_time, fld_booking_status, fld_booking_report) VALUES (:bookingID, :uid, :sid, :bookingDate, :sessionTime, :status, :report)");
                $stmt->bindParam(':bookingDate', $bookingDate);
                $stmt->bindParam(':sessionTime', $sessionTime);
                $stmt->bindParam(':bookingID', $bookingID);
                $stmt->bindParam(':uid', $uid);
                $stmt->bindParam(':sid', $sid);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':report', $report);

                $bookingID = uniqid('Booking_', true);
                $uid = $userID;
                $status = 'Approved';
                $sid = $ID;
                $report = 'No report written yet';
                $stmt->execute();

                echo '<script type="text/javascript">window.location.href = "booking_success.php";</script>';
                exit;
            }
        }

        // Insert the booking details into the database

    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
