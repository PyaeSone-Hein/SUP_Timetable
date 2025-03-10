<?php
// Include database connection
include('connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from addschedule form
    $dayOfWeek = $_POST['dayOfWeek'];
    $timeSlot = $_POST['timeSlot'];
    $subjectName = $_POST['subjectName'];
    $subjectColor = $_POST['subjectColor'];
    $roomNumber = $_POST['roomNumber'] ?? '';
    $teacherName = $_POST['teacherName'] ?? '';
    $notes = $_POST['notes'] ?? '';

    // Basic validation to ensure required data is not empty
    if (empty($dayOfWeek) || empty($timeSlot) || empty($subjectName) || empty($subjectColor)) {
        echo "Required fields are missing!";
        exit();
    }

    // Sanitize the input values to prevent SQL injection
    $dayOfWeek = mysqli_real_escape_string($connection, $dayOfWeek);
    $timeSlot = mysqli_real_escape_string($connection, $timeSlot);
    $subjectName = mysqli_real_escape_string($connection, $subjectName);
    $subjectColor = mysqli_real_escape_string($connection, $subjectColor);
    $roomNumber = mysqli_real_escape_string($connection, $roomNumber);
    $teacherName = mysqli_real_escape_string($connection, $teacherName);
    $notes = mysqli_real_escape_string($connection, $notes);

    // Insert data into the database
    $query = "INSERT INTO tb_schedules (day_of_week, time_slot, subject_name, subject_color, room_number, teacher_name, notes) 
              VALUES ('$dayOfWeek', '$timeSlot', '$subjectName', '$subjectColor', '$roomNumber', '$teacherName', '$notes')";

    // Execute query and check for errors
    if ($connection->query($query)) {
        header("location: index.php");
        exit();
    } else {
        echo "Failed Inserting Data: " . $connection->error;
    }
} else {
    echo "Form not submitted via POST method.";
}
?>