<?php include 'db3.php'; ?>
<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
    <style>
        /* Keyframes for fade-in animation */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Apply animation to cards */
        .card {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container my-5">
        <div class="row">
            <!-- First Column (1:3 ratio) -->
            <div class="col-md-5">
                <div class="card mb-4">
                    <!-- Image placed on top of the header -->
                    <img src="img/info.png" alt="Mental Health Infographics" class="card-img-top">
                </div>
            </div>

            <!-- Second Column (1:3 ratio) -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <img src="img/mental2.png" alt="Mental Health Infographics" class="card-img-top">

                    <div class="card-body">
                        <h2 class="card-title">About Mental Health</h2>
                        <p class="card-text">
                            Mental health is an essential part of overall well-being. It refers to our emotional, psychological, and social well-being.
                            Good mental health allows us to cope with daily stresses, maintain fulfilling relationships, and work productively.
                            It's important to prioritize mental health and seek help if you or someone you know is struggling with mental health issues.
                        </p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Bipolar Disorder</h2>
                        <p class="card-text">
                            Bipolar disorder, also known as manic depression, is a mental health condition characterized by extreme mood swings that include emotional highs (mania or hypomania) and lows (depression).
                            Mania is a period of unusually elevated mood, energy, and activity, while depression is a period of overwhelming sadness, low energy, and loss of interest in activities.
                            Bipolar disorder can significantly affect a person's ability to function in daily life, but with proper diagnosis and treatment, individuals can manage their symptoms and lead fulfilling lives.
                        </p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Common Symptoms of Bipolar Disorder</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Feeling extremely happy or euphoric</li>
                            <li class="list-group-item">Having excessive energy and restlessness</li>
                            <li class="list-group-item">Engaging in risky behavior</li>
                            <li class="list-group-item">Feeling sad or hopeless</li>
                            <li class="list-group-item">Loss of interest in activities</li>
                            <li class="list-group-item">Changes in sleep patterns</li>
                            <li class="list-group-item">Difficulty concentrating</li>
                            <li class="list-group-item">Thoughts of suicide</li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Seeking Help</h3>
                        <p class="card-text">
                            If you or someone you know is experiencing symptoms of bipolar disorder or any other mental health condition, it's essential to seek help from a mental health professional.
                            Treatment options may include medication, therapy, and lifestyle changes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script.php'; ?>

</body>

</html>