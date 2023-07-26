<?php
include_once 'db3.php';
include_once 'session.php';
header("location:maintenance.php");
if (isset($_POST['submit'])) {
    try {

        $stmt = $conn->prepare("INSERT INTO bipolar_questionaire(fld_bipolar_ID, fld_userID) VALUES(:bid, :matricNumber)");

        $stmt->bindParam(':bid', $bid, PDO::PARAM_STR);
        $stmt->bindParam(':matricNumber', $matricNumber, PDO::PARAM_STR);


        $bip = uniqid('Bipolar_', true);
        $matricNumber = $_POST['matricNumber'];
        $stmt->execute();


        $stmt1 = $conn->prepare("INSERT INTO bipolar_details(fld_bipolar_detail_ID, fld_bipolar_ID, fld_bipolar_question_ID,fld_value) 
        VALUES(:bdid, :bip, :bqid, :value)");

        $stmt1->bindParam(':bdid', $bdid, PDO::PARAM_STR);
        $stmt1->bindParam(':bip', $bip, PDO::PARAM_STR);
        $stmt1->bindParam(':bqid', $bqid, PDO::PARAM_INT);
        $stmt1->bindParam(':value', $value, PDO::PARAM_INT);


        $bdid = uniqid('BipolarDetails_', true);
        $bqid = $_POST['bqid'];
        $value = $_POST['value'];



        $stmt1->execute();



    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



?>



<html lang="en">


<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
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
                <form action="result.php" method="post">
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-1 ms-3">1.</p>
                        <div class="col-lg-8 ms-n5">
                            <p class="">First of all, <u>how are you feeling today compared to your usual state:</u></p>
                            <p class="mt-n3" style="font-size:smaller">(Please choose ONE of the following)</p>
                        </div>
                        <select class="custom-select col-lg-3 rounded-5 my-0" id="q1">
                            <option selected>Options</option>
                            <option value="1">Much worse than usual</option>
                            <option value="2">Worse than usual</option>
                            <option value="3">A little worse than usual</option>
                            <option value="4">Neither better nor worse than usual</option>
                            <option value="5">A little better than usual</option>
                            <option value="6">Better than usual</option>
                            <option value="7">Much better than usual</option>
                        </select>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-1 ms-3">2.</p>
                        <div class="col-lg-8 ms-n5">
                            <p class=""><u>How are you usually compared to other people?</u></p>
                            <p class="mt-n3" style="font-size:smaller">Independently of how you feel today, please tell
                                us how you are
                                normally compared to other people
                                ,by choosing which o f the following statements describe you best.</p>
                            <p class="mt-n1" style="font-size:smaller"><u>Compared to other people</u> my level of
                                activity, energy and mood..</p>
                        </div>

                        <select class="custom-select col-lg-3 rounded-5 my-4" id="q2">
                            <option selected>Options</option>
                            <option value="1">.. is always rather stable and even.</option>
                            <option value="2">.. is generally higher.</option>
                            <option value="3">.. is generally lower.</option>
                            <option value="4">.. repeatedly shows periods of ups and downs.</option>

                        </select>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-1 ms-3">3.</p>
                        <div class="col-lg-8 ms-n5">
                            <p class="">Please try to remember <u>a period when you were in a "high" state.</u></p>
                            <p class="mt-n3" style="font-size:smaller">How did you feel then? Please answer all of these
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td>I need less sleep.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_1">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>I feel more energetic and more active</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_2">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>I am more self-confident</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_3">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>I enjoy work more.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_4">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>I am more sociable. <small class="text-muted">( make more phone calls, go out
                                            more )</small></td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_5">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>I want to travel and/or do travel more.
                                    </td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_6">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>I tend to drive faster or take more risks when driving.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_7">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>I spend more money/too much money.
                                    </td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_8">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>I take more risks in my daily life. <small class="text-muted">( in my work
                                            and/or other activities )</small></td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_9">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>I am physically more active. <small class="text-muted">( sport etc.
                                            )</small></td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_10">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">11</th>
                                    <td>I plan more activities or projects.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_11">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">12</th>
                                    <td>I have more ideas, I am more creative.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_12">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">13</th>
                                    <td>I am less shy or inhibited.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_13">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">14</th>
                                    <td>I wear more colorful and more extravagant clothes/make-up</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_14">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">15</th>
                                    <td>I wamt to meet or actually do meet more people.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_15">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">16</th>
                                    <td>I am more interested in sex.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_16">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">17</th>
                                    <td>I am more flirtatious and/or am more sexually active.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_17">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">18</th>
                                    <td>I talk more.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_18">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">19</th>
                                    <td>I think faster.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_19">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">20</th>
                                    <td>I make more jokes or puns when I am talking..</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_20">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">21</th>
                                    <td>I am more easily distracted.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_21">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">22</th>
                                    <td>I engage in a lot of new things.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_22">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">23</th>
                                    <td>My thoughts jump from topic to topic.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_23">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">24</th>
                                    <td>I do things more quickly and/more easily.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_24">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">25</th>
                                    <td>I am more impatient and/more get irritable more easily.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_25">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">26</th>
                                    <td>I can be exhausting or irritating for others.
                                    </td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_26">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">27</th>
                                    <td>I get into more quarrels.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_27">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">28</th>
                                    <td>My mood is higher, more optimistic.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_28">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">29</th>
                                    <td>SI drink more coffee.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_29">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">30</th>
                                    <td>I smoke more cigarettes.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_30">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">31</th>
                                    <td>I drink more alcohol.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_31">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">32</th>
                                    <td>I take more drugs. <small class="text-muted">(
                                            sedatives, anxiolytics, stimulants..
                                            )</small></td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q2">
                                            <option selected>Options</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="hr">
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Family life.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q4_1">
                                            <option selected>Options</option>
                                            <option value="1">Positive and Negative</option>
                                            <option value="2">Positive</option>
                                            <option value="3">Negative</option>
                                            <option value="4">No Impact</option>
                                        </select>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Social life.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_2">
                                            <option selected>Options</option>
                                            <option value="1">Positive and Negative</option>
                                            <option value="2">Positive</option>
                                            <option value="3">Negative</option>
                                            <option value="4">No Impact</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Work</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_3">
                                            <option selected>Options</option>
                                            <option value="1">Positive and Negative</option>
                                            <option value="2">Positive</option>
                                            <option value="3">Negative</option>
                                            <option value="4">No Impact</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Leisure.</td>
                                    <td><select class="custom-select col-lg-10 rounded-5 text-center" id="q3_4">
                                            <option selected>Options</option>
                                            <option value="1">Positive and Negative</option>
                                            <option value="2">Positive</option>
                                            <option value="3">Negative</option>
                                            <option value="4">No Impact</option>
                                        </select></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-1 ms-3">5.</p>
                        <div class="col-lg-8 ms-n5">
                            <p class="">Other people's reaction and comment to your "highs."?</p>
                            <p class="mt-n3" style="font-size:smaller">How did people close to you react to or comment
                                on your "highs."?</p>
                        </div>

                        <select class="custom-select col-lg-3 rounded-5 my-4" id="q2">
                            <option selected>Options</option>
                            <option value="1">Positively(<p class="mt-n3" style="font-size:smaller">encouraging or
                                    supportive</p>).</option>
                            <option value="2">Neutral</option>
                            <option value="3">Negatively <small>(concerned, annoyed, irritated, critical)</small>
                            </option>
                            <option value="4">Positively and negatively.</option>
                            <option value="5">No reaction.</option>

                        </select>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-1 ms-3">6.</p>
                        <div class="col-lg-8 ms-n5">
                            <p class="">Length of your "highs" as a rule (on the average)</p>
                            <p class="mt-n3" style="font-size:smaller">Please mark only one of the following.</p>
                        </div>

                        <select class="custom-select col-lg-3 rounded-5 my-4" id="q2">
                            <option selected>Options</option>
                            <option value="1">1 day</option>
                            <option value="2">2-3 days</option>
                            <option value="3">4-7 days</option>
                            <option value="4">Longer than 1 week</option>
                            <option value="5">Longer than 1 month</option>
                            <option value="6">I can't judge/don't know</option>

                        </select>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-1 ms-3">7.</p>
                        <div class="col-lg-8 ms-n5">
                            <p class="">Have you experienced such "highs" in the past twelve months?</p>
                            <p class="mt-n3" style="font-size:smaller">Please mark only one of the following.</p>
                        </div>

                        <select class="custom-select col-lg-3 rounded-5 my-4" id="q2">
                            <option selected>Options</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>


                        </select>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-1 ms-3">8.</p>
                        <div class="col-lg-8 ms-n5">
                            <p class="">If yes, please estimate how many days you spent in "highs" during the last 12
                                months.</p>

                        </div>
                        <div class="custom-form col-lg-3 rounded-4 ">
                            <input type="number" id="typeNumber" class="form-control" placeholder="Number of days" min=1
                                oninput="validity.valid||(value='');" />

                        </div>
                    </div>
                    <div class="text-center">
                        <input type="int" value="0" name="total" id="total" hidden>
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