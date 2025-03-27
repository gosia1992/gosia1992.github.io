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
$message = $_POST['message'];

// insert the form data into the database
$sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

if (mysqli_query($conn, $sql)) {
    // send email with new data
    $to = 's.lutschinger@gmail.com'; // update with your email address
    $subject = 'New Feedback Form Submission';
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    mail($to, $subject, $body);
    
    echo "Form data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close the database connection
mysqli_close($conn);

?>
