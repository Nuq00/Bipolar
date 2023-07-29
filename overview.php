<?php include_once 'db3.php'; ?>
<?php include_once 'session.php';
if ($category == 'Client') {
    echo '<script type="text/javascript">window.location.href = "index.php";</script>';
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <?php include_once 'navbar.php';
    include_once 'conclusion2.php';
    ?>

    <!-- Pills navs -->
    <div class="container-fluid">
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex3-tab-1" data-mdb-toggle="pill" href="#ex3-pills-1" role="tab" aria-controls="ex3-pills-1" aria-selected="true">Overall Statistics</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex3-tab-2" data-mdb-toggle="pill" href="#ex3-pills-2" role="tab" aria-controls="ex3-pills-2" aria-selected="false">Questions Overview</a>
            </li>

        </ul>

        <!-- Pills content -->
        <div class="tab-content" id="ex2-content">
            <!-- Content 1 -->
            <div class="tab-pane fade show active" id="ex3-pills-1" role="tabpanel" aria-labelledby="ex3-tab-1">
                <h1 class="text-center mt-4">Overall Overview</h1>
                <div class="col-lg-12 ">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row col-lg-12">
                                <div class="col-lg-6">
                                    <canvas id="myPieChart2"></canvas>
                                </div>
                                <div class="col-lg-6">
                                    <?php
                                    echo "<h3 class='text-center mb-2'>Highest possibilities of Bipolar.</h3>";
                                    // for ($i = 0; $i<=32; $i++){
                                    //     echo "q".$i." ".$arrayView[$i]." ";
                                    // }
                                    ?>

                                    <div class="card col-lg-12 mb-2" align="justify">
                                        <div class="card-body">
                                            <p class='mb-1'><b><?php echo number_format($arrayMax[0], 2) ?>%</b> of respondent with potential of bipolar disorder experienced in <b><?php echo $arrayNameQues[$as[0]] ?></b></p>
                                        </div>
                                    </div>
                                    <div class="card col-lg-12 mb-2" align="justify">
                                        <div class="card-body">
                                            <p class='mb-1'><b><?php echo number_format($arrayMax[1], 2)  ?>%</b> of respondent with potential of bipolar disorder experienced in <b><?php echo $arrayNameQues[$as[1]] ?></b></p>
                                        </div>
                                    </div>
                                    <div class="card col-lg-12 mb-2" align="justify">
                                        <div class="card-body">
                                            <p class='mb-1'><b><?php echo number_format($arrayMax[2], 2)  ?>%</b> of respondent with potential of bipolar disorder experienced in <b><?php echo $arrayNameQues[$as[2]] ?></b></p>
                                        </div>
                                    </div>
                                    <div class="card col-lg-12 mb-2" align="justify">
                                        <div class="card-body">
                                            <p class='mb-1'><b><?php echo number_format($arrayMax[3], 2)  ?>%</b> of respondent with potential of bipolar disorder experienced in <b><?php echo $arrayNameQues[$as[3]] ?></b></p>
                                        </div>
                                    </div>
                                    <div class="card col-lg-12 mb-2" align="justify">
                                        <div class="card-body">
                                            <p class='mb-1'><b><?php echo number_format($arrayMax[4], 2) ?>%</b> of respondent with potential of bipolar disorder experienced in <b><?php echo $arrayNameQues[$as[4]] ?></b></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $currentDate = date("Y-m-d");
                include_once 'calculate3.php'; ?>
                <div class="col-lg-12 row">
                    <div class="col-xl-6 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="fas fa-pencil-alt text-info fa-3x me-4"></i>
                                        </div>
                                        <div>

                                            <h4>Total Answered Bipolar Questionaire</h4>
                                            <p class="mb-0">Last Update on: <u><?php echo $currentDate ?></u></p>
                                        </div>
                                    </div>
                                    <?php
                                    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM user_result");
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $total = $result['count'];
                                    ?>
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0"><?php echo $total ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                                        </div>
                                        <div>
                                            <h4>Total Low Risk Result</h4>
                                            <p class="mb-0">Last Update on: <u><?php echo $currentDate ?></u></p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0"><?php echo $totalLowRisk ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                                        </div>
                                        <div>
                                            <h4>Total Potential Risk Results</h4>
                                            <p class="mb-0">Last Update on: <u><?php echo $currentDate ?></u></p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0"><?php echo $totalPotentialRisk ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                                        </div>
                                        <div>
                                            <h4>Total Incomplete Results</h4>
                                            <p class="mb-0">Last Update on: <u><?php echo $currentDate ?></u></p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0"><?php echo $totalIncomplete ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Content 2 -->
            <div class="tab-pane fade" id="ex3-pills-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                <h1 class="text-center mt-4">Questions Overview</h1>
                <div class="row">
                    <?php
                    for ($i = 1; $i <= 42; $i++) { ?>
                        <?php
                        $stmt4 = $conn->prepare("SELECT fld_question_name FROM questions_list WHERE fld_question_ID = $i");
                        $stmt4->execute();
                        $result4 = $stmt4->fetch();
                        ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <?php if ($i == 1) { ?>
                                        <h5 class="card-title">Question - <?php echo $i . ': Today feeling compared to usual.' ?></h5>
                                    <?php } else {
                                    ?>
                                        <h5 class="card-title">Question - <?php echo $i . ': ' . $result4['fld_question_name'] ?></h5>
                                    <?php }
                                    ?>
                                    <canvas id="myChart<?php echo $i ?>"></canvas>

                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
            <!-- Content 3 -->

        </div>
    </div>

    <!-- Pills content -->
    <?php include_once 'chart1.php';
    include_once 'chart3.php';
    ?>


    <?php include_once 'script.php'; ?>
</body>

</html>