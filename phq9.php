<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <?php include_once 'navbar.php'; ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between my-4">
            <h1 class="h3 mb-0 text-light-800">PHQ-9 Patent Health Questionaire</h1>
        </div>
        <div class="card shadow-7 mb-5">
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
            <div class="card-title text-center pt-5">
                <h4>Over the <u>last 2 weeks</u> how often have you been bothered by any of the following problems?</h4>
            </div>

            <div class="card-body">
                <form action="result.php" method="post">
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4 " align="justify">1. Kurang minat dan tarikan terhadap perkara yang
                            dilakukan.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly" align="justify">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q1" id="q1_1" value="1">
                                <label class="form-check-label" for="q1_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q1" id="q1_2" value="2">
                                <label class="form-check-label" for="q1_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q1" id="q1_3" value="3">
                                <label class="form-check-label" for="q1_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q1" id="q1_4" value="4">
                                <label class="form-check-label" for="q1_4">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4" align="justify">2. Rasa murung,
                            tidak
                            bermaya dan berdaya.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly" align="justify">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q2" id="q2_1" value="1">
                                <label class="form-check-label" for="q2_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q2" id="q2_2" value="2">
                                <label class="form-check-label" for="q2_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q2" id="q2_3" value="3">
                                <label class="form-check-label" for="q2_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q2" id="q2_4" value="4">
                                <label class="form-check-label" for="q2_4">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4" align="justify">3. Mampunyai
                            masalah
                            tidur atau tidur berlebihan.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly" align="justify">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q3" id="q3_1" value="1">
                                <label class="form-check-label" for="q3_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q3" id="q3_2" value="2">
                                <label class="form-check-label" for="q3_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q3" id="q3_3" value="3">
                                <label class="form-check-label" for="q3_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q3" id="q3_3" value="4">
                                <label class="form-check-label" for="q3_3">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4" align="justify">4. Rasa kurang
                            bertenaga dan tidak bermaya.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly" align="justify">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q4" id="q4_1" value="1">
                                <label class="form-check-label" for="q4_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q4" id="q4_2" value="2">
                                <label class="form-check-label" for="q4_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q4" id="q4_3" value="3">
                                <label class="form-check-label" for="q4_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q4" id="q4_4" value="4">
                                <label class="form-check-label" for="q4_4">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4" align="justify">5. Kurang selera
                            makan
                            atau makan berlebihan.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly" align="justify">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q5" id="q5_1" value="1">
                                <label class="form-check-label" for="q5_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q5" id="q5_2" value="2">
                                <label class="form-check-label" for="q5_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q5" id="q5_3" value="3">
                                <label class="form-check-label" for="q5_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q5" id="q5_4" value="4">
                                <label class="form-check-label" for="q5_4">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4" align="justify">6. Rasa diri teruk
                            atau
                            merasakan diri anda sebagai seorang yang telah menghampakan
                            keluarga.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly" align="justify">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q6" id="q6_1" value="1">
                                <label class="form-check-label" for="q6_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="q6_2"
                                    value="2">
                                <label class="form-check-label" for="q6_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="q6_3"
                                    value="3">
                                <label class="form-check-label" for="q6_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="q6_4"
                                    value="4">
                                <label class="form-check-label" for="q6_4">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4" align="justify">7. Mempunyai
                            masalah
                            dalam menumpukan perhatian seperti membaca surat khabar atau menonton
                            televisyen.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly" align="justify">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q7" id="q7_1" value="1">
                                <label class="form-check-label" for="q7_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q7" id="q7_2" value="2">
                                <label class="form-check-label" for="q7_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q7" id="q7_3" value="3">
                                <label class="form-check-label" for="q7_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q7" id="q7_4" value="4">
                                <label class="form-check-label" for="q7_4">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4" align="justify">8. Bergerak atau
                            bercakap dengan perlahan supaya orang lain perasan. Atau sebaliknya -
                            rasa
                            resah kerana telah bergerak atau bercakap dengan banyak dari
                            kebiasaan.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly" align="justify">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q8" id="q8_1" value="1">
                                <label class="form-check-label" for="_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q8" id="q8_2" value="2">
                                <label class="form-check-label" for="q8_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q8" id="q8_3" value="3">
                                <label class="form-check-label" for="q8_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q8" id="q8_4" value="4">
                                <label class="form-check-label" for="q8_4">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr">
                    <div class="form-group row col-lg-12 my-4">
                        <p class="col-lg-4" align="justify">9. Perasaan untuk
                            bunuh
                            diri atau merasa ingin mencederakan diri sendiri.</p>
                        <div class="col-lg-8 d-flex justify-content-evenly">
                            <div class="form-check form-check-inline col-lg-2  ms-5 mx-4">
                                <input class="form-check-input" type="radio" name="q9" id="q9_1" value="1">
                                <label class="form-check-label" for="q9_1">Tidak Pernah</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q9" id="q9_2" value="2">
                                <label class="form-check-label" for="q9_2">Berberapa Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q9" id="q9_3" value="3">
                                <label class="form-check-label" for="q9_3">Lebih 7 Hari</label>
                            </div>
                            <div class="form-check form-check-inline col-lg-2 mx-4">
                                <input class="form-check-input" type="radio" name="q9" id="q9_4" value="4">
                                <label class="form-check-label" for="q9_4">Setiap Hari</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="int" value="0" name="total" id="total" hidden>
                        <button class="btn btn-primary col-lg-1 text-center" type="button" data-mdb-toggle="modal"
                            data-mdb-target="#confirmModal">Submit</button>
                    </div>
                    <div class="modal fade" name="confirmModal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmation"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmation">Confirmation</h5>
                        
                                </div>
                                <div class="modal-body">
                                    Are you sure to submit the form?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
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