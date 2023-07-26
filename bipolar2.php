<?php
include_once 'db3.php';
include_once 'session.php';
header("location:maintenance.php");

if (isset($_POST['submit'])) {

    try {
        $stmtResponse = $conn->prepare("INSERT INTO user_result(fld_result_ID,fld_user_ID)VALUES(:rid,:uid)");
        $stmtResponse->bindParam('rid', $rid, PDO::PARAM_STR);
        $stmtResponse->bindParam('uid', $uid, PDO::PARAM_STR);




        $uid = $matricNumber;
        $rid = uniqid('R', true);


        $stmt3 = $conn->prepare("SELECT * FROM questions_list WHERE fld_questionaire_ID = 1");
        $stmt3->execute();
        $question = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        $stmt2 = $conn->prepare("SELECT * FROM answer_list");
        $stmt2->execute();
        $answer = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $count = -1;

        foreach ($question as $questions) {

            if ($questions['fld_question_ID'] >= 3 && $questions['fld_question_ID'] <= 35) {
                $stmt = $conn->prepare("INSERT INTO response_list(fld_result_ID,fld_userID,
        fld_questionaire_ID, fld_question_ID, fld_answer_ID) VALUES(:rid,:uid, :quid, :qid, :aid)");

                $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
                $stmt->bindParam(':quid', $quid, PDO::PARAM_INT);
                $stmt->bindParam(':qid', $qid, PDO::PARAM_INT);
                $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
                $stmt->bindParam(':rid', $rid, PDO::PARAM_STR);


                $ans = "q$count";
                $uid = $matricNumber;
                $quid = 1;
                $qid = $questions['fld_question_ID'];
                $aid = $_POST[$ans];
                $stmt->execute();

            }

            $count++;
        }
        $stmtResponse->execute();

    } catch (PDOException $e) {

        echo
            'error:   ' . $e->getMessage();

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



    <?php include 'navbar.php'; ?>
    <div class="container-fluid">
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
        <div class="card shadow-7-strong my-3 mb-5">

            <div class="card-header text-center bg-dark text-light">Questionaire</div>


            <h4 class="text-center pt-5">Energy, Activity and Mood</h4>
            <p class=" mx-5" align="justify">At different times in their life everyone experiences changes or
                swings in energy,activity and mood ("highs
                and lows") or ("ups and downs"). The aims of this questionnaire is to assess the characteristic of the
                "high" periods.
            </p>

            <div class="card-body">
                <form method="post">
                    <?php
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
                                    <select class="custom-select col-lg-3 rounded-5 my-0" id="q1" <?php echo "name='q$count'"?>>
                                    <option selected disabled>Options</option>
                                        <?php foreach ($answer as $ans) {
                                            if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                <option value='<?php echo $ans['fld_answer_ID'] ?>'><?php echo $ans['fld_answer_name'];?></option>
                                                <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                    



                                </div>
                                <button type="button" class="btn btn-primary" onclick="nextStep(1)">Next</button>
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
                                <div class="col-lg-7 ms-n5">
                                    <p class=""><u>
                                            <?php echo $questions['fld_question_name'] ?>
                                        </u></p>
                                    <p class="mt-n3" style="font-size:smaller">Independently of how you feel today, please tell
                                        us how you are
                                        normally compared to other people
                                        ,by choosing which of the following statements describe you best.</p>
                                    <p class="mt-n1" style="font-size:smaller"><u>Compared to other people</u> my level of
                                        activity, energy and mood..</p>
                                </div>

                                <select class="custom-select col-lg-3 rounded-5 my-4" id="q2" <?php echo "name='q$count'" ?>>
                                    <option selected disabled>Options</option>
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
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                            <button type="button" class="btn btn-secondary" onclick="previousStep(2)">Previous</button>
                            </div>
                            
                            

                            <?php


                        }
                        $count++;
                    } ?>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4" id="step3" style="display: none;">
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
                                                <select class="custom-select col-lg-10 rounded-5 text-center"
                                                    id="q3_<?php echo $k; ?>" <?php echo "name='q$k'" ?> required>
                                                    <option selected disabled>Options</option>
                                                    <?php
                                                    foreach ($answer as $ans) {
                                                        if ($ans['fld_question_ID'] == $questions['fld_question_ID']) { ?>
                                                            <option value='<?php echo $ans['fld_answer_ID'] ?>'><?php echo $ans['fld_answer_name'];
                                                        }
                                                    } ?>
                                                </select>
                                            </td>


                                        </tr>
                                    <?php }
                                    $k++;
                                } ?>



                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                        <button type="button" class="btn btn-secondary" onclick="previousStep(3)">Previous</button>
                    </div>



                    <div class="text-center">
                        <button class="btn btn-primary col-lg-1 text-center" type="button" data-mdb-toggle="modal"
                            data-mdb-target="#confirmModal">Submit</button>
                    </div>
                    <div class="modal fade" name="confirmModal" id="confirmModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmation" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmation">Confirmation</h5>

                                </div>
                                <div class="modal-body">
                                    Are you sure to submit the form?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-mdb-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" name="submit" type="submit"
                                        id="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>




            </div>
        </div>



    </div>
    <?php include_once 'script.php'; ?>
</body>
<div class="container"></div>

</html>