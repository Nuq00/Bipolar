<?php
include_once 'db3.php';

// Check if the token is provided in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the token and retrieve the user from the database
    $stmt = $conn->prepare("SELECT * FROM user_data WHERE reset_token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Token is valid and user is found
        if (isset($_POST['submit'])) {
            $pass = $_POST['password'];

            // Update the user's password in the database
            $stmt2 = $conn->prepare("UPDATE user_data SET fld_password = :pass, reset_token = '' WHERE fld_userID = :userID");
            $stmt2->bindParam(':pass', $pass);
            $stmt2->bindParam(':userID', $user['fld_userID']);
            $stmt2->execute();

            echo '<script>alert("Your password has been successfully reset. Please login with your new password.");</script>';
            echo '<script type="text/javascript">window.location.href = "login.php";</script>';
            exit;
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

                                    <p class="h5 text-center mb-4">Reset Password</p>
                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="password" class="form-control" required />
                                        <label class="form-label" for="password">New Password</label>
                                    </div>
                                    <!-- Password -->

                                    <!-- Submit Button -->
                                    <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Reset Password</button>

                                </form>

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

<?php
    } else {
        // Invalid token or user not found
        echo '<script>alert("Invalid token or user not found.");</script>';
    }
} else {
    echo '<script>alert("Token not provided.");</script>';
}
?>