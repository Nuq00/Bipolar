<?php
include_once 'db3.php';
include_once 'session.php';
if (isset($_POST['submit'])) {

    try {


        $stmt = $conn->prepare("INSERT INTO user_result (fld_result_ID,
     fld_quiz_ID,fld_user_ID,fld_date) VALUES(:result, :quid,:uid,NOW())");

        $stmt->bindParam(':result', $result, PDO::PARAM_STR);
        $stmt->bindParam(':quid', $quid, PDO::PARAM_INT);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);

     



        $uid = $matricNumber;
        $result = $_POST['result'];
        $quid = $_POST['quid'];
        





        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <form method="post">
        <label for="answer">Name:</label>
        <input type="text" name="result" id="result" required>

        <label for="number">Value:</label>
        <input type="number" name="quid" id="quid" required>
        



        <input name="submit" type="submit" value="Submit">
    </form>
    <?php include_once 'head.php'; ?>

</body>

</html>