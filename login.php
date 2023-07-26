<?php
include_once 'db3.php';
session_start();

try {
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST["login"])) {
        if (empty($_POST["matricNumber"]) || empty($_POST["password"])) {
            $message = 'All fields are required';
        } else {
            $query = "SELECT * FROM user_data WHERE fld_userID = :matricNumber AND fld_password = :password";
            $stmt = $conn->prepare($query);
            $matric = strtolower($_POST["matricNumber"]);
            $stmt->execute(
                array(
                    'matricNumber' => $matric,
                    'password' => $_POST["password"]
                )
            );
            $count = $stmt->rowCount();
            if ($count > 0) {

                $_SESSION["matricNumber"] = $_POST["matricNumber"];



                echo '<script type="text/javascript">window.location.href = "home.php";</script>';
                exit;
            } else {
                $message = 'Wrong Password! Please Try Again';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
    <style>
        body {
            background-image: url(img/Home.png);
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            /* Set body height to 100% of the viewport height */
            margin: 0;
            /* Remove default margin to ensure full coverage */
            padding: 0;
            /* Remove default padding to ensure full coverage */
        }

        .card {
            margin-top: 50px;
            border: none;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .card-body {
            padding: 30px;
        }

        .form-outline {
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #5C6BC0;
            border-color: #5C6BC0;
        }

        .btn-primary:hover {
            background-color: #3949AB;
            border-color: #3949AB;
        }

        .link-info {
            color: #5C6BC0;
        }

        @media (max-width: 576px) {
            .card {
                margin-top: 20px;
                border-radius: 0;
            }

            .form-label {
                font-size: 14px;
            }

            .card-title {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <!-- Card -->
                <div class="card">
                    <!-- Card body -->
                    <div class="card-body">
                        <h3 class="card-title">Sign in</h3>
                        <!-- Form -->
                        <form method="post">
                            <!-- Matric Number -->
                            <div class="form-outline">
                                <input type="text" name="matricNumber" id="matricNumber" pattern="[a-zA-Z][0-9]{6}" class="text-uppercase form-control" required />
                                <label class="form-label" for="matricNumber">Matric Number</label>
                            </div>
                            <!-- Password -->
                            <div class="form-outline">
                                <input type="password" name="password" id="password" class="form-control" required />
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <!-- Login Button -->
                            <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Login</button>
                            <div class="d-flex justify-content-center">
                                <p>Not a member?
                                    <a href="register.php" class="link-info mx-2">Register</a>
                                </p>
                            </div>
                            <div class="d-flex justify-content-center mt-n3">
                                <p>Forgot password?
                                    <a href="forget_password.php" class="link-info mx-2">Forgot Password</a>
                                </p>
                            </div>
                        </form>
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
    <?php include_once 'script.php'; ?>
</body>

</html>