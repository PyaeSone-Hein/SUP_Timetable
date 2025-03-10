<!--
SUP_Timetable - A comprehensive timetable management system
@author      PforPyae
@copyright   Copyright (c) 2025 PforPyae
@license     MIT License
@version     1.0.0
-->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Timetable Management</title>
    <style>
      .color-preview {
        width: 20px;
        height: 20px;
        display: inline-block;
        margin-right: 5px;
        border: 1px solid #ddd;
      }
    </style>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h4>Timetable Management System</h4>
            </div>
            <div class="card-body">
              <a href="addschedule.php" class="btn btn-md btn-success" style="margin-bottom: 10px">ADD SUBJECT</a>
              <a href="timetable-view.php" class="btn btn-md btn-info" style="margin-bottom: 10px; margin-left: 10px;">WEEKLY VIEW</a>
              <table class="table table-bordered" id="myTable">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">DAY</th>
                    <th scope="col">TIME SLOT</th>
                    <th scope="col">SUBJECT</th>
                    <th scope="col">ROOM</th>
                    <th scope="col">TEACHER</th>
                    <th scope="col">NOTES</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      include('connection.php');
                      $no = 1;
                      $query = mysqli_query($connection, "SELECT * FROM tb_schedules ORDER BY 
                        CASE 
                          WHEN day_of_week = 'Monday' THEN 1 
                          WHEN day_of_week = 'Tuesday' THEN 2 
                          WHEN day_of_week = 'Wednesday' THEN 3 
                          WHEN day_of_week = 'Thursday' THEN 4 
                          WHEN day_of_week = 'Friday' THEN 5 
                          WHEN day_of_week = 'Saturday' THEN 6 
                          WHEN day_of_week = 'Sunday' THEN 7 
                        END, 
                        time_slot");

                      while($row = mysqli_fetch_array($query)){
                  ?>
                  
                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['day_of_week'] ?></td>
                      <td><?php echo $row['time_slot'] ?></td>
                      <td>
                        <span class="color-preview" style="background-color: <?php echo $row['subject_color'] ?>;"></span>
                        <?php echo $row['subject_name'] ?>
                      </td>
                      <td><?php echo $row['room_number'] ?></td>
                      <td><?php echo $row['teacher_name'] ?></td>
                      <td><?php echo $row['notes'] ?></td>
                      <td class="text-center">
                        <a href="editschedule.php?id=<?php echo $row['schedule_id'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                        <a href="deleteschedule.php?id=<?php echo $row['schedule_id'] ?>" class="btn btn-sm btn-danger">DELETE</a>
                      </td>
                  </tr>

                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>

<footer class="text-center mt-4 mb-2">
  <small class="text-muted">&copy; 2025 SUP_Timetable by PforPyae. All rights reserved.</small>
</footer>
  </body>
</html>