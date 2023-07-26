<?php
include_once 'db3.php';
include_once 'session.php';
include_once 'calculate.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM user_result WHERE fld_user_ID = '$matricNumber' AND fld_quiz_ID=1 ORDER BY fld_date DESC LIMIT 1;");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $result_ID = $result['fld_result_ID'];
    $date = $result['fld_date'];


    $stmt2 = $conn->prepare("SELECT * FROM response_list WHERE response_list.fld_result_ID='$result_ID'");
    $stmt2->execute();
    $response = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error:   ' . $e->getMessage();
}

?>


<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <?php include_once 'navbar.php'; ?>
    <div class="container-fluid ">
        <div class="card shadow-5 mb-5 mt-4 px-3" id="invoice" name="invoice">
            <div class="card-body ">
                <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="d-flex justify-content-start col-xl-9">
                            <p style="color: #7e8d9f;font-size: 20px;">Reference Number : <strong class="text-gray"><?php echo $result_ID ?></strong></p>
                        </div>
                        <div class="d-flex justify-content-end col-xl-3 float-end">
                            <a class="btn btn-light text-capitalize" type="button" data-mdb-ripple-color="dark" onclick="generatePDF()" id="download"><i class="far fa-file-pdf text-danger"></i> Export</a>

                        </div>
                        <hr>
                    </div>

                    <div class="container">
                        <div class="col-md-12 mt-2 mb-4">
                            <div class="text-center">
                                <div class="justify-content-between">
                                    <img src="img/ukm.png" style="width:10%" alt="">
                                    <img src="img/bipolars.png" style="width:5%" alt="">
                                </div>

                                <p class="pt-0 mt-3">bipolars.me</p>
                            </div>

                        </div>


                        <div class="row">
                            <div class=" d-flex justify-content-start col-xl-8">
                                <ul class="list-unstyled">
                                    <li class="text-muted">Name: <span style="color:#5d9fc5 ;"><?php echo $name ?>
                                        </span></li>
                                    <li class="text-muted">Matric Number : <span style="color:#5d9fc5 ;"><?php echo $matricNumber ?></span> </li>
                                    <li class="text-muted">Universiti Kebangsaan Malaysia</li>

                                </ul>
                            </div>
                            <div class="d-flex justify-content-end col-xl-4">
                                <ul class="list-unstyled">
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Reference Number : </span><br><?php echo $result_ID ?></li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: </span><br><?php echo $date ?></li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status Bipolar: </span>
                                        <br><?php
                                            if ($totalCalculate <= 16 && $totalNull == 0) {

                                            ?>
                                            <!-- <input type="hidden" value=1 name="outcome"> -->

                                            <span class="badge badge-success">
                                                Low Risk</span>
                                        <?php
                                            } elseif ($totalCalculate >= 16 && $totalNull == 0) {
                                        ?>
                                            <!-- <input type="hidden" value=3 name="outcome"> -->
                                            <span class="badge badge-warning ">
                                                Potential Risk</span>
                                        <?php } elseif ($totalNull >= 1) {
                                        ?>
                                            <!-- <input type="hidden" value=3 name="outcome"> -->
                                            <span class="badge badge-danger ">
                                                Incomplete Form</span>
                                        <?php }


                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped">
                                <thead style="background-color:#84B0CA ;" class="text-white">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt3 = $conn->prepare("SELECT * FROM questions_list WHERE fld_questionaire_ID = 1");
                                    $stmt3->execute();
                                    $question = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                                    // Fetch data from the answer list, all the array data
                                    $stmt4 = $conn->prepare("SELECT * FROM answer_list");
                                    $stmt4->execute();
                                    $answer = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                                    $count = 1;
                                    foreach ($response as $responses) { ?>

                                        <tr>
                                            <th scope="row"><?php echo $count ?></th>
                                            <?php
                                            foreach ($question as $questions) {
                                                if ($responses['fld_question_ID'] == 43 && $questions['fld_question_ID'] == 43) { ?>
                                                    <td><?php echo $questions['fld_question_name'] ?></td>
                                                    <?php
                                                    ?>
                                                    <td><?php echo $responses['fld_answer_ID'] ?></td>
                                                <?php

                                                    break;
                                                }
                                                if ($questions['fld_question_ID'] == $responses['fld_question_ID']) { ?>
                                                    <td><?php echo $questions['fld_question_name'] ?></td>
                                            <?php }
                                            }
                                            ?>
                                            <?php
                                            foreach ($answer as $answers) {
                                                if ($responses['fld_question_ID'] == 43) {
                                                    break;
                                                }
                                                if ($answers['fld_answer_ID'] == $responses['fld_answer_ID']) { ?>
                                                    <td><?php echo $answers['fld_answer_name'] ?></td>
                                                <?php
                                                }
                                                if ($responses['fld_answer_ID'] == 0) { ?>
                                                    <td>Blank</td>
                                                    <?php break;
                                                    ?>
                                            <?php }
                                            } ?>


                                        </tr>
                                    <?php

                                        $count++;
                                    }

                                    ?>
                                </tbody>

                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 mt-4">
                                <p class="ms-3">Please refer to the UKM Kaunseling for any requiries about the bipolars.
                                    This report doesn't need
                                    any signature since it's automatically generated by the computer.
                                </p>

                            </div>
                        </div>
                        <hr>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script type="text/javascript">
        function generatePDF() {
            const invoice = document.getElementById("invoice");
            var opt = {
                margin: [20, 20, 20, 20], // top, right, bottom, left margins in inches
                filename: 'Report.pdf',
                image: {
                    type: "jpeg",
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: "in",
                    format: "letter",
                    orientation: 'portrait',
                    pagebreak: {
                        mode: 'avoid-all'
                    }
                }
            };
            html2pdf().from(invoice).set(opt).save();
        }
    </script>
    <?php include_once 'script.php'; ?>

</body>

</html>