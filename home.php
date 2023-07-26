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
                <h2 class="fw-bold mb-7 text-center" style="font-family: 'Arimo', sans-serif;font-family: 'Konkhmer Sleokchher', cursive;">Sistem
                    Pengecaman Gejala Gangguan Bipolar</h2>
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
                                    <small>Finished <u>13.09.2021</u> for
                                        <a href="" class="text-Light">Techify</a></small>
                                </p>
                                <p class="card-text text-light">
                                    Ut pretium ultricies dignissim. Sed sit amet mi eget urna
                                    placerat vulputate. Ut vulputate est non quam dignissim
                                    elementum. Donec a ullamcorper diam.
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
                                <h5 class="card-title text-light">FAQ</h5>
                                <p class="">
                                    <small>Last Updated on <u>29.04.2023</u></small>
                                </p>
                                <p class="card-text" align="justify">
                                    Sistem Pengecaman Gejala Gangguan Bipolar adalah bertujuan untuk membantu pihak
                                    kaunselor serta klien dalam mengenal pasti masalah kesihatan mental di dalam
                                    kalangan pelajar dan kakitangan Universiti Kebangsaan Malaysia.
                                    Sistem ini ditubuhkan dengan fasiliti seperti Ujian Bipolar, Tempahan Temujanji
                                    bersama kaunselor dan juga dapat menghasilkan laporan ringkas dengan tujuan dapat
                                    membantu para kaunselor untuk menganalisis klien dengan lebih mudah.


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