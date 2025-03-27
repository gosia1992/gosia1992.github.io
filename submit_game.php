<?php

// connect to the database
$servername = "localhost"; // update with your database server name
$username = "digitalmedialab"; // update with your database username
$password = ""; // leave empty
$dbname = "my_digitalmedialab"; // update with your database name
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$question1 = $_POST['question1'];
$question2 = $_POST['question2'];
$question3 = isset($_POST['question3']) ? implode(", ", $_POST['question3']) : "";

// Retrieve correct answers from the "winning_conditions" table
$result = $conn->query("SELECT * FROM winning_conditions WHERE id = 1");
$winning_conditions = $result->fetch_assoc();

// Check answers
$correctCount = 0;
if ($question1 == $winning_conditions['question1_answer']) {
    $correctCount++;
}
if ($question2 == $winning_conditions['question2_answer']) {
    $correctCount++;
}
if ($question3 == $winning_conditions['question3_answer']) {
    $correctCount++;
}

// Insert the form data into the database
$sql = "INSERT INTO game_results (name, email, question1, question2, question3) VALUES ('$name', '$email', '$question1', '$question2', '$question3')";

if (mysqli_query($conn, $sql)) {
    echo "<p>Game results inserted successfully.</p>";
} else {
    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
}

// Output results
echo "<p>You got $correctCount out of 3 questions correct.</p>";

// Decide what to display based on the number of correct answers
if ($correctCount == 3) {
    echo "<p>Congratulations! You've passed the test!</p>";
} else {
    echo "<p>Sorry, you didn't pass. Try again!</p>";
}

// close the database connection
mysqli_close($conn);

?>
