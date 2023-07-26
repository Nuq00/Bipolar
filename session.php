<?php
//include_once 'db.php';
include_once 'db3.php';

session_start();

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$matricNumber = $_SESSION["matricNumber"];

$stmt = $conn->prepare("SELECT * FROM user_data WHERE fld_userID = '$matricNumber'");

$stmt->execute();

$readrow = $stmt->fetch(PDO::FETCH_ASSOC);

$ID = $readrow['fld_userID'];
$name = $readrow['fld_username'];
$email = $readrow['fld_email'];
$category = $readrow['fld_category'];
$pwd = $readrow['fld_password'];
$contact = $readrow['fld_contact'];

if ($matricNumber == '') {
	echo '<script type="text/javascript">window.location.href = "login.php";</script>';
	exit;
}
