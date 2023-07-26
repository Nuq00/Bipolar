<?php
// process_report.php
include_once 'db3.php';
include_once 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingID']) && isset($_POST['report'])) {
    $bookingID = $_POST['bookingID'];
    $report = $_POST['report'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE booking SET fld_booking_report = :report WHERE fld_booking_ID = :bookingID");
        $stmt->bindParam(':report', $report);
        $stmt->bindParam(':bookingID', $bookingID);
        $stmt->execute();
        echo '<script type="text/javascript">alert("Report added successfully");</script>';
        echo "<script type='text/javascript'>window.location.href = 'history.php';</script>";
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingID'])) {
    $bookingID = $_POST['bookingID'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT fld_booking_date FROM booking WHERE fld_booking_ID = :bookingID");
        $stmt->bindParam(':bookingID', $bookingID);
        $stmt->execute();
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        $bookingDate = $booking['fld_booking_date'];

        $today = date('Y-m-d');

        if ($today >= $bookingDate) {
            $updateStmt = $conn->prepare("UPDATE booking SET fld_booking_status = 'Done' WHERE fld_booking_ID = :bookingID");
            $updateStmt->bindParam(':bookingID', $bookingID);
            $updateStmt->execute();

            echo '<script type="text/javascript">alert("Appointment marked as Done successfully");</script>';
            echo "<script type='text/javascript'>window.location.href = 'history.php';</script>";
            exit;
        } else {
            echo '<script type="text/javascript">alert("The appointment has not yet occurred.");</script>';
            echo "<script type='text/javascript'>window.location.href = 'history.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<html lang="en">

<head><?php
        include_once 'head.php';
        ?>
</head>

<body>
    <div></div>
</body>

</html>