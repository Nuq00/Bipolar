<?php


try {
    $stmtResult = $conn->prepare("SELECT fld_result_ID FROM user_result");
    $stmtResult->execute();
    $result = $stmtResult->fetchAll(PDO::FETCH_ASSOC);
    $totalLowRisk = 0;
    $totalPotentialRisk = 0;
    $totalIncomplete = 0;
    foreach ($result as $results) {
        $resultID = $results['fld_result_ID'];
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
        if ($totalNull > 0) {
            $totalIncomplete++;
        } elseif ($totalCalculate >= 16) {
            $totalPotentialRisk++;
        } else {
            $totalLowRisk++;
        }
    }
} catch (PDOException $e) {
    echo 'Error:   ' . $e->getMessage();
}
