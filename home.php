<?php
include_once 'db3.php';
include_once 'session.php';
?>

<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <?php include_once 'navbar.php'; ?>
    <header>

    </header>
    <main>
        <div class="container">

            <!-- Section: My projects -->
            <section class="mb-5 mt-5 text-center">
                <h2 class="fw-bold mb-7 text-center" style="font-family: 'Arimo', sans-serif; font-family: 'Konkhmer Sleokchher', cursive;">
                    <span style="color: black;">Bi</span><span style="color: #888;">Polars</span>
                </h2>
                <?php if ($contact == "") { ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center mb-6" role="alert">
                        <h5>Your Profile is incomplete, please update your profile.</h5>
                        <p>To update your profile, click on the your name at the top right corner.</p>
                    </div>
                <?php } ?>


                <div class="row gx-lg-5">

                    <!-- First column -->
                    <div class="col-lg-4 col-md-12 mb-5 mb-lg-0">

                        <div class="card rounded-6 h-100 bg-dark">
                            <div class="bg-image hover-overlay ripple mx-3 shadow-4-strong rounded-6 mt-n3" data-mdb-ripple-color="light">
                                <img src="https://mdbootstrap.com/img/new/textures/small/148.jpg" class="img-fluid" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body hover-overlay ripple shadow-6-strong">
                                <h5 class="card-title text-light">AI engine</h5>
                                <p class="text-light">
                                    <small>Finished <u>13.06.2023</u> for
                                        <a href="" class="text-Light">Final Year Project</a></small>
                                </p>
                                <p class="card-text text-light" align="justify">
                                    Your go-to resource for recognizing bipolar disorder.
                                    Access valuable information, self-assessment tools, and expert
                                    guidance to identify the signs and find support on your journey
                                    to well-being. You're not alone - take the first step today.
                                </p>
                                <a href="#!" class="btn btn-secondary btn-rounded">Read more</a>
                            </div>
                        </div>

                    </div>
                    <!-- First column -->

                    <!-- Second column -->
                    <div class="col-lg-8 mb-5 mb-lg-0 d-flex justify-content-center align-items-center">

                        <div class="card rounded-6 h-100 bg-dark ">
                            <div class="card-body text-light hover-overlay ripple shadow-6-strong">
                                <h5 class="card-title text-light">Objectives</h5>
                                <p class="">
                                    <small>Last Updated on <u>29.04.2023</u></small>
                                </p>
                                <p class="card-text" align="justify">
                                    Bipolar System is a specialized platform
                                    designed to support counselors and clients
                                    at the National University of Malaysia in
                                    identifying and addressing mental health
                                    issues among students and staff. This user-friendly
                                    system offers a range of valuable features, including
                                    the Bipolar Test, enabling individuals to self-assess
                                    and recognize potential bipolar disorder symptoms.
                                </p>
                                <p class="card-text" align="justify">
                                    Moreover, the platform facilitates seamless appointment
                                    booking with counselors, ensuring timely and personalized
                                    support for those in need. It goes even further by empowering
                                    counselors with the ability to generate concise reports,
                                    streamlining the analysis process and enhancing the overall
                                    counseling experience.
                                </p>
                                <p class="card-text" align="justify">
                                    With its comprehensive tools and resources, the Bipolar
                                    System aims to assist counselors in gaining deeper insights
                                    into their clients' mental health concerns, ultimately leading
                                    to more effective and targeted interventions. By fostering a
                                    supportive and proactive environment, the platform strives to
                                    improve the well-being and academic success of the university
                                    community. Together, counselors and clients can work towards a
                                    healthier and happier campus community at the National University
                                    of Malaysia.
                                </p>


                                <a href="#!" class="btn btn-secondary btn-rounded">Read more</a>
                            </div>
                        </div>

                    </div>


                </div>

            </section>
            <!-- Section: My projects -->

        </div>
    </main>
    <footer>

    </footer>
    <?php include_once 'script.php'; ?>
</body>

</html>