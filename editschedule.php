<?php
include('connection.php');

// Get the schedule ID from the query string
$id = $_GET['id'];

// Fetch the schedule data from the database
$query = "SELECT * FROM tb_schedules WHERE schedule_id = '$id'";
$result = mysqli_query($connection, $query);

// Check if the record exists
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
} else {
    die("Record not found.");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Schedule</title>
  </head>
  <body>
    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header bg-primary text-white">
              EDIT SCHEDULE
            </div>
            <div class="card-body">
              <form action="updateschedule.php" method="POST">
                <div class="form-group">
                  <label>Schedule ID</label>
                  <!-- The schedule ID is read-only -->
                  <input type="text" name="schedule_id" value="<?php echo $row['schedule_id']; ?>" class="form-control" readonly>
                </div>
                
                <div class="form-group">
                  <label>Day of Week</label>
                  <select name="day_of_week" class="form-control" required>
                    <option value="Monday" <?php if($row['day_of_week'] == 'Monday') echo 'selected'; ?>>Monday</option>
                    <option value="Tuesday" <?php if($row['day_of_week'] == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                    <option value="Wednesday" <?php if($row['day_of_week'] == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                    <option value="Thursday" <?php if($row['day_of_week'] == 'Thursday') echo 'selected'; ?>>Thursday</option>
                    <option value="Friday" <?php if($row['day_of_week'] == 'Friday') echo 'selected'; ?>>Friday</option>
                    <option value="Saturday" <?php if($row['day_of_week'] == 'Saturday') echo 'selected'; ?>>Saturday</option>
                    <option value="Sunday" <?php if($row['day_of_week'] == 'Sunday') echo 'selected'; ?>>Sunday</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Time Slot</label>
                  <input type="text" name="time_slot" value="<?php echo $row['time_slot']; ?>" class="form-control" required>
                </div>
                
                <div class="form-group">
                  <label>Subject Name</label>
                  <input type="text" name="subject_name" value="<?php echo $row['subject_name']; ?>" class="form-control" required>
                </div>
                
                <div class="form-group">
                  <label>Subject Color</label>
                  <select name="subject_color" class="form-control" required>
                    <option value="#ff9999" <?php if($row['subject_color'] == '#ff9999') echo 'selected'; ?>>Red</option>
                    <option value="#99ccff" <?php if($row['subject_color'] == '#99ccff') echo 'selected'; ?>>Blue</option>
                    <option value="#99ff99" <?php if($row['subject_color'] == '#99ff99') echo 'selected'; ?>>Green</option>
                    <option value="#ffff99" <?php if($row['subject_color'] == '#ffff99') echo 'selected'; ?>>Yellow</option>
                    <option value="#cc99ff" <?php if($row['subject_color'] == '#cc99ff') echo 'selected'; ?>>Purple</option>
                    <option value="#ffcc99" <?php if($row['subject_color'] == '#ffcc99') echo 'selected'; ?>>Orange</option>
                    <option value="#99ffff" <?php if($row['subject_color'] == '#99ffff') echo 'selected'; ?>>Cyan</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Room Number</label>
                  <input type="text" name="room_number" value="<?php echo $row['room_number']; ?>" class="form-control">
                </div>
                
                <div class="form-group">
                  <label>Teacher Name</label>
                  <input type="text" name="teacher_name" value="<?php echo $row['teacher_name']; ?>" class="form-control">
                </div>
                
                <div class="form-group">
                  <label>Notes</label>
                  <textarea name="notes" class="form-control"><?php echo $row['notes']; ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-success">UPDATE</button>
                <a href="index.php" class="btn btn-secondary">CANCEL</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
    <footer class="text-center mt-4 mb-2">
  <small class="text-muted">&copy; 2025 SUP_Timetable by PforPyae. All rights reserved.</small>
</footer>
  </body>
</html>
