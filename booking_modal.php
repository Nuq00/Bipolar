<?php
include_once 'db3.php';
include_once 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingID'])) {
    $bookingID = $_POST['bookingID'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM booking WHERE fld_booking_ID = :bookingID");
        $stmt->bindParam(':bookingID', $bookingID);
        $stmt->execute();
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        $bookingID = $booking['fld_booking_ID'];

        echo '<h5>Booking ID: ' . $booking['fld_booking_ID'] . '</h5>';
        echo '<p>Booking Date: ' . $booking['fld_booking_date'] . '</p>';
        echo '<p>Booking Time: ' . $booking['fld_session_time'] . '</p>';
        echo '<h5>Report:</h5>';
        echo '<p>' . $booking['fld_booking_report'] . '</p>';

        if ($category != 'Client') {
            if ($booking['fld_booking_status'] == "Done") {

                echo '
            <form method="post" action="process_report.php">
                <input type="hidden" name="bookingID" value="' . $bookingID . '">
                
                <div class="form-group">
                    <label for="report" class="form-label">New Report</label>
                    <textarea id="report" name="report" class="form-control mb-2" placeholder="Enter the report"></textarea>
                </div>
                <button class="btn btn-success add-report" type="submit">Add Report</button>
            </form>';
            }
            if ($booking['fld_booking_status'] != "Done") {
                echo '<form method="post" action="process_report.php">
                <input type="hidden" name="bookingID" value="' . $bookingID . '">
                <button class="btn btn-info" type="submit">Mark as done</button>
                </form>';
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>