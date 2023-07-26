<?php
include_once 'db3.php';
include_once 'session.php';
?>

<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <!--Main Navigation-->


    <!-- Section: Split screen -->
    <section class="">

        <div class="container-fluid px-0">
            <div class="row g-0">

                <!-- First column -->
                <div class="col-lg-6 vh-100 d-flex flex-column justify-content-center align-items-center">

                    <!-- Headings -->
                    <div class="h-100 d-flex justify-content-center align-items-center px-5">

                        <div class="">
                            <h2 class="display-4"><?php echo $name ?></h2>
                            <h1 class="display-2 fw-bold text-uppercase"><?php echo $category ?></h1>
                        </div>

                    </div>

                    <!-- CTA elements -->
                    <div class="d-flex align-items-center w-100 justify-content-between  px-5 mb-5">
                        <a href="https://github.com/mdbootstrap/mdb-ui-kit" target="_blank" class="text-dark"><img src="img/bipolar.png" style="width:30%;"></a>
                        <hr class="hr d-none d-xl-flex" style="height: 2px; width: 200px;">
                        <div class="d-flex align-tem-center w-10 justify-content-between mx-0">
                            <a class="btn btn-primary btn-lg btn-rounded mx-2" href="logout.php" role="button">Logout</a>
                            <a class="btn btn-primary btn-lg btn-rounded mx-2" href="home.php" role="button">Login</a>
                        </div>

                    </div>

                </div>
                <!-- First column -->

                <!-- Second column -->
                <div class="col-lg-6 d-none d-lg-inline-block vh-100">

                    <!-- Carousel wrapper -->
                    <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="rounded-circle active" style="width: 7px; height: 7px" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1" aria-label="Slide 2" class="rounded-circle" style="width: 7px; height: 7px"></button>
                            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2" aria-label="Slide 3" class="rounded-circle" style="width: 7px; height: 7px"></button>
                        </div>

                        <!-- Inner -->
                        <div class="carousel-inner shadow-5-strong" style="border-bottom-left-radius: 4rem">
                            <!-- Single item -->
                            <div class="carousel-item active">
                                <img src="https://mdbootstrap.com/img/new/textures/full/243.jpg" class="d-block vh-100 vw-100 object-cover" alt="15 years of experience in the IT industry" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>15 years of experience in the IT industry</h5>
                                    <p>I am in love with technology and have spent half my life developing it</p>
                                </div>
                            </div>

                            <!-- Single item -->
                            <div class="carousel-item">
                                <img src="https://mdbootstrap.com/img/new/textures/full/102.jpg" class="d-block vh-100 vw-100 object-cover" alt="243 completed projects" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>243 completed projects</h5>
                                    <p>I love challenges and treat each project as my own</p>
                                </div>
                            </div>

                            <!-- Single item -->
                            <div class="carousel-item">
                                <img src="https://mdbootstrap.com/img/new/textures/full/107.jpg" class="d-block vh-100 vw-100 object-cover" alt="53 satisfied customers" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>53 satisfied customers</h5>
                                    <p>There is no better reward for me than a happy customer</p>
                                </div>
                            </div>
                        </div>
                        <!-- Inner -->

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- Carousel wrapper -->

                </div>
                <!-- Second column -->

            </div>
        </div>


    </section>
    <!-- Section: Split screen -->


    <!--Main Navigation-->

    <!--Main layout-->

    <?php include_once 'script.php'; ?>
</body>

</html>