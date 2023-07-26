<?php
$arrayValue = array();
$arrayMax = array(0, 0, 0, 0, 0);
$arrayQues = array();
$arrayNameQues = array(
    "Need less sleep", 'Feel more energetic and active', 'Prefer to be alone',
    'High self-confident', 'Enjoy work more', 'Sociable', 'Want to travel more',
    'Tend to drive faster', 'Spend more money', 'Take more risk in daily risk',
    'Physically more active', 'Plan more activites', 'Have more ideas and creative',
    'Less shy', 'Wear colorful clothes', 'Want to meet more people', 'Interested in sex',
    'More flirtatious', 'Talk more', 'Think faster', 'Make jokes when talking',
    'Easily distracted', 'Engage in new things', 'Thought jumps from topic to another',
    'Do thing more quickly and easily', 'Impatient', 'Irritating to others',
    'Get into more quearrels', 'More optimistic', 'Drink more coffee', 'Smoke more cigarettes',
    'Drink more alcohol', 'Drugs intake'
);
$arrayAns = array(12, 33, 35, 37, 39, 41, 43, 45, 47, 49, 50, 52, 54, 57, 59, 61, 63, 65, 66, 68, 70, 72, 74, 76, 78, 82, 83, 86, 88, 91, 93, 109, 111);
$counter = 0;
for ($i = 3; $i <= 35; $i++) {
    $arrayQues[$counter] = $i;
    $counter++;
}

try {
    $stmtCount = $conn->prepare("SELECT COUNT(*) AS count FROM user_result");
    $stmtCount->execute();
    $resultCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $totalCount = $resultCount['count'];
    $potentialRiskCount = 0;
    $notRisk = 0;

    for ($i = 0; $i < 33; $i++) {
        $stmtInitial = $conn->prepare("SELECT fld_result_ID FROM response_list WHERE fld_question_ID=$arrayQues[$i] AND fld_answer_ID=$arrayAns[$i]");
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

            //calculate the potential risk status
            foreach ($response as $resp) {
                if ($resp['fld_answer_ID'] == 0 && $resp['fld_question_ID'] != 43) {
                    $nullCount++;
                    continue;
                } elseif ($resp['fld_question_ID'] >= 3 && $resp['fld_question_ID'] <= 35) {
                    foreach ($answers as $ans) {
                        if ($resp['fld_answer_ID'] == $ans['fld_answer_ID']) {
                            if ($ans['fld_answer_name'] == 'Yes') {
                                $calculateCount++;
                            }
                        } elseif ($resp['fld_answer_ID'] == 0) {
                            $nullCount++;
                        }
                    }
                }
            }
            //get the total potential risk status of bipolar
            if ($calculateCount >= 16 && $nullCount == 0) {
                $potentialRiskCount++;
            } else {
                $notRisk++;
            }
        }
        $arrayValue[$i] = ($potentialRiskCount / $totalCount) * 100;
        $potentialRiskCount = 0;
    }

    $as = array(0, 0, 0, 0, 0);
    for ($i = 0; $i < 33; $i++) {
        for ($k = 0; $k < 5; $k++) {
            if ($arrayValue[$i] > $arrayMax[$k]) {
                $as[$k] = $i; //for the question ID.
                $arrayMax[$k] = $arrayValue[$i];
                break;
            }
        }
    }
    // $arrayMax[0]=0.179;
    // $abu = 1;
    //calculate the total value of the highest score
    // $total=0;
    // for ($i = 0; $i < 33; $i++) {
    //     $total = $total + $arrayValue[$i];
    // }
    // $arrayView= array();
    // for ($i = 0; $i < 33; $i++) {
    //     $arrayView[$i] = ($arrayValue[$i] / $total)*100;
    // }
    // for ($i = 0; $i < 5; $i++) {
    //     $arrayMax[$i] = ($arrayMax[$i] / $total)*100;
    // }
    // //$arrayMax[0]=0.179;
    // $percentOther = 100;
    // for ($i = 0; $i < 5; $i++) {
    //     $percentOther = $percentOther - $arrayMax[$i];
    // }
} catch (PDOException $e) {
    echo 'Error:   ' . $e->getMessage();
}
