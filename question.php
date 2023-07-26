<?php
// Assuming you have established a database connection

// Function to retrieve a random question from the database
function getRandomQuestion($connection)
{
    $query = "SELECT fld_question_ID, fld_question_name FROM question_list ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result);
}

// Function to retrieve answers for a given question from the database
function getQuestionAnswers($connection, $questionID)
{
    $query = "SELECT fld_answer_ID, fld_answer_name FROM answer_list WHERE fld_question_ID = $questionID";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have already validated and sanitized the user inputs
    $userID = $_POST['user_id'];

    // Iterate through the submitted answers
    foreach ($_POST['answers'] as $questionID => $answerID) {
        // Insert the response into the "response_list" table
        $query = "INSERT INTO response_list (fld_user_ID, fld_questionaire_ID, fld_question_ID, fld_answer_ID) VALUES ('$userID', '1', '$questionID', '$answerID')";
        mysqli_query($connection, $query);
    }

    // Redirect or show a success message to the user
    // header("Location: success.php");
    // exit();sdfsdf
}

// Get three random questions
$questions = [];
for ($i = 0; $i < 3; $i++) {
    $questions[] = getRandomQuestion($connection);
}
?>

<!-- HTML form -->
<form method="POST">
    <input type="hidden" name="user_id" value="1"> <!-- Assuming the user ID is fixed for this example -->

    <?php foreach ($questions as $question): ?>
        <h3>
            <?php echo $question['fld_question_name']; ?>
        </h3>

        <?php
        $answers = getQuestionAnswers($connection, $question['fld_question_ID']);
        foreach ($answers as $answer):
            ?>
            <label>
                <input type="radio" name="answers[<?php echo $question['fld_question_ID']; ?>]"
                    value="<?php echo $answer['fld_answer_ID']; ?>">
                <?php echo $answer['fld_answer_name']; ?>
            </label>
        <?php endforeach; ?>

        <br><br>
    <?php endforeach; ?>

    <button type="submit">Submit</button>
</form>