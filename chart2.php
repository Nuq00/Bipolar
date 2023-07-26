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
<script>
    // Get the canvas element
    var ctx = document.getElementById('myPieChart2').getContext('2d');

    // Define the data for the pie chart
    var data = {
        labels: ['Less Sleep', 'Coffee', 'Cigarettes', 'Alcohol', 'Drugs', 'Others'],
        datasets: [{
            label: 'My Dataset',
            data: [<?php echo $percentSleep . ',' . $percentCoffee . ',' . $percentCigarettes . ',' . $percentAlcohol . ',' . $percentDrugs . ',' . $percentOther ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(120, 25, 200, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(120, 25, 200, 1)'

            ],
            borderWidth: 1
        }]
    };

    // Create the pie chart
    var myPieChart2 = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>