<?php

try {
    $stmtCount = $conn->prepare("SELECT COUNT(*) AS count FROM user_result");
    $stmtCount->execute();
    $resultCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $totalCount = $resultCount['count'];
    $potentialRiskCount = 0;

    // Question 1
    $stmtInitial = $conn->prepare("SELECT fld_result_ID FROM response_list WHERE fld_question_ID=3 AND fld_answer_ID=12");
    $stmtInitial->execute();
    $resultInitial = $stmtInitial->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultInitial as $resInitial) {
        $resID = $resInitial['fld_result_ID'];
        $stmtGetResponse = $conn->prepare("SELECT * FROM response_list WHERE response_list.fld_result_ID='$resID'");
        $stmtGetResponse->execute();
        $response = $stmtGetResponse->fetchAll(PDO::FETCH_ASSOC);

        $stmtGetAnswer = $conn->prepare("SELECT * FROM answer_list");
        $stmtGetAnswer->execute();
        $answers = $stmtGetAnswer->fetchAll();
        $nullCount = 0;
        $calculateCount = 0;
        foreach ($response as $resp) {
            if ($resp['fld_question_ID'] >= 3 && $resp['fld_question_ID'] <= 35) {
                foreach ($answers as $ans) {
                    if ($resp['fld_answer_ID'] == $ans['fld_answer_ID']) {
                        if ($ans['fld_answer_name'] == 'Yes') {
                            $calculateCount++;
                        }
                    }
                    if ($resp['fld_answer_ID'] == 0) {
                        $nullCount++;
                    }
                }
            }
        }
        if ($calculateCount >= 16) {
            $potentialRiskCount++;
        }
    }
    $percentSleep = ($potentialRiskCount / $totalCount) * 100;
    $potentialRiskCount = 0;

    // Question 2
    $stmtInitial = $conn->prepare("SELECT fld_result_ID FROM response_list WHERE fld_question_ID=32 AND fld_answer_ID=91");
    $stmtInitial->execute();
    $resultInitial = $stmtInitial->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultInitial as $resInitial) {
        $resID = $resInitial['fld_result_ID'];
        $stmtGetResponse = $conn->prepare("SELECT * FROM response_list WHERE response_list.fld_result_ID='$resID'");
        $stmtGetResponse->execute();
        $response = $stmtGetResponse->fetchAll(PDO::FETCH_ASSOC);

        $stmtGetAnswer = $conn->prepare("SELECT * FROM answer_list");
        $stmtGetAnswer->execute();
        $answers = $stmtGetAnswer->fetchAll();
        $nullCount = 0;
        $calculateCount = 0;
        foreach ($response as $resp) {
            if ($resp['fld_question_ID'] >= 3 && $resp['fld_question_ID'] <= 35) {
                foreach ($answers as $ans) {
                    if ($resp['fld_answer_ID'] == $ans['fld_answer_ID']) {
                        if ($ans['fld_answer_name'] == 'Yes') {
                            $calculateCount++;
                        }
                    }
                    if ($resp['fld_answer_ID'] == 0) {
                        $nullCount++;
                    }
                }
            }
        }
        if ($calculateCount >= 16) {
            $potentialRiskCount++;
        }
    }
    $percentCoffee = ($potentialRiskCount / $totalCount) * 100;
    $potentialRiskCount = 0;

    // Question 3
    $stmtInitial = $conn->prepare("SELECT fld_result_ID FROM response_list WHERE fld_question_ID=33 AND fld_answer_ID=93");
    $stmtInitial->execute();
    $resultInitial = $stmtInitial->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultInitial as $resInitial) {
        $resID = $resInitial['fld_result_ID'];
        $stmtGetResponse = $conn->prepare("SELECT * FROM response_list WHERE response_list.fld_result_ID='$resID'");
        $stmtGetResponse->execute();
        $response = $stmtGetResponse->fetchAll(PDO::FETCH_ASSOC);

        $stmtGetAnswer = $conn->prepare("SELECT * FROM answer_list");
        $stmtGetAnswer->execute();
        $answers = $stmtGetAnswer->fetchAll();
        $nullCount = 0;
        $calculateCount = 0;
        foreach ($response as $resp) {
            if ($resp['fld_question_ID'] >= 3 && $resp['fld_question_ID'] <= 35) {
                foreach ($answers as $ans) {
                    if ($resp['fld_answer_ID'] == $ans['fld_answer_ID']) {
                        if ($ans['fld_answer_name'] == 'Yes') {
                            $calculateCount++;
                        }
                    }
                    if ($resp['fld_answer_ID'] == 0) {
                        $nullCount++;
                    }
                }
            }
        }
        if ($calculateCount >= 16) {
            $potentialRiskCount++;
        }
    }
    $percentCigarettes = ($potentialRiskCount / $totalCount) * 100;
    $potentialRiskCount = 0;

    // Question 4
    $stmtInitial = $conn->prepare("SELECT fld_result_ID FROM response_list WHERE fld_question_ID=34 AND fld_answer_ID=109");
    $stmtInitial->execute();
    $resultInitial = $stmtInitial->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultInitial as $resInitial) {
        $resID = $resInitial['fld_result_ID'];
        $stmtGetResponse = $conn->prepare("SELECT * FROM response_list WHERE response_list.fld_result_ID='$resID'");
        $stmtGetResponse->execute();
        $response = $stmtGetResponse->fetchAll(PDO::FETCH_ASSOC);

        $stmtGetAnswer = $conn->prepare("SELECT * FROM answer_list");
        $stmtGetAnswer->execute();
        $answers = $stmtGetAnswer->fetchAll();
        $nullCount = 0;
        $calculateCount = 0;
        foreach ($response as $resp) {
            if ($resp['fld_question_ID'] >= 3 && $resp['fld_question_ID'] <= 35) {
                foreach ($answers as $ans) {
                    if ($resp['fld_answer_ID'] == $ans['fld_answer_ID']) {
                        if ($ans['fld_answer_name'] == 'Yes') {
                            $calculateCount++;
                        }
                    }
                    if ($resp['fld_answer_ID'] == 0) {
                        $nullCount++;
                    }
                }
            }
        }
        if ($calculateCount >= 16) {
            $potentialRiskCount++;
        }
    }
    $percentAlcohol = ($potentialRiskCount / $totalCount) * 100;
    $potentialRiskCount = 0;

    // Question 5
    $stmtInitial = $conn->prepare("SELECT fld_result_ID FROM response_list WHERE fld_question_ID=35 AND fld_answer_ID=111");
    $stmtInitial->execute();
    $resultInitial = $stmtInitial->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultInitial as $resInitial) {
        $resID = $resInitial['fld_result_ID'];
        $stmtGetResponse = $conn->prepare("SELECT * FROM response_list WHERE response_list.fld_result_ID='$resID'");
        $stmtGetResponse->execute();
        $response = $stmtGetResponse->fetchAll(PDO::FETCH_ASSOC);

        $stmtGetAnswer = $conn->prepare("SELECT * FROM answer_list");
        $stmtGetAnswer->execute();
        $answers = $stmtGetAnswer->fetchAll();
        $nullCount = 0;
        $calculateCount = 0;
        foreach ($response as $resp) {
            if ($resp['fld_question_ID'] >= 3 && $resp['fld_question_ID'] <= 35) {
                foreach ($answers as $ans) {
                    if ($resp['fld_answer_ID'] == $ans['fld_answer_ID']) {
                        if ($ans['fld_answer_name'] == 'Yes') {
                            $calculateCount++;
                        }
                    }
                    if ($resp['fld_answer_ID'] == 0) {
                        $nullCount++;
                    }
                }
            }
        }
        if ($calculateCount >= 16) {
            $potentialRiskCount++;
        }
    }
    $percentDrugs = ($potentialRiskCount / $totalCount) * 100;

    $percentOther = 100 - $percentSleep - $percentAlcohol - $percentCigarettes - $percentCoffee - $percentDrugs;
} catch (PDOException $e) {
    echo 'Error:   ' . $e->getMessage();
}
?>
