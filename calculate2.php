<?php


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($category == 'Client') {
        $stmt = $conn->prepare("SELECT * FROM user_result WHERE fld_user_ID = '$matricNumber' AND fld_quiz_ID=1 AND fld_result_ID = '$resultID' ORDER BY fld_date DESC LIMIT 1;");
    } else {
        if (isset($userID)) {
            $stmt = $conn->prepare("SELECT * FROM user_result WHERE fld_user_ID = '$userID' AND fld_quiz_ID=1 AND fld_result_ID = '$resultID' ORDER BY fld_date DESC LIMIT 1;");
        }
    }

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $resultID = $result['fld_result_ID'];
    $date = $result['fld_date'];


    $stmt2 = $conn->prepare("SELECT * FROM response_list WHERE response_list.fld_result_ID='$resultID'");
    $stmt2->execute();
    $response = $stmt2->fetchAll(PDO::FETCH_ASSOC);





    $stmtAnswer = $conn->prepare("SELECT * FROM answer_list");
    $stmtAnswer->execute();
    $answer = $stmtAnswer->fetchAll();
    $totalNull = 0;
    $totalCalculate = 0;
    foreach ($response as $responses) {
        if ($responses['fld_answer_ID'] == 0 && $responses['fld_question_ID'] != 43) {
            $totalNull++;
        } elseif ($responses['fld_question_ID'] >= 3 && $responses['fld_question_ID'] <= 35) {
            foreach ($answer as $ans) {
                if ($responses['fld_answer_ID'] == $ans['fld_answer_ID']) {
                    if ($ans['fld_answer_name'] == 'Yes') {
                        $totalCalculate++;
                    }
                }
                if ($responses['fld_answer_ID'] == 0) {
                    $totalNull++;
                }
            }
        }
    }
} catch (PDOException $e) {
    echo 'Error:   ' . $e->getMessage();
}
