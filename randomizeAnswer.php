<?php
include_once 'db3.php';

// if ($category != 'Client') {
//     echo '<script type="text/javascript">window.location.href = "restricted.php";</script>';
//     exit;
// }

if (isset($_POST['submit'])) {
    $answer_list = array(
        '1' => array(1, 2, 3, 4, 5, 6, 7),
        '2' => array(8, 9, 10, 11),
        '3' => array(12, 13),
        '4' => array(33, 34),
        '5' => array(35, 36),
        '6' => array(37, 38),
        '7' => array(39, 40),
        '8' => array(41, 42),
        '9' => array(43, 44),
        '10' => array(45, 46),
        '11' => array(47, 48),
        '12' => array(49, 56),
        '13' => array(50, 51),
        '14' => array(52, 53),
        '15' => array(54, 55),
        '16' => array(57, 58),
        '17' => array(59, 60),
        '18' => array(61, 62),
        '19' => array(63, 64),
        '20' => array(65, 90),
        '21' => array(66, 67),
        '22' => array(68, 69),
        '23' => array(70, 71),
        '24' => array(72, 73),
        '25' => array(74, 75),
        '26' => array(76, 77),
        '27' => array(78, 79),
        '28' => array(82, 83),
        '29' => array(84, 85),
        '30' => array(86, 87),
        '31' => array(88, 89),
        '32' => array(91, 92),
        '33' => array(93, 94),
        '34' => array(109, 110),
        '35' => array(111, 112),
        '36' => array(14, 15, 16, 17),
        '37' => array(95, 96, 97, 98),
        '38' => array(99, 100, 101, 102),
        '39' => array(103, 104, 105, 106),
        '40' => array(18, 19, 20, 21, 22),
        '41' => array(23, 24, 25, 26, 27, 28),
        '42' => array(107, 108),
        '43' => array(1, 0)
    );

    $randomAnswers = array();
    foreach ($answer_list as $question_list => $answerArray) {
        $randomIndex = array_rand($answerArray);
        $randomAnswer = $answerArray[$randomIndex];
        $randomAnswers[$question_list] = $randomAnswer;
    }

    $questionAnswers = array();
    foreach ($randomAnswers as $question_list => $answer_ans) {
        $questionAnswers[$question_list] = $answer_ans;
    }


    try {

        $randomID = $conn->prepare("SELECT fld_userID FROM user_data WHERE fld_category='Client' ORDER BY RAND() LIMIT 1");
        $randomID->execute();
        $IDget = $randomID->fetch(PDO::FETCH_ASSOC);

        $ID = $IDget['fld_userID'];
        // insert the data into the user_result for the invoice to check into 
        $stmtResponse = $conn->prepare("INSERT INTO user_result(fld_result_ID,fld_quiz_ID,fld_user_ID,fld_date)VALUES(:rid,:quid,:uid,NOW())");

        $stmtResponse->bindParam('rid', $rid, PDO::PARAM_STR);
        $stmtResponse->bindParam('uid', $uid, PDO::PARAM_STR);
        $stmtResponse->bindParam(':quid', $quid, PDO::PARAM_INT);
        $uid = $ID;
        $rid = uniqid('R', true);
        $quid = 1;


        // Fetch data from the question list which related to the bipolar only 
        $stmt3 = $conn->prepare("SELECT * FROM questions_list WHERE fld_questionaire_ID = 1");
        $stmt3->execute();
        $question = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        // Fetch data from the answer list, all the array data
        $count = 1;


        // create the loop for each question to be inserted inside the response_list database

        foreach ($questionAnswers as $question => $answer) {


            $stmt = $conn->prepare("INSERT INTO response_list(fld_result_ID,fld_userID,
        fld_questionaire_ID, fld_question_ID, fld_answer_ID) VALUES(:rid,:uid, :quid, :qid, :aid)");

            $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
            $stmt->bindParam(':quid', $quid, PDO::PARAM_INT);
            $stmt->bindParam(':qid', $qid, PDO::PARAM_INT);
            $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
            $stmt->bindParam(':rid', $rid, PDO::PARAM_STR);



            
            $uid = $ID;
            $qid = $count;
            $aid = $answer;
            $quid = 1;
            $stmt->execute();
            $count++;
        }
        $stmtResponse->execute();
        echo '<script type="text/javascript">window.location.href = "randomizeAnswer.php";</script>';
        exit;
    } catch (PDOException $e) {
        echo 'Error:   ' . $e->getMessage();
    }
}
function randomans()
{
    $answer_list = array(
        '1' => array(1, 2, 3, 4, 5, 6, 7),
        '2' => array(8, 9, 10, 11),
        '3' => array(12, 13),
        '4' => array(33, 34),
        '5' => array(35, 36),
        '6' => array(37, 38),
        '7' => array(39, 40),
        '8' => array(41, 42),
        '9' => array(43, 44),
        '10' => array(45, 46),
        '11' => array(47, 48),
        '12' => array(49, 56),
        '13' => array(50, 51),
        '14' => array(52, 53),
        '15' => array(54, 55),
        '16' => array(57, 58),
        '17' => array(59, 60),
        '18' => array(61, 62),
        '19' => array(63, 64),
        '20' => array(65, 90),
        '21' => array(66, 67),
        '22' => array(68, 69),
        '23' => array(70, 71),
        '24' => array(72, 73),
        '25' => array(74, 75),
        '26' => array(76, 77),
        '27' => array(78, 79),
        '28' => array(82, 83),
        '29' => array(84, 85),
        '30' => array(86, 87),
        '31' => array(88, 89),
        '32' => array(91, 92),
        '33' => array(93, 94),
        '34' => array(109, 110),
        '35' => array(111, 112),
        '36' => array(14, 15, 16, 17),
        '37' => array(95, 96, 97, 98),
        '38' => array(99, 100, 101, 102),
        '39' => array(103, 104, 105, 106),
        '40' => array(18, 19, 20, 21, 22),
        '41' => array(23, 24, 25, 26, 27, 28),
        '42' => array(107, 108),
        '43' => array(1, 0)
    );

    $randomAnswers = array();
    foreach ($answer_list as $question_list => $answerArray) {
        $randomIndex = array_rand($answerArray);
        $randomAnswer = $answerArray[$randomIndex];
        $randomAnswers[$question_list] = $randomAnswer;
    }

    $questionAnswers = array();
    foreach ($randomAnswers as $question_list => $answer_ans) {
        $questionAnswers[$question_list] = $answer_ans;
    }

    // Loop for echoing question_list IDs and answer IDs
    foreach ($questionAnswers as $question_list => $answer) {
        echo "Question $question_list: Answer ID - $answer" . PHP_EOL;
    }
    // $questionAnswers = array();

    // // for ($i = 1; $i <= 43; $i++) {
    // //     $question = (string)$i;
    // //     $answer = (string)rand(1, 3);
    // //     $questionAnswers[$question] = $answer;
    // // }

    // // Loop for echoing question IDs and answer IDs
    // foreach ($questionAnswers as $question => $answer) {
    //     echo "Question $question: Answer ID - $answer" . PHP_EOL;
    // }
}
if (isset($_POST['generate'])) {
    $random = randomans();
}
?>



<html lang="en">


<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <!-- Fetch all the data here -->

    <?php

    try {
        // create connection with database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // fetch data from the table question_list
        $stmt = $conn->prepare("SELECT * FROM questions_list WHERE fld_questionaire_ID = 1");
        $stmt->execute();
        $question = $stmt->fetchAll(PDO::FETCH_ASSOC);


        //fetch data from the anwer_list
        $stmt2 = $conn->prepare("SELECT * FROM answer_list");
        $stmt2->execute();
        $answer = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $count = 1;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } ?>

    <!-- end of the fetch data -->

   
    <div class="container-fluid">
        <form action="" method="post">
            <button class="btn" name="submit" type="submit">Generate Answer</button>
        </form>


    </div>

    <?php include_once 'script.php';; ?>
</body>
<div class="container"></div>

</html>