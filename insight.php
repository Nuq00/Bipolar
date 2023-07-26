<?php include_once 'db3.php';

include_once 'session.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    
        ...
    </nav>

    <div class="container-fluid">
        <div class=" row col-lg-12">
            <div class="col-lg-4">
                <canvas class="col-lg-4" id="myChart"></canvas>
            </div>
            <div class="col-lg-4">
                hi how are you
            </div>
        </div>
    </div>
    <?php
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Assuming you have a database connection established

    // Calculate the total number of booking sessions
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = 22");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $result['count'];

    $stmt2 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = 22 AND fld_answer_ID=68");
    $stmt2->execute();
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $yes = $result2['count2'];

    $stmt3 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID = 22 AND fld_answer_ID=69");
    $stmt3->execute();
    $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $no = $result3['count3'];

    $percent = ($yes / $total) * 100;
    $percent2 = ($no / $total) * 100;
    $percent3 = 100 - $percent - $percent2;

    ?>

    <script>
        // Get the canvas element
        var ctx = document.getElementById('myChart').getContext('2d');

        // Create the chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Yes', 'No', 'Blank'],
                datasets: [{
                    label: 'Question 22: I think Faster.',
                    data: [
                        <?php echo number_format($percent, 2); ?>,
                        <?php echo number_format($percent2, 2); ?>,
                        <?php echo number_format($percent3, 2); ?>
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '%'; // Append '%' to the tick values
                            }
                        }
                    }
                }
            }
        });
    </script>


</body>

</html>