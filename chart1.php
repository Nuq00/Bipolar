<?php
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Assuming you have a database connection established

// Calculate the total number of booking sessions
$a = 37;
$b = 41;
$c = 45;
$d = 54;
$e = 59;
$f = 75;
$j = 30;
$q = 58;
for ($k = 1; $k <= 42; $k++) {

    if ($k == 1) {

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['count'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=1");
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $mwtu = $result2['count2'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=2");
        $stmt3->execute();
        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $wtu = $result3['count3'];

        $stmt4 = $conn->prepare("SELECT COUNT(*) AS count4 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=3");
        $stmt4->execute();
        $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $alwtu = $result4['count4'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count5 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=4");
        $stmt3->execute();
        $result5 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $nbtu = $result5['count5'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) AS count6 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=5");
        $stmt2->execute();
        $result6 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $albtu = $result6['count6'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count7 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=6");
        $stmt3->execute();
        $result7 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $btu = $result7['count7'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count8 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=7");
        $stmt3->execute();
        $result8 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $mbtu = $result8['count8'];



        $percent = ($mwtu / $total) * 100;
        $percent1 = ($wtu / $total) * 100;
        $percent2 = ($alwtu / $total) * 100;
        $percent3 = ($nbtu / $total) * 100;
        $percent4 = ($albtu / $total) * 100;
        $percent5 = ($btu / $total) * 100;
        $percent6 = ($mbtu / $total) * 100;
        $percent7 = 100 - $percent - $percent2 - $percent3 - $percent4 - $percent5 - $percent6 - $percent1;
?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Much Worse than usual', 'Worse than usual', 'Little worse than usual', 'Neither better nor worse', 'Little better than usual', 'Better than usual', 'Much better than usual', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
                        data: [
                            <?php echo number_format($percent, 2); ?>,
                            <?php echo number_format($percent1, 2); ?>,
                            <?php echo number_format($percent2, 2); ?>,
                            <?php echo number_format($percent3, 2); ?>,
                            <?php echo number_format($percent4, 2); ?>,
                            <?php echo number_format($percent5, 2); ?>,
                            <?php echo number_format($percent6, 2); ?>,
                            <?php echo number_format($percent7, 2); ?>
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
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
    <?php
    } elseif ($k == 2) {

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['count'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=8");
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $mwtu = $result2['count2'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=9");
        $stmt3->execute();
        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $wtu = $result3['count3'];

        $stmt4 = $conn->prepare("SELECT COUNT(*) AS count4 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=10");
        $stmt4->execute();
        $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $alwtu = $result4['count4'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count5 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=11");
        $stmt3->execute();
        $result5 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $nbtu = $result5['count5'];


        $percent = ($mwtu / $total) * 100;
        $percent1 = ($wtu / $total) * 100;
        $percent2 = ($alwtu / $total) * 100;
        $percent3 = ($nbtu / $total) * 100;
        $percent4 = 100 - $percent - $percent1 - $percent2 - $percent3;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Always rather stable and even', 'Generally Higher', 'Generally Lower', 'Repeatedly shows periods up and down', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
                        data: [
                            <?php echo number_format($percent, 2); ?>,
                            <?php echo number_format($percent1, 2); ?>,
                            <?php echo number_format($percent2, 2); ?>,
                            <?php echo number_format($percent3, 2); ?>,
                            <?php echo number_format($percent4, 2); ?>

                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
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
    <?php
    } elseif ($k == 3) {

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['count'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=12");
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $yes = $result2['count2'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=13");
        $stmt3->execute();
        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $no = $result3['count3'];

        $percent = ($yes / $total) * 100;
        $percent2 = ($no / $total) * 100;
        $percent3 = 100 - $percent - $percent2;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php
    } elseif ($k == 4) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=33");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=34");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k >= 5 && $k <= 11) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($j+$k)");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=(1+$j+$k)");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $j++;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k == 12) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=49");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=56");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k >= 13 && $k <= 15) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($a+$k)");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=(1+$a+$k)");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $a++;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k >= 16 && $k <= 19) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($b+$k)");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=(1+$b+$k)");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $b++;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k == 20) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=65");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=90");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k >= 21 && $k <= 27) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($c+$k)");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=(1+$c+$k)");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $c++;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k >= 28 && $k <= 31) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($d+$k)");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=(1+$d+$k)");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $d++;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k >= 32 && $k <= 33) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($e+$k)");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=(1+$e+$k)");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $e++;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k >= 34 && $k <= 35) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($f+$k)");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=(1+$f+$k)");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $f++;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
    <?php

    } elseif ($k == 36) {

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['count'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=14");
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $mwtu = $result2['count2'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=15");
        $stmt3->execute();
        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $wtu = $result3['count3'];

        $stmt4 = $conn->prepare("SELECT COUNT(*) AS count4 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=16");
        $stmt4->execute();
        $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $alwtu = $result4['count4'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count5 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=17");
        $stmt3->execute();
        $result5 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $nbtu = $result5['count5'];


        $percent = ($mwtu / $total) * 100;
        $percent1 = ($wtu / $total) * 100;
        $percent2 = ($alwtu / $total) * 100;
        $percent3 = ($nbtu / $total) * 100;
        $percent4 = 100 - $percent - $percent1 - $percent2 - $percent3;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Positive and Negative', 'Positive', 'Negative', 'No Impact', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
                        data: [
                            <?php echo number_format($percent, 2); ?>,
                            <?php echo number_format($percent1, 2); ?>,
                            <?php echo number_format($percent2, 2); ?>,
                            <?php echo number_format($percent3, 2); ?>,
                            <?php echo number_format($percent4, 2); ?>

                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
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
    <?php
        // Question 37-39
    } elseif ($k >= 37 && $k <= 39) {

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['count'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($q+$k)");
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $mwtu = $result2['count2'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($q+$k+1)");
        $stmt3->execute();
        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $wtu = $result3['count3'];

        $stmt4 = $conn->prepare("SELECT COUNT(*) AS count4 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($q+$k+2)");
        $stmt4->execute();
        $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $alwtu = $result4['count4'];

        $stmt5 = $conn->prepare("SELECT COUNT(*) AS count5 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=($q+$k+3)");
        $stmt5->execute();
        $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
        $nbtu = $result5['count5'];

        $q = $q + 3;
        $percent = ($mwtu / $total) * 100;
        $percent1 = ($wtu / $total) * 100;
        $percent2 = ($alwtu / $total) * 100;
        $percent3 = ($nbtu / $total) * 100;
        $percent4 = 100 - $percent - $percent1 - $percent2 - $percent3;

    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Positive and Negative', 'Positive', 'Negative', 'No Impact', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
                        data: [
                            <?php echo number_format($percent, 2); ?>,
                            <?php echo number_format($percent1, 2); ?>,
                            <?php echo number_format($percent2, 2); ?>,
                            <?php echo number_format($percent3, 2); ?>,
                            <?php echo number_format($percent4, 2); ?>

                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
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
    <?php
    } elseif ($k == 40) {

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['count'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=18");
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $mwtu = $result2['count2'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(19)");
        $stmt3->execute();
        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $wtu = $result3['count3'];

        $stmt4 = $conn->prepare("SELECT COUNT(*) AS count4 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(20)");
        $stmt4->execute();
        $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $alwtu = $result4['count4'];

        $stmt5 = $conn->prepare("SELECT COUNT(*) AS count5 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(21)");
        $stmt5->execute();
        $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
        $nbtu = $result5['count5'];

        $stmt6 = $conn->prepare("SELECT COUNT(*) AS count6 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(22)");
        $stmt6->execute();
        $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
        $wnbtu = $result6['count6'];


        $percent = ($mwtu / $total) * 100;
        $percent1 = ($wtu / $total) * 100;
        $percent2 = ($alwtu / $total) * 100;
        $percent3 = ($nbtu / $total) * 100;
        $percent4 = ($wnbtu / $total) * 100;
        $percent5 = 100 - $percent - $percent1 - $percent2 - $percent3 - $percent4;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Positively', 'Neutral', 'Negatively', 'Positively and Negatively', 'No Reaction', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
                        data: [
                            <?php echo number_format($percent, 2); ?>,
                            <?php echo number_format($percent1, 2); ?>,
                            <?php echo number_format($percent2, 2); ?>,
                            <?php echo number_format($percent3, 2); ?>,
                            <?php echo number_format($percent4, 2); ?>,
                            <?php echo number_format($percent5, 2); ?>


                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
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
    <?php
    } elseif ($k == 41) {

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['count'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=23");
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $mwtu = $result2['count2'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(24)");
        $stmt3->execute();
        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $wtu = $result3['count3'];

        $stmt4 = $conn->prepare("SELECT COUNT(*) AS count4 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(25)");
        $stmt4->execute();
        $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $alwtu = $result4['count4'];

        $stmt3 = $conn->prepare("SELECT COUNT(*) AS count5 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(26)");
        $stmt3->execute();
        $result5 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $nbtu = $result5['count5'];

        $stmt4 = $conn->prepare("SELECT COUNT(*) AS count5 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(27)");
        $stmt4->execute();
        $result6 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $wnbtu = $result6['count5'];

        $stmt4 = $conn->prepare("SELECT COUNT(*) AS count5 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(28)");
        $stmt4->execute();
        $result6 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $ty = $result6['count5'];


        $percent = ($mwtu / $total) * 100;
        $percent1 = ($wtu / $total) * 100;
        $percent2 = ($alwtu / $total) * 100;
        $percent3 = ($nbtu / $total) * 100;
        $percent4 = ($wnbtu / $total) * 100;
        $percent5 = ($ty / $total) * 100;

        $percent6 = 100 - $percent - $percent1 - $percent2 - $percent3 - $percent4 - $percent5;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['1 day', '2-3 days', '4-7 days', 'Longer than 1 week', 'Longer than 1 month', 'I dont know', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
                        data: [
                            <?php echo number_format($percent, 2); ?>,
                            <?php echo number_format($percent1, 2); ?>,
                            <?php echo number_format($percent2, 2); ?>,
                            <?php echo number_format($percent3, 2); ?>,
                            <?php echo number_format($percent4, 2); ?>,
                            <?php echo number_format($percent5, 2); ?>,
                            <?php echo number_format($percent6, 2); ?>



                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
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
    <?php
    } elseif ($k ==42) {
        try {

            $stmt4 = $conn->prepare("SELECT COUNT(*) AS count FROM response_list WHERE fld_question_ID = $k");
            $stmt4->execute();
            $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $total = $result['count'];

            $stmt5 = $conn->prepare("SELECT COUNT(*) AS count2 FROM response_list WHERE fld_question_ID = $k AND fld_answer_ID=(107)");
            $stmt5->execute();
            $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $yes = $result5['count2'];

            $stmt6 = $conn->prepare("SELECT COUNT(*) AS count3 FROM response_list WHERE fld_question_ID =$k AND fld_answer_ID=(108)");
            $stmt6->execute();
            $result6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $no = $result6['count3'];

            $percent = ($yes / $total) * 100;
            $percent2 = ($no / $total) * 100;
            $percent3 = 100 - $percent - $percent2;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $f++;
    ?>

        <script>
            // Get the canvas element
            var ctx = document.getElementById('myChart<?php echo $k ?>').getContext('2d');

            // Create the chart
            var myChart<?php echo $k ?> = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Yes', 'No', 'Blank'],
                    datasets: [{
                        label: 'Question <?php echo $k ?>',
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
                            max: 100,
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
<?php

    }
}
