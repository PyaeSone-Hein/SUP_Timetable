<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Add Subject to Timetable</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header bg-primary text-white">
              Add Subject to Timetable
            </div>
            <div class="card-body">
              <form action="saveschedule.php" method="POST">
                
                <div class="form-group">
                  <label>Day of Week</label>
                  <select name="dayOfWeek" class="form-control" required>
                    <option value="">Select Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Time Slot</label>
                  <input type="text" name="timeSlot" placeholder="e.g. 9:00am - 10:00am" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Subject Name</label>
                  <input type="text" name="subjectName" placeholder="Enter Subject Name" class="form-control" required>
                </div>
                
                <div class="form-group">
                  <label>Subject Color</label>
                  <select name="subjectColor" class="form-control" required>
                    <option value="#ff9999">Red</option>
                    <option value="#99ccff">Blue</option>
                    <option value="#99ff99">Green</option>
                    <option value="#ffff99">Yellow</option>
                    <option value="#cc99ff">Purple</option>
                    <option value="#ffcc99">Orange</option>
                    <option value="#99ffff">Cyan</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Room Number</label>
                  <input type="text" name="roomNumber" placeholder="Enter Room Number" class="form-control">
                </div>

                <div class="form-group">
                  <label>Teacher Name</label>
                  <input type="text" name="teacherName" placeholder="Enter Teacher Name" class="form-control">
                </div>

                <div class="form-group">
                  <label>Notes</label>
                  <textarea class="form-control" name="notes" placeholder="Additional notes"></textarea>
                </div>

                <button type="submit" class="btn btn-success">SAVE</button>
                <button type="reset" class="btn btn-warning">RESET</button>
                <a href="index.php" class="btn btn-secondary">BACK</a>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <footer class="text-center mt-4 mb-2">
  <small class="text-muted">&copy; 2025 SUP_Timetable by PforPyae. All rights reserved.</small>
</footer>
  </body>

</html>