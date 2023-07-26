<?php
include_once 'db3.php';
// Handle form submission
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



// Handle form submission
if (isset($_POST['submit'])) {
    try {
        $confirmemail = $_POST['email'];
        $token = bin2hex(random_bytes(32));

        // Update the user's token in the database
        $stmt = $conn->prepare("UPDATE user_data SET reset_token = :token WHERE fld_email = :email");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $confirmemail);
        $stmt->execute();

        // Send the password reset email using PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'numanbasyir4@gmail.com';
        $mail->Password = 'rfavrhcimkpuugpr';
        $mail->SMTPSecure = 'tsl'; // or 'ssl' if required
        $mail->Port = 587; // or the appropriate SMTP port for your provider

        $mail->setFrom('numanbasyir4@gmail.com', "Bipolar Disorder Detection System");
        $mail->addAddress($confirmemail);

        $mail->Subject = 'Password Reset';
        //$mail->Body = "Please click the following link to reset your password:\n\n<a href='http://bipolars.me/reset_password.php?token=$token'>Reset Password</a>";
        $mail->Body = "Please click the following link to reset your password:\n\n<a href='http://bipolars.me/reset_password.php?token=$token'>Reset Password</a>";
        $mail->AltBody = 'Please click the following link to reset your password: http://bipolars.me/reset_password.php?token=$token';

        if ($mail->send()) {
            echo '<script>alert("Your password has been successfully reset. Please login with your new password.");</script>';
        } else {
            $message = "Failed to send the password reset email. Error: " . $mail->ErrorInfo;
        }
    } catch (PDOException $error) {
        $message = $error->getMessage();
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
</head>

<body>

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">

                <!-- Card -->
                <div class="card">

                    <!-- Card body -->
                    <div class="card-body">

                        <!-- Form -->
                        <form method="post">

                            <p class="h5 text-center mb-4">Forgot Password</p>
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="email" class="form-control" required />
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <!-- Matric Number -->

                            <!-- Login Button -->
                            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Submit</button>



                        </form>
                        <div class="d-flex justify-content-center">
                            <p>Remember the password?
                                <a href="login.php" class="link-info mx-2">Login</a>
                            </p>
                        </div>
                        <?php if (isset($message)) {
                            echo
                            '<div class="alert alert-danger alert-dismissible fade show text-center mt-3" role="alert">'
                                . $message . '</div>';
                        } ?>





                        <!-- Form -->

                    </div>
                    <!-- Card body -->

                </div>
                <!-- Card -->

            </div>

        </div>

    </div>

    <!-- JS -->
    <?php include_once 'script.php'; ?>


</body>

</html>