<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "students_db"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Failed access to Database: " . $conn->connect_error);
}

$name = $_POST["name"];
$email = $_POST["email"];
$gender = $_POST["gender"];

$errors = array();

if (empty($name)) {
    $errors[] = "Full Name field cannot be left blank.";
}

if (empty($email)) {
    $errors[] = "Email Addess can't be empty.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Enter a valid Email Address.";
}

if (empty($gender)) {
    $errors[] = "Gender field cannot be left blank.";
}

if (empty($errors)) {
    $sql = "INSERT INTO students (name, email, gender)
            VALUES ('$name', '$email', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Successfully added to the database.";
    } else {
        echo "Data insertion error: " . $conn->error;
    }
} else {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Registered Students:</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Gender</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["gender"]."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "There are no registered student.";
}

$conn->close();

?>