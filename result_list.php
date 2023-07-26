<?php
include_once 'db3.php';
include_once 'session.php';
if ($category != '') {
    echo '<script type="text/javascript">window.location.href = "maintenance.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?>

</head>

<body>
    <?php include_once 'navbar.php'; ?>
    <div class="container">
        <h1 class="text-center mt-5">Questionnaire Results</h1>
        <?php
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM counselling INNER JOIN user_result ON user_result.fld_user_ID = counselling.fld_user_ID AND counselling.fld_staff_ID='$ID'");

        // $stmt = $conn->prepare("SELECT * FROM user_result WHERE fld_user_ID = :matricNumber");
        $stmt->execute();
        $result = $stmt->fetchAll();
        ?>

        <table class="table table-bordered table-striped" name="resultsTable" id="resultsTable">
            <thead>
                <tr>
                    <th style="width:10px;">No.</th>
                    <th>Reference ID</th>
                    <?php if ($category != 'Client') {
                        echo '<th> Client Matric Number</th>';
                    } ?>
                    <th>Questionnaire Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($category == 'Client') { ///client only
                    $count = 1;
                    foreach ($result as $rows) {

                        $timestamp = $rows['fld_date'];
                        $date = date("l, j F Y", strtotime($timestamp));
                        $time = date("h:i A", strtotime($timestamp));
                ?>
                        <tr>
                            <td class="text-center"><?php echo $count ?></td>
                            <td><?php echo $rows['fld_result_ID'];
                                $currentID = $rows['fld_result_ID']; ?></td>
                            <td><?php echo ($rows['fld_quiz_ID'] == 1) ? 'Bipolar Questionnaire' : 'Anxiety Questionnaire'; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $time; ?></td>
                            <td class="text-center">
                                <a class="btn btn-primary view-client-btn" data-toggle="modal" data-target="#viewModal" data-result-id="<?php echo $rows['fld_result_ID']; ?>">View</a>
                            </td>
                        </tr>
                    <?php
                        $count++;
                    }
                } else { //for admin || counsellor || staff

                    $count = 1;
                    foreach ($result as $row) {
                        $timestamp = $row['fld_date'];
                        $date = date("l, j F Y", strtotime($timestamp));
                        $time = date("h:i A", strtotime($timestamp));
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $count ?></td>
                            <td><?php echo $row['fld_result_ID'];
                                $currentID = $row['fld_result_ID']; ?></td>
                            <td><?php echo $row['fld_user_ID']; ?></td>

                            <td><?php echo ($row['fld_quiz_ID'] == 1) ? 'Bipolar Questionnaire' : 'Anxiety Questionnaire'; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $time; ?></td>
                            <td class="text-center">
                                <a class="btn btn-primary view-btn" data-toggle="modal" data-target="#viewModal" data-result-id="<?php echo $row['fld_result_ID']; ?>" data-user-id="<?php echo $row['fld_user_ID']; ?>">View</a>
                            </td>
                        </tr>
                <?php
                        $count++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Result Details</h5>
                </div>
                <div class="modal-body" id="viewModalBody">
                    <!-- Result details will be dynamically loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>


        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#resultsTable').DataTable();

                // View button click event
                $('.view-btn').click(function() {
                    var resultID = $(this).data('result-id');
                    var userID = $(this).data('user-id');

                    // AJAX request to load result details
                    $.ajax({
                        url: 'view_modal.php',
                        method: 'POST',
                        data: {
                            resultID: resultID,
                            userID: userID
                        },
                        success: function(response) {
                            $('#viewModalBody').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });

                $('.view-client-btn').click(function() {
                    var resultID = $(this).data('result-id');

                    // AJAX request to load result details
                    $.ajax({
                        url: 'view_modal.php',
                        method: 'POST',
                        data: {
                            resultID: resultID,
                        },
                        success: function(response) {
                            $('#viewModalBody').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });

            });
        </script>

        <?php include_once 'script.php'; ?>
</body>

</html>