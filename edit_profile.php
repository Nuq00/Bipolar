<?php
include_once 'db3.php';
include_once 'session.php';
include_once 'head.php';

$username = $_POST['fullname'];
$useremail = $_POST['email'];
$usercontact = $_POST['contact'];

$stmt = $conn->prepare("UPDATE user_data SET fld_username = :username, fld_email = :email, fld_contact = :contact WHERE fld_userID = :userID");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $useremail);
$stmt->bindParam(':contact', $usercontact);
$stmt->bindParam(':userID', $ID);
$stmt->execute();
echo '<script type="text/javascript">window.location.href = "home.php";</script>';
exit;
