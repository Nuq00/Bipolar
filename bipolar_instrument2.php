<?php
include_once 'db3.php';
include_once 'session.php';
echo '<script type="text/javascript">window.location.href = "maintenance.php";</script>';
exit;
if ($category != 'Client') {
    echo '<script type="text/javascript">window.location.href = "restricted.php";</script>';
    exit;
}

if (isset($_POST['submit'])) {

    try {

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
        $stmt2 = $conn->prepare("SELECT * FROM answer_list");
        $stmt2->execute();
        $answer = $stmt2->fetchAll(PDO::FETCH_ASSOC);


        $count = 1;


        // create the loop for each question to be inserted inside the response_list database

        foreach ($question as $questions) {


            $stmt = $conn->prepare("INSERT INTO response_list(fld_result_ID,fld_userID,
        fld_questionaire_ID, fld_question_ID, fld_answer_ID) VALUES(:rid,:uid, :quid, :qid, :aid)");

            $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
            $stmt->bindParam(':quid', $quid, PDO::PARAM_INT);
            $stmt->bindParam(':qid', $qid, PDO::PARAM_INT);
            $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
            $stmt->bindParam(':rid', $rid, PDO::PARAM_STR);



            $ans = "q$count";
            $uid = $ID;
            $qid = $questions['fld_question_ID'];
            $aid = $_POST[$ans];
            $quid = 1;
            $stmt->execute();
            $count++;
        }
        $stmtResponse->execute();
        echo '<script type="text/javascript">window.location.href = "result.php";</script>';
        exit;
    } catch (PDOException $e) {
        echo 'Error:   ' . $e->getMessage();
    }
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

    <?php include 'navbar.php';
    ?>
    <div class="container-fluid">

        <!-- This is just a disclaimer -->
        <div class="d-sm-flex align-items-center justify-content-between my-4">
            <h1 class="h3 mb-0 text-light-800">Modified HCL-32 Questionaire</h1>
        </div>
        <div class="card shadow-7-strong mb-5">

            <div class="card-header text-center bg-dark text-light">Disclaimer</div>
            <div class="card-body">
                <h5 class="card-title">Before taking the questionaire.</h5>
                <p class="card-text " align="justify">The purpose of this questionaire is just to help the counsellor in
                    their job to
                    create a report of a client. The decision is still up to the counsellor and we are not responsible
                    for any misguided self-analysis. Please refer to UKM Kaunseling first before taking the questionaire
                </p>
            </div>
        </div>

        <!-- End of disclaimer  -->


        <div class="card shadow-7-strong my-3 mb-5">

            <!-- Description of the questionaire -->
            <div class="card-header text-center bg-dark text-light">Questionaire</div>

            <h4 class="text-center pt-5">Energy, Activity and Mood</h4>
            <p class=" mx-5" align="justify">At different times in their life everyone experiences changes or
                swings in energy,activity and mood ("highs
                and lows") or ("ups and downs"). The aims of this questionnaire is to assess the characteristic of the
                "high" periods.
            </p>
            <!-- End of the questionaire description-->


            <div class="col-lg-3 mx-5 mt-5">
                <h5>Progress: </h5>
            </div>
            <div class="progress  mt-3 mb-3 mx-5">

                <div class="progress-bar " role="progressbar" style="width: 12.5%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- Start the questionaire...Edit here to change the question -->
            <div class="card-body">
                <form method="post">
                    <hr class="hr">
                    <?php
                    $count = 1;
                    $array = [];
                    $array[0] = null;
                    // Question 1 - 2 
                    foreach ($question as $questions) {
                        // Question 1
                        if ($questions['fld_question_ID'] == 1) { ?>

                            <div id="step1">
                                <div class="form-group row col-lg-12 my-4">
                                    <p class="col-lg-1 ms-3">
                                        <?php echo $count . "." ?>
                                    </p>
                                    <div class="col-lg-8 ms-n5">
                                        <p class="">
                                            <u>
                                                <?php echo $questions['fld_question_name'] ?>
                                            </u>
                                        </p>
                                        <p class="mt-n3" style="font-size:smaller">(Please choose ONE of the following)</p>
                                    </div>
                                    <select class="custom-select col-lg-3 rounded-5 my-0" id="q1" <?php echo "name='q$count'" ?> required>
                                        <option value="0" selected>Options</option>
                                        <?php foreach ($answer as $ans) {
                                            if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                <option value="<?php echo $ans['fld_answer_ID'] ?>"><?php echo $ans['fld_answer_name']; ?></option>
                                        <?php }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end me-5">
                                    <button type="button" class=" btn btn-primary" onclick="nextStep(1)">Next</button>
                                </div>
                            </div>
                        <?php
                            // Question 2
                        } elseif ($questions['fld_question_ID'] == 2) { ?>


                            <div id="step2" style="display: none;">
                                <div class="form-group row col-lg-12 my-4">
                                    <!-- I need to insert the id in here -->
                                    <p class="col-lg-1 ms-3">
                                        <?php echo $count . "." ?>
                                    </p>
                                    <div class="col-lg-8 ms-n5">
                                        <p class=""><u>
                                                <?php echo $questions['fld_question_name'] ?>
                                            </u></p>
                                        <p class="mt-n3" style="font-size:smaller">Independently of how you feel today, please
                                            tell
                                            us how you are
                                            normally compared to other people
                                            ,by choosing which of the following statements describe you best.</p>
                                        <p class="mt-n1" style="font-size:smaller"><u>Compared to other people</u> my level of
                                            activity, energy and mood..</p>
                                    </div>
                                    <select class="custom-select col-lg-3 rounded-5 my-4" id="q2" <?php echo "name='q$count'" ?> required>
                                        <option value="0" selected>Options</option>
                                        <?php
                                        foreach ($answer as $ans) {
                                            if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                <option value='<?php echo $ans['fld_answer_ID'] ?>'><?php echo $ans['fld_answer_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <hr class="hr">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary" onclick="previousStep(2)">Previous</a>
                                    <a class="btn btn-primary" onclick="nextStep(2)">Next</a>
                                </div>

                            </div>
                    <?php
                        }
                        $count++;
                    } ?>

                    <div id="step3" style="display: none;">
                        <div class="form-group row col-lg-12 my-4">
                            <p class="col-lg-1 ms-3">3.</p>
                            <div class="col-lg-8 ms-n5">
                                <p class="">Please try to remember <u>a period when you were in a "high" state.</u></p>
                                <p class="mt-n3" style="font-size:smaller">How did you feel then? Please answer all of
                                    these
                                    statement Independently of your present condition.</p>
                                <p class="mt-n1" style="font-size:smaller">In such state:</p>
                            </div>
                            <table class="table table-bordered table-striped justify-content-between text-center ms-4 me-4">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-lg-1">Bil</th>
                                        <th scope="col" class="col-lg-9">State</th>
                                        <th scope="col" class="col-lg-2">Answer</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $k = -1;
                                    // $i=1; as count
                                    $i = 1;
                                    foreach ($question as $questions) {

                                        if ($questions['fld_question_ID'] >= 3 && $questions['fld_question_ID'] <= 35) { ?>
                                            <tr>
                                                <th scope='row'>
                                                    <?php echo "$k" ?>
                                                </th>
                                                <td>
                                                    <?php echo $questions['fld_question_name'] ?>
                                                </td>
                                                <td>
                                                    <select class="custom-select col-lg-10 rounded-5 text-center" id="q3_<?php echo $i; ?>" <?php echo "name='q$i'" ?> required>
                                                        <option value="0" selected>Options</option>
                                                        <?php
                                                        foreach ($answer as $ans) {
                                                            if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                                <option value='<?php echo $ans['fld_answer_ID'] ?>'><?php echo $ans['fld_answer_name']; ?></option>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>


                                            </tr>
                                    <?php }
                                        $k++;
                                        $i++;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                        <hr class="hr">
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-secondary" onclick="previousStep(3)">Previous</a>
                            <a class="btn btn-primary" onclick="nextStep(3)">Next</a>
                        </div>
                    </div>

                    <hr class="hr">
                    <div id="step4" style="display: none;">
                        <div class="form-group row col-lg-12 my-4">
                            <p class="col-lg-1 ms-3">4.</p>
                            <div class="col-lg-8 ms-n5">
                                <p class="">Impact of your "highs" on various aspect of your life:</p>
                                <p class="mt-n3" style="font-size:smaller">Please answer for every statement given.</p>
                                <p class="mt-n1" style="font-size:smaller">In such state:</p>
                            </div>

                            <table class="table table-bordered table-striped justify-content-between text-center ms-4 me-4">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-lg-1">Bil</th>
                                        <th scope="col" class="col-lg-9">State</th>
                                        <th scope="col" class="col-lg-2">Answer</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $k = -33;
                                    $i = 1;
                                    foreach ($question as $questions) {

                                        if ($questions['fld_question_ID'] >= 36 && $questions['fld_question_ID'] <= 39) { ?>
                                            <tr>
                                                <th scope='row'>
                                                    <?php echo "$k" ?>
                                                </th>
                                                <td>
                                                    <?php echo $questions['fld_question_name'] ?>
                                                </td>
                                                <td>
                                                    <select class="custom-select col-lg-10 rounded-5 text-center" id="q3_<?php echo $i; ?>" <?php echo "name='q$i'" ?> required>
                                                        <option value="0" selected>Options</option>
                                                        <?php
                                                        foreach ($answer as $ans) {
                                                            if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                                <option value='<?php echo $ans['fld_answer_ID'] ?>'><?php echo $ans['fld_answer_name']; ?></option>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>


                                            </tr>
                                    <?php }
                                        $k++;
                                        $i++;
                                    } ?>


                                </tbody>
                            </table>
                        </div>
                        <hr class="hr">
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-secondary" onclick="previousStep(4)">Previous</a>
                            <a class="btn btn-primary" onclick="nextStep(4)">Next</a>
                        </div>
                    </div>


                    <?php
                    $count = -33;
                    $i = 1;
                    // Question 1 - 2 
                    foreach ($question as $questions) {
                        // Question 1
                        if ($questions['fld_question_ID'] == 40) { ?>

                            <div id="step5" style="display:none;">
                                <div class="form-group row col-lg-12 my-4">
                                    <p class="col-lg-1 ms-3">
                                        <?php echo $count . "." ?>
                                    </p>
                                    <div class="col-lg-8 ms-n5">
                                        <p class="">
                                            <u>
                                                <?php echo $questions['fld_question_name'] ?>
                                            </u>
                                        </p>
                                        <p class="mt-n3" style="font-size:smaller">How did people close to you react to or comment
                                            on your "highs."?</p>
                                    </div>
                                    <select class="custom-select col-lg-3 rounded-5 my-0" id="q5_<?php echo $i; ?>" <?php echo "name='q$i'" ?> required>
                                        <option value="0" selected>Options</option>
                                        <?php foreach ($answer as $ans) {
                                            if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                <option value="<?php echo $ans['fld_answer_ID'] ?>"><?php echo $ans['fld_answer_name']; ?></option>

                                        <?php }
                                        }

                                        ?>
                                    </select>
                                </div>

                                <hr class="hr">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary" onclick="previousStep(5)">Previous</a>
                                    <a class="btn btn-primary" onclick="nextStep(5)">Next</a>
                                </div>
                            </div>
                        <?php
                            // Question 5
                        } elseif ($questions['fld_question_ID'] == 41) { ?>
                            <div id="step6" style="display: none;">
                                <div class="form-group row col-lg-12 my-4">
                                    <p class="col-lg-1 ms-3">
                                        <?php echo $count . "." ?>
                                    </p>
                                    <div class="col-lg-8 ms-n5">
                                        <p class=""><u>
                                                <?php echo $questions['fld_question_name'] ?>
                                            </u></p>
                                        <p class="mt-n3" style="font-size:smaller">Please mark only one of the following.</p>
                                    </div>
                                    <select class="custom-select col-lg-3 rounded-5 my-4" id="q6_<?php echo $i; ?>" <?php echo "name='q$i'" ?> required>
                                        <option value="0" selected>Options</option>
                                        <?php
                                        foreach ($answer as $ans) {
                                            if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                <option value='<?php echo $ans['fld_answer_ID'] ?>'><?php echo $ans['fld_answer_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <hr class="hr">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary" onclick="previousStep(6)">Previous</a>
                                    <a class="btn btn-primary" onclick="nextStep(6)">Next</a>
                                </div>
                            </div>
                        <?php
                        } elseif ($questions['fld_question_ID'] == 42) { ?>
                            <div id="step7" style="display: none;">
                                <div class="form-group row col-lg-12 my-4">
                                    <!-- I need to insert the id in here -->
                                    <p class="col-lg-1 ms-3">
                                        <?php echo $count . "." ?>
                                    </p>
                                    <div class="col-lg-8 ms-n5">
                                        <p class=""><u>
                                                <?php echo $questions['fld_question_name'] ?>
                                            </u></p>
                                        <p class="mt-n3" style="font-size:smaller">Please mark only one of the following.</p>


                                    </div>
                                    <select class="custom-select col-lg-3 rounded-5 my-4" id="q7_<?php echo $i; ?>" <?php echo "name='q$i'" ?> required>
                                        <option value="0" selected>Options</option>
                                        <?php
                                        foreach ($answer as $ans) {
                                            if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                <option value='<?php echo $ans['fld_answer_ID'] ?>'><?php echo $ans['fld_answer_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <hr class="hr">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary" onclick="previousStep(7)">Previous</a>
                                    <a class="btn btn-primary" onclick="nextStep(7)">Next</a>
                                </div>
                            </div>
                        <?php
                        } elseif ($questions['fld_question_ID'] == 43) { ?>
                            <div id="step8" style="display: none;">
                                <div class="form-group row col-lg-12 my-4">
                                    <!-- I need to insert the id in here -->
                                    <p class="col-lg-1 ms-3">
                                        <?php echo $count . "." ?>
                                    </p>
                                    <div class="col-lg-8 ms-n5">
                                        <p class="">
                                            <?php echo $questions['fld_question_name'] ?>
                                        </p>
                                        <p class="mt-n3" style="font-size: smaller;">Write 0 if you did not experienced any "highs" during the past 12 months.</p>
                                    </div>
                                    <div class="custom-form col-lg-3 rounded-4 ">
                                        <input required type="number" id="q8_<?php echo $i; ?>" <?php echo "name='q$i'" ?> class="form-control" placeholder="Number of days" min=0 oninput="validity.valid||(value='');" />

                                    </div>
                                </div>


                                <hr class="hr">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary" onclick="previousStep(8)">Previous</a>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary col-lg-1 text-center" type="submit" name="confirm" id="confirm" data-mdb-toggle="modal" data-mdb-target="#confirmModal1">Submit</button>
                                </div>

                            </div>

                    <?php
                        }

                        $count++;
                        $i++;
                    }
                    if (isset($_POST['confirm'])) {

                        try {

                            // insert the data into the user_result for the invoice to check into 




                            // Fetch data from the question list which related to the bipolar only 
                            $stmt3 = $conn->prepare("SELECT * FROM questions_list WHERE fld_questionaire_ID = 1");
                            $stmt3->execute();
                            $question = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                            // Fetch data from the answer list, all the array data
                            $stmt2 = $conn->prepare("SELECT * FROM answer_list");
                            $stmt2->execute();
                            $answer = $stmt2->fetchAll(PDO::FETCH_ASSOC);


                            $count = 1;


                            // create the loop for each question to be inserted inside the response_list database

                            foreach ($question as $questions) {


                                $stmt = $conn->prepare("INSERT INTO response_list(fld_result_ID,fld_userID,
                            fld_questionaire_ID, fld_question_ID, fld_answer_ID) VALUES(:rid,:uid, :quid, :qid, :aid)");

                                $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
                                $stmt->bindParam(':quid', $quid, PDO::PARAM_INT);
                                $stmt->bindParam(':qid', $qid, PDO::PARAM_INT);
                                $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
                                $stmt->bindParam(':rid', $rid, PDO::PARAM_STR);



                                $ans = "q$count";
                                $uid = $ID;
                                $qid = $questions['fld_question_ID'];
                                $aid = $_POST[$ans];
                                $quid = 1;
                                $stmt->execute();
                                $count++;
                            }
                            $stmtResponse->execute();
                            echo '<script type="text/javascript">window.location.href = "result.php";</script>';
                            exit;
                        } catch (PDOException $e) {
                            echo 'Error:   ' . $e->getMessage();
                        }
                    }
                    ?>

                    <div class="modal fade" name="confirmModal1" id="confirmModal1" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmation">Confirmation</h5>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped justify-content-between text-center ms-4 me-4">
                                        <thead>
                                            <th>No.</th>
                                            <th>Questions</th>
                                            <th>Answered Questions</th>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $stmtQuestion = $conn->prepare("SELECT * FROM questions_list WHERE fld_questionaire_ID = 1");
                                            $stmtQuestion->execute();
                                            $questionList = $stmtQuestion->fetchAll(PDO::FETCH_ASSOC);
                                            $count = 1;
                                            foreach ($questionList as $questions) {
                                                $ques = "q$count"; ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php echo $count; ?>
                                                    </th>
                                                    <td>
                                                        <?php echo $questions['fld_question_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $_POST[$ques]; ?>
                                                    </td>
                                                </tr>
                                            <?php $count++;
                                            } ?>
                                        </tbody>
                                    </table>
                                    Are you sure to submit the form?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" name="submit" type="submit" id="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>




            </div>
        </div>



    </div>
    <script type="text/javascript">
        function nextStep(step) {
            if (validateForm(step)) {
                document.getElementById('step' + step).style.display = 'none';
                document.getElementById('step' + (step + 1)).style.display = 'block';
                updateProgressBar((step + 1) * 12.5); // Update progress bar (each step is 20%)
            }
        }

        function previousStep(step) {
            document.getElementById('step' + step).style.display = 'none';
            document.getElementById('step' + (step - 1)).style.display = 'block';
            updateProgressBar((step - 1) * 12.5); // Update progress bar (each step is 20%)
        }

        function validateForm(step) {
            let isValid = true;
            const inputs = document.getElementById('step' + step).querySelectorAll('input[required]');
            inputs.forEach(input => {
                if (!input.value) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            return isValid;
        }

        function updateProgressBar(progress) {
            const progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
        }
    </script>

    <?php include_once 'script.php';; ?>
</body>
<div class="container"></div>

</html>