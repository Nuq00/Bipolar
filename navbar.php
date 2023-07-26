<nav class="navbar navbar-expand-lg navbar-dark bg-dark m-2 rounded-7 shadow-4-strong ">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#">
            <img src="img/bipolars.png" height="30" alt="Bipolar" loading="lazy" />
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <div class="dropdown">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="counselling" data-mdb-toggle="dropdown" aria-expanded="false">Counselling</a>
                        <ul class="dropdown-menu" aria-labelledby="counselling">
                            <li><a class="dropdown-item" href="#">Counsellors</a></li>
                            <li><a class="dropdown-item" href="#">Staffs</a></li>
                            <li><a class="dropdown-item" href="#">Metntal Health Awareness</a></li>
                        </ul>
                    </li>
                </div>
                <?php if ($category == 'Client') { ?>
                    <div class="dropdown">
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" id="instrument" data-mdb-toggle="dropdown" aria-expanded="false" href="#">Instrument</a>
                            <ul class="dropdown-menu" aria-labelledby="instrument">
                                <li><a class="dropdown-item" type="button" data-mdb-toggle="modal" data-mdb-target="#bipolar">Bipolars</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><button class="dropdown-item" type="button">Feedback Form</button></li>
                            </ul>
                        </li>
                    </div>
                <?php } ?>
                <!-- Modal Start -->
                <div class="modal top fade" id="bipolar" tabindex="-1" aria-labelledby="bipolar" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="false">
                    <div class="modal-dialog  ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Disclaimer</h5>
                            </div>
                            <div class="modal-body px-3" align="justify">

                                <p>The questionnaires are provided by the UKM Counsellors. The purpose
                                    of the questionnaire
                                    is to help the user and counsellor to gain instant result. <u>However, this
                                        questionnaire can't be taken
                                        into consideration without the advice from the counsellors.
                                    </u></p>
                                <hr class="hr my-3">
                                <p>Please read the terms and condition provided by the UKM Counsellors below.</p>
                                <form action="bipolar_instrument.php" method="post">
                                    <div class="form-check mb-3 mt-4">
                                        <input class="form-check-input" type="checkbox" value="#" id="bipolarcheckbox" required />
                                        <label class="form-check-label" for="bipolarcheckbox">I agree with the terms
                                            and
                                            condition (T&C)</label>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                                        Close
                                    </button>
                                    <button class="btn btn-primary" type="submit">Confirm</button>
                                </form>



                            </div>

                        </div>
                    </div>
                </div>


                <!-- Modal End -->

                <li class="nav-item">
                    <a class="nav-link" href="history.php">Counselling History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-mdb-toggle="modal" data-mdb-target="#appointment">Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="result_list2.php">Result</a>
                </li>
                <?php if ($category == 'Admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="staff.php">Staff</a>
                    </li>
                <?php }
                if ($category == 'Admin' || $category == 'Counsellor') { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="regClient.php">Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="booking_list.php">Session</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="overview.php">Overview</a>
                    </li>
                <?php } ?>
                <div class="modal fade" id="appointment" tabindex="-1" aria-labelledby="appointment" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Make an Appointment</h5>
                            </div>
                            <form action="process_booking.php" method="post">
                                <div class="modal-body">

                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" placeholder="Date" id="booking_date" name="booking_date" required min="<?php echo date('Y-m-d'); ?>" onchange="disableWeekends(this)">
                                        </div>
                                        <script>
                                            function disableWeekends(input) {
                                                const selectedDate = new Date(input.value);
                                                const today = new Date();
                                                const minSelectableDate = new Date();
                                                minSelectableDate.setDate(today.getDate() + 7);

                                                const day = selectedDate.getDay();

                                                if (day === 0 || day === 6) {
                                                    input.setCustomValidity('Please choose a weekday');
                                                } else if (selectedDate < minSelectableDate) {
                                                    input.setCustomValidity('Please choose a date after ' + minSelectableDate.toLocaleDateString() +' which a week from now.');
                                                } else {
                                                    input.setCustomValidity('');
                                                }
                                            }
                                        </script>

                                        <div class="col-lg-6">
                                            <select class="form-select" aria-label="Time" id="session_time" name="session_time" required>
                                                <option selected>Time</option>
                                                <option value="10:00:00">10:00AM</option>
                                                <option value="11:00:00">11:00AM</option>
                                                <option value="12:00:00">12:00PM</option>
                                                <option value="13:00:00">1:00PM</option>
                                                <option value="14:00:00">2:00PM</option>
                                                <option value="15:00:00">3:00PM</option>
                                                <option value="16:00:00">4:00PM</option>
                                                <option value="17:00:00">5:00PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if ($category != 'Client') {
                                        try {
                                            // create connection with database
                                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                            // fetch data from the table question_list



                                            $stmt2 = $conn->prepare("SELECT * FROM counselling LEFT JOIN user_data ON user_data.fld_userID = counselling.fld_user_ID WHERE counselling.fld_staff_ID = '$ID'");
                                            $stmt2->execute();
                                            $counselling = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                                            //fetch data from the anwer_list
                                        } catch (PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        } ?>
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <label for="clientMatric" class="form-label">Matric Number:</label>
                                                <select class="form-select" aria-label="client" id="clientMatric" name="clientMatric">
                                                    <option selected disabled>Choose</option>
                                                    <?php foreach ($counselling as $coun) { ?>
                                                        <option value="<?php echo $coun['fld_user_ID'] ?>"><?php echo $coun['fld_user_ID'] . " &nbsp;,&nbsp;&nbsp;&nbsp;" . $coun['fld_username'] ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>

                                        </div>
                                    <?php } else { ?>
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <label for="matric" class="form-label">Matric Number:</label>
                                                <input type="text" class="form-control" id="labelMatrik" name="matric" readonly value="<?php echo $ID ?>" disabled>

                                            </div>

                                        </div>
                                    <?php } ?>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="form-label">Name:</label>
                                            <input type="text" class="form-control" readonly value="<?php echo $name ?>" disabled>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="form-label">Email:</label>
                                            <input type="text" class="form-control" readonly value="<?php echo $email ?>" aria-label="readonly input example" disabled>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="form-label">Appointment Place:</label>
                                            <input type="text" class="form-control" readonly value="Counseling Room" disabled>

                                        </div>
                                    </div>

                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Book Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </ul>
        </div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center align-item-center" loading="lazy">

            <li class="nav-item">
                <a class="nav-link" data-mdb-toggle="modal" data-mdb-target="#profile_modal"><?php echo $name ?></a>
            </li>


            <!-- Modal -->
            <div class="modal top fade" id="profile_modal" tabindex="-1" aria-labelledby="profile_modal" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="ms-4 modal-title"><?php echo $name . "'s Profile" ?></h1>
                        </div>

                        <div class="  mx-4 modal-body">

                            <label for="id">
                                <h4>User ID:</h4>
                            </label>
                            <input class="form-control" type="text" id="id" name="id" value="<?php echo $ID; ?>" readonly><br>

                            <label for="fullname">
                                <h4>Full Name:</h4>
                            </label>
                            <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $name; ?>" readonly><br>

                            <label for="email">
                                <h4>Email:</h4>
                            </label>
                            <input class="form-control" type="email" id="email" name="email" value="<?php echo $email; ?>" readonly><br>

                            <label for="contact">
                                <h4>Contact:</h4>
                            </label>
                            <input class="form-control" type="text" id="contact" name="contact" value="<?php echo $contact; ?>" readonly><br>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                                Close
                            </button>
                            <div class=" d-flex justify-content-end "><a class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#change_password">Change Password</a></div>

                            <div class=" d-flex justify-content-end "><a class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#profile_edit">Edit Profile</a></div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal top fade" id="profile_edit" tabindex="-1" aria-labelledby="profile_edit" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="ms-4 modal-title"><?php echo "Edit " . $name . "'s Profile" ?></h1>
                        </div>
                        <form method="post" action="edit_profile.php">
                            <div class="  mx-4 modal-body">

                                <label for="id">
                                    <h4>User ID:</h4>
                                </label>
                                <input class="form-control" type="text" id="id" name="id" value="<?php echo $ID; ?>" readonly><br>

                                <label for="fullname">
                                    <h4>Full Name:</h4>
                                </label>
                                <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $name; ?>" required><br>

                                <label for="email">
                                    <h4>Email:</h4>
                                </label>
                                <input class="form-control" type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

                                <label for="contact">
                                    <h4>Contact:</h4>
                                </label>
                                <input class="form-control" type="text" id="contact" name="contact" value="<?php echo $contact; ?>" required><br>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                                    Close
                                </button>
                                <div class=" d-flex justify-content-end "><button class="btn btn-primary" type="submit">Save Changes</button></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal top fade" id="change_password" tabindex="-1" aria-labelledby="change_password" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="ms-4 modal-title"><?php echo "Edit " . $name . "'s Profile" ?></h1>
                        </div>
                        <form method="post" action="change_password.php">
                            <div class="  mx-4 modal-body">

                                <label for="password1">
                                    <h4>Old Password:</h4>
                                </label>
                                <input class="form-control" type="password" id="password1" name="password1" required><br>

                                <label for="pasword2">
                                    <h4>New Password:</h4>
                                </label>
                                <input class="form-control" type="password" id="password2" name="password2" required><br>

                                <label for="pasword3">
                                    <h4>Confirm Password:</h4>
                                </label>
                                <input class="form-control" type="password" id="password3" name="password3" required><br>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                                    Close
                                </button>
                                <div class=" d-flex justify-content-end "><button class="btn btn-primary" type="submit">Save Changes</button></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <li class="nav-tem">
                <a class="btn btn-danger btn-sm btn-rounded small mt-2" href="logout.php"><i class="fas fa-power-off"></i></a>
            </li>
        </ul>
    </div>
</nav>