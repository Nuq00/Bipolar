<?php
include_once 'db3.php';

if (isset($_POST['register'])) {
    try {

        $matricNumber = strtolower($_POST['matricNumber']);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];


        $stmt = $conn->prepare("SELECT * FROM user_data WHERE fld_userID = :matricNumber");
        $stmt->execute(['matricNumber' => $matricNumber]);
        $user = $stmt->fetch();
        if ($user) {
            // Display an alert message if user ID already exists
            $message = 'Matric Number already in use';
        } else {
            if ($password != $password2) {

                $message = "Passwords do not match!";
            } else {
                $category = 'Client';
                $stmt = $conn->prepare("INSERT INTO user_data(fld_userID, fld_username, fld_email,
            fld_password,fld_category) VALUES(:matricNumber, :name, :email, :password,:category)");

                $stmt->bindParam(':matricNumber', $matricNumber, PDO::PARAM_STR);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->bindParam(':category', $category, PDO::PARAM_STR);
                $stmt->execute();
                echo '<script type="text/javascript">window.location.href = "register_success.php";</script>';
                exit;
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once 'head.php'; ?>

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Register</h5>
                        <form method="post">
                            <div class=" form-outline mb-3">

                                <input type="text" class="form-control" name="name" id="name" required>
                                <label for="name" class="form-label">Full Name</label>
                            </div>
                            <div class="form-outline mb-3">

                                <input type="text" pattern="[aA][0-9]{6}" class="form-control text-uppercase" name="matricNumber" id="matric" required>
                                <label for="matric" class="form-label">Matric Number</label>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="email" class="form-control" name="email" id="email" required>
                                <label for="matric" class="form-label">Email</label>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="password" class="form-control" name="password" id="password" required>
                                <label for="password" class="form-label">Password</label>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="password" class="form-control" name="password2" id="retype-password" required>
                                <label for="retype-password" class="form-label">Retype Password</label>

                            </div>
                            <div class=" mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms-and-conditions" required>
                                <label class="form-check-label" for="terms-and-conditions">I agree to the <a href="tnc.php">terms and conditions</a></label>
                            </div>
                            <?php if (isset($message)) {
                                echo
                                '<div class="alert alert-danger alert-dismissible fade show mb-3 text-center" role="alert">'
                                    . $message . '</div>';
                            } ?>
                            <input type="hidden">
                            <div class="d-grid gap-2">
                                <button name="register" type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            Already have an account? <a href="login.php">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'script.php'; ?>
</body>

</html>