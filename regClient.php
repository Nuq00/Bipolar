<?php
include_once 'db3.php';
include_once 'session.php';
if ($category == 'Client') {
    echo '<script type="text/javascript">window.location.href = "restricted.php";</script>';
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
if (isset($_POST['add-btn'])) {
    try {
        $user_id = $_POST['user_id']; // Assuming you have a hidden input field for user_id in your HTML form
        $staff_id = $ID; // Assuming $ID contains the staff ID of the logged-in user

        // Insert the data into the counselling table
        $stmt = $conn->prepare("INSERT INTO counselling (fld_user_ID, fld_staff_ID) VALUES (:user_id, :staff_id)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':staff_id', $staff_id);
        $stmt->execute();

        $stmt2 = $conn->prepare("SELECT * FROM user_data WHERE fld_userID = '$user_id'");
        $stmt2->execute();
        $detail = $stmt2->fetch();

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'numanbasyir4@gmail.com';
        $mail->Password = 'rfavrhcimkpuugpr';
        $mail->SMTPSecure = 'tsl';
        $mail->Port = 587;

        $mail->setFrom('numanbasyir4@gmail.com', "Sistem Pengecaman Gejala Gangguan Bipolar");
        $mail->addAddress($detail['fld_email']);

        $mail->Subject = 'Supervision Status';

        $mail->Body = "Dear " . $detail['fld_username'] . ",<br><br>"
            . "We are pleased to inform you that your name has been registered under the supervision of " . $name . ".<br><br>"
            . "If you have any questions, concerns, or need any assistance, please feel free to directly contact " . $name . " at " . $email . ".<br><br>"
            . "We wish you a productive and successful journey under the guidance of " . $name . ".<br><br>"
            . "Best regards,<br>"
            . $name . "<br>"
            . $category . "<br>"
            . "UKM Counselling";

        $mail->AltBody = "Dear " . $detail['fld_username'] . ",<br><br>"
            . "We are pleased to inform you that your name has been registered under the supervision of " . $name . ".<br><br>"
            . "If you have any questions, concerns, or need any assistance, please feel free to directly contact " . $name . " at " . $email . ".<br><br>"
            . "We wish you a productive and successful journey under the guidance of " . $name . ".<br><br>"
            . "Best regards,<br>"
            . $name . "<br>"
            . $category . "<br>"
            . "UKM Counselling";
        $mail->send();
        // Redirect to the same page after successful insertion
        echo '<script type="text/javascript">window.location.href = "regClient.php";</script>';
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
if (isset($_POST['rm-btn'])) {
    try {
        $user_id = $_POST['user_id']; // Assuming you have a hidden input field for user_id in your HTML form

        // Delete the corresponding row from the counselling table
        $stmt = $conn->prepare("DELETE FROM counselling WHERE fld_user_ID = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $stmt2 = $conn->prepare("SELECT * FROM user_data WHERE fld_userID = '$user_id'");
        $stmt2->execute();
        $detail = $stmt2->fetch();

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'numanbasyir4@gmail.com';
        $mail->Password = 'rfavrhcimkpuugpr';
        $mail->SMTPSecure = 'tsl';
        $mail->Port = 587;

        $mail->setFrom('numanbasyir4@gmail.com', "Sistem Pengecaman Gejala Gangguan Bipolar");
        $mail->addAddress($detail['fld_email']);

        $mail->Subject = 'Supervision Status';

        $mail->Body = "Dear " . $detail['fld_username'] . ",<br><br>"
            . "We regret to inform you that you have been removed from the supervision of " . $name . ".<br><br>"
            . "If you have any questions, concerns, or need any further assistance, please feel free to contact us directly at " . $email . ".<br><br>"
            . "We appreciate your participation and wish you all the best in your future endeavors.<br><br>"
            . "Best regards,<br>"
            . $name . "<br>"
            . $category . "<br>"
            . "UKM Counselling";


        $mail->AltBody = "Dear " . $detail['fld_username'] . ",<br><br>"
            . "We regret to inform you that you have been removed from the supervision of " . $name . ".<br><br>"
            . "If you have any questions, concerns, or need any further assistance, please feel free to contact us directly at " . $email . ".<br><br>"
            . "We appreciate your participation and wish you all the best in your future endeavors.<br><br>"
            . "Best regards,<br>"
            . $name . "<br>"
            . $category . "<br>"
            . "UKM Counselling";

        $mail->send();

        // Redirect to the same page after successful deletion
        echo '<script type="text/javascript">window.location.href = "regClient.php";</script>';
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>

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
    <?php include_once 'navbar.php'; ?>

    <?php
    try {
        // create connection with database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // fetch data from the table question_list
        $stmt = $conn->prepare("SELECT * FROM user_data LEFT JOIN counselling ON user_data.fld_userID = counselling.fld_user_ID WHERE counselling.fld_user_ID IS NULL AND fld_category = 'Client'");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $stmt2 = $conn->prepare("SELECT * FROM user_data LEFT JOIN counselling ON user_data.fld_userID = counselling.fld_user_ID WHERE counselling.fld_staff_ID = '$ID'");
        $stmt2->execute();
        $regClient = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        //fetch data from the anwer_list
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <h1 class="mt-3 mb-1 text-center">Supervised Client</h1>
            <div class="my-5 shadow-4 rounded-3 py-3" style="background-color:white;">
                <table id="underCare" class="table table-striped table-bordered py-2">
                    <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>


                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($regClient as $row) { ?>
                            <tr>
                                <td><?php echo $row['fld_user_ID'] ?></td>
                                <td><?php echo $row['fld_username'] ?></td>
                                <td><?php echo $row['fld_email'] ?></td>
                                <td><?php echo $row['fld_contact'] ?></td>
                                <td class="text-center">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $row['fld_userID']; ?>">
                                        <button class="btn btn-sm btn-danger" name="rm-btn">- Remove from care</button>
                                    </form>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <h1 class="mt-3 mb-1 text-center">Unsupervised Client</h1>
            <div class="my-5 shadow-4 rounded-3 py-3" style="background-color:white;">
                <table id="regCare" class="table table-striped table-bordered py-2">
                    <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>


                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $datas) { ?>
                            <tr>
                                <td><?php echo $datas['fld_userID'] ?></td>
                                <td><?php echo $datas['fld_username'] ?></td>
                                <td><?php echo $datas['fld_email'] ?></td>
                                <td><?php echo $datas['fld_contact'] ?></td>
                                <td class="text-center">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $datas['fld_userID']; ?>">
                                        <button class="btn btn-sm btn-success" name="add-btn" id="add-btn">+ Add under Care</button>
                                    </form>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include_once 'script.php'; ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#regCare').DataTable();
            $('#underCare').DataTable();
        });
    </script>
</body>

</html>