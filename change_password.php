<?php
include_once 'db3.php';
include_once 'session.php';
include_once 'head.php';

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$password3 = $_POST['password3'];

if ($pwd == $password1) {
    if ($password2 == $password3) {
        $stmt = $conn->prepare("UPDATE user_data SET fld_password='$password2' WHERE fld_userID = '$ID'");
        
        $stmt->execute();
?>
        <script>
            alert("Successfully changed the password");


            window.location.href = "home.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Failed change the password, new password does not the match!");


            window.location.href = "home.php";
        </script>
    <?php
    }
} else { ?>
    <script>
        alert("Failed change the password, old password is not the match!");

        window.location.href = "home.php";
    </script>
<?php
}
