<?php
include_once 'db3.php';
include_once 'session.php';
?>

<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <?php
    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //this is for user
        if ($category == 'Client') {
            $stmt = $conn->prepare("SELECT * FROM booking INNER JOIN user_data ON user_data.fld_userID = booking.fld_user_ID AND booking.fld_user_ID='$ID'");

            // Check if the selected session time for the given date is available
            // $stmt = $conn->prepare("SELECT * FROM booking WHERE fld_user_ID='$ID'");
            $stmt->execute();
            $booking = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            $stmt2 = $conn->prepare("SELECT * FROM booking INNER JOIN user_data ON user_data.fld_userID = booking.fld_staff_ID AND booking.fld_staff_ID='$ID'");

            // Check if the selected session time for the given date is available
            // $stmt = $conn->prepare("SELECT * FROM booking WHERE fld_user_ID='$ID'");
            $stmt2->execute();
            $book = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <?php include_once 'navbar.php'; ?>
    <div class="container-fluid">
        <!-- Button trigger modal -->
        <!-- Button trigger modal -->

        <h1 class="text-center mt-5">Counselling History</h1>
        <p class="text-center">The History will only display in between 30 days abu.</p>
        <?php
        if ($category == 'Client') {
            $currentDate = date('Y-m-d');
            foreach ($booking as $bookings) {
                $date = $bookings['fld_booking_date'];
                $formattedDate = date("l, j F , Y", strtotime($date));
                $time = $bookings['fld_session_time'];
                $formattedTime = date("h:i A", strtotime($time));
                $staffid = $bookings['fld_staff_ID'];
                $stmtstaff = $conn->prepare("SELECT fld_username FROM user_data WHERE fld_userID='$staffid'");
                $stmtstaff->execute();
                $staff = $stmtstaff->fetch();

                $currentTimestamp = strtotime($currentDate);
                $bookingTimestamp = strtotime($date);
                $secondsDiff = $bookingTimestamp - $currentTimestamp;
                $daysDiff = abs(floor($secondsDiff / (60 * 60 * 24)));

                if ($daysDiff <= 31) { ?>
                    <div class="justify-content-center text-center d-flex justify-content-center">
                        <div class="row col-lg-10 bg-dark mt-4 mb-3 text-light g-0 rounded-8 d-flex shadow-6-strong ">
                            <div class="col-lg-3 jusitfy-content-center text-center mx-3 ps-4 py-3 d-flex align-item-center align-items-center">
                                <h1><?php echo $formattedDate ?></h1>
                            </div>
                            <hr class="vr text-light vr-blurry my-4 ps-n1 ">
                            <div class="col-lg-6 px-4 my-3 ">
                                <div class="">
                                    <h2 class="text-uppercase">
                                        Bilik Kaunseling
                                    </h2>
                                    <h3 class="text-uppercase">
                                        <?php echo $formattedTime ?>
                                    </h3>
                                    <?php
                                    if ($bookings['fld_booking_status'] == 'Pending') {
                                        echo '<h6 class="text-uppercase">Status:&nbsp;&nbsp;&nbsp;<span class="badge badge-secondary">' . $bookings["fld_booking_status"] . '</span></h6>';
                                        echo '<h6 class="text-uppercase">Counsellor:&nbsp;&nbsp;&nbsp;<span class="badge badge-secondary">None</span></h6>';
                                    } elseif ($bookings['fld_booking_status'] == 'Approved' || $bookings['fld_booking_status'] == 'Done') {
                                        echo '<h6 class="text-uppercase">Status:&nbsp;&nbsp;&nbsp;<span class="badge bg-success">' . $bookings["fld_booking_status"] . '</span></h6>';
                                        echo '<h6 class="text-uppercase">Counsellor:&nbsp;&nbsp;&nbsp;' . $staff['fld_username'] . '</h6>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <hr class="vr text-light vr-blurry my-4 ps-n1 text-center">

                            <div class="col-lg-2 jusitfy-content-center text-center mx-3 ps-4 d-flex align-item-center align-items-center">
                                <button type="button" class="btn btn-primary rounded-6 shadow-5-strong detail-btn" data-toggle="modal" data-target="#bookingModal" data-booking-id="<?php echo $bookings['fld_booking_ID']; ?>">Detail</button>
                                <button class="ms-2 btn btn-danger rounded-6 shadow-5-strong delete-booking" data-booking-id="<?php echo $bookings['fld_booking_ID']; ?>">Delete</button>
                            </div>

                        </div>
                    </div>
                <?php }
                ?>
                <?php
            }
        } else {
            $currentDate = date('Y-m-d');
            foreach ($book as $books) {
                $date = $books['fld_booking_date'];
                $formattedDate = date("l, j F , Y", strtotime($date));
                $time = $books['fld_session_time'];
                $formattedTime = date("h:i A", strtotime($time));
                $userid = $books['fld_user_ID'];
                $stmtuser = $conn->prepare("SELECT fld_username FROM user_data WHERE fld_userID='$userid'");
                $stmtuser->execute();
                $user = $stmtuser->fetch();

                $currentTimestamp = strtotime($currentDate);
                $bookingTimestamp = strtotime($date);
                $secondsDiff = $bookingTimestamp - $currentTimestamp;
                $daysDiff = abs(floor($secondsDiff / (60 * 60 * 24)));

                if ($daysDiff <= 31) { ?>
                    <div class="justify-content-center text-center d-flex justify-content-center">
                        <div class="row col-lg-10 bg-dark mt-4 mb-3 text-light g-0 rounded-8 d-flex shadow-6-strong">
                            <div class="col-lg-3 jusitfy-content-center text-center mx-3 ps-4 py-3 d-flex align-item-center align-items-center">
                                <h1><?php echo $formattedDate ?></h1>
                            </div>
                            <hr class="vr text-light vr-blurry my-4 ps-n1 ">
                            <div class="col-lg-6 px-4 my-3 ">
                                <div class="">
                                    <h2 class="text-uppercase">
                                        Bilik Kaunseling
                                    </h2>
                                    <h3 class="text-uppercase">
                                        <?php echo $formattedTime ?>
                                    </h3>
                                    <?php
                                    if ($books['fld_booking_status'] == 'Pending') {
                                        echo '<h6 class="text-uppercase">Status:&nbsp;&nbsp;&nbsp;<span class="badge badge-secondary">' . $books["fld_booking_status"] . '</span></h6>';
                                        echo '<h6 class="text-uppercase">Counsellor:&nbsp;&nbsp;&nbsp;<span class="badge badge-secondary">None</span></h6>';
                                    } elseif ($books['fld_booking_status'] == 'Approved' || $books['fld_booking_status'] == 'Done') {
                                        echo '<h6 class="text-uppercase">Status:&nbsp;&nbsp;&nbsp;<span class="badge bg-success">' . $books["fld_booking_status"] . '</span></h6>';
                                        echo '<h6 class="text-uppercase">Client:&nbsp;&nbsp;&nbsp;' . $user['fld_username'] . '</h6>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <hr class="vr text-light vr-blurry my-4 ps-n1 text-center">

                            <div class="col-lg-2 jusitfy-content-center text-center mx-3 ps-4 d-flex align-item-center align-items-center">
                                <button type="button" class="btn btn-primary rounded-6 shadow-5-strong detail-btn" data-toggle="modal" data-target="#bookingModal" data-booking-id="<?php echo $books['fld_booking_ID']; ?>">Detail</button>
                                <button class="ms-2 btn btn-danger rounded-6 shadow-5-strong delete-booking" data-booking-id="<?php echo $books['fld_booking_ID']; ?>">Delete</button>
                            </div>

                        </div>
                    </div>
                <?php }
                ?>
        <?php }
        } ?>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5>

                </div>
                <div class="modal-body" id="bookingModalBody">
                    <!-- Booking details will be dynamically loaded here -->
                </div>
                <div class="modal-footer">
                    <?php if ($category != 'Client') { ?>
                        <form>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Add Report</button>
                        </form>
                    <?php } ?>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmDeleteBtn">Confirm</button>
                    <button type="button" class="btn btn-secondary" id="cancelDeleteBtn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>



    <?php include_once 'script.php'; ?>
    <script>
        $(document).ready(function() {
            // Handle click event on "See more" button
            $('.detail-btn').click(function() {
                var bookingID = $(this).data('booking-id');

                // AJAX request to load booking details
                $.ajax({
                    url: 'booking_modal.php',
                    method: 'POST',
                    data: {
                        bookingID: bookingID
                    },
                    success: function(response) {
                        $('#bookingModalBody').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Delete button click event
            $('.delete-booking').click(function() {
                var bookingID = $(this).data('booking-id');
                $('#deleteModal').modal('show'); // Show the confirmation modal

                // Set the booking ID in the confirmation modal for reference
                $('#deleteModal').data('booking-id', bookingID);
            });

            // Confirm deletion button click event
            $('#confirmDeleteBtn').click(function() {
                var bookingID = $('#deleteModal').data('booking-id');

                // AJAX request to delete the booking
                $.ajax({
                    url: 'delete_booking.php',
                    method: 'POST',
                    data: {
                        bookingID: bookingID
                    },
                    success: function(response) {
                        // Handle the response after successful deletion
                        if (response === 'success') {
                            // Show success message or perform any other actions
                            
                            alert('Booking deleted successfully');
                            // Reload the page to update the record list
                            location.reload();
                        }
                        else {
                            // Show error message or perform any other actions
                            alert('Failed to delete booking');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });

                $('#deleteModal').modal('hide'); // Hide the confirmation modal
            });
            $('#cancelDeleteBtn').click(function() {
                $('#deleteModal').modal('hide');
            });
        });
    </script>







</body>

</html>