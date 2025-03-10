<?php
include('connection.php');

// Get updated data from form submission
$schedule_id = $_POST['schedule_id'];
$day_of_week = $_POST['day_of_week'];
$time_slot = $_POST['time_slot'];
$subject_name = $_POST['subject_name'];
$subject_color = $_POST['subject_color'];
$room_number = $_POST['room_number'] ?? '';
$teacher_name = $_POST['teacher_name'] ?? '';
$notes = $_POST['notes'] ?? '';

// Sanitize inputs to prevent SQL injection
$schedule_id = mysqli_real_escape_string($connection, $schedule_id);
$day_of_week = mysqli_real_escape_string($connection, $day_of_week);
$time_slot = mysqli_real_escape_string($connection, $time_slot);
$subject_name = mysqli_real_escape_string($connection, $subject_name);
$subject_color = mysqli_real_escape_string($connection, $subject_color);
$room_number = mysqli_real_escape_string($connection, $room_number);
$teacher_name = mysqli_real_escape_string($connection, $teacher_name);
$notes = mysqli_real_escape_string($connection, $notes);

// Update the schedule in the database
$query = "UPDATE tb_schedules SET 
        day_of_week = '$day_of_week', 
        time_slot = '$time_slot',
        subject_name = '$subject_name',
        subject_color = '$subject_color',
        room_number = '$room_number',
        teacher_name = '$teacher_name',
        notes = '$notes'
        WHERE schedule_id = '$schedule_id'";

if($connection->query($query)) {
    header("location: index.php");
} else {
    echo "Failed updating data: " . $connection->error;
}
?>