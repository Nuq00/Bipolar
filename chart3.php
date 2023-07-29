<?php
$arrayValue = array();
$arrayMaxs = array(0, 0, 0, 0, 0);
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
            if ($arrayValue[$i] > $arrayMaxs[$k]) {
                $as[$k] = $i; //for the question ID.
                $arrayMaxs[$k] = $arrayValue[$i];
                break;
            }
        }
    }
    $total = 0;
    //calculate the total value of the highest score
    // for ($i = 0; $i < 33; $i++) {
    //     $total = $total + $arrayValue[$i];
    // }
    // for ($i = 0; $i < 5; $i++) {
    //     $arrayMaxs[$i] = ($arrayMaxs[$i] / $total) * 100;
    // }
    // $percentOther = 100;
    // for ($i = 0; $i < 5; $i++) {
    //     $percentOther = $percentOther - $arrayMaxs[$i];
    // }
} catch (PDOException $e) {
    echo 'Error:   ' . $e->getMessage();
}
?>
<script>
    // Get the canvas element
    var ctx = document.getElementById('myPieChart2').getContext('2d');

    // Define the data for the pie chart
    var data = {
        labels: [
            '<?php echo $arrayNameQues[$as[0]]; ?>',
            '<?php echo $arrayNameQues[$as[1]]; ?>',
            '<?php echo $arrayNameQues[$as[2]]; ?>',
            '<?php echo $arrayNameQues[$as[3]]; ?>',
            '<?php echo $arrayNameQues[$as[4]]; ?>',

        ],
        datasets: [{
            label: 'Bipolar Symptom',
            data: [
                <?php echo $arrayMaxs[0] . ',' . $arrayMaxs[1] . ',' . $arrayMaxs[2] . ',' . $arrayMaxs[3] . ',' . $arrayMaxs[4] ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'

            ],
            borderWidth: 1
        }]
    };


    // Create the pie chart
    var myPieChart2 = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }

    });
</script>