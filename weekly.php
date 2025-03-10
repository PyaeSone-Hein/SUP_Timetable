
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Weekly Timetable View</title>
    <style>
      body {
        background-color: #f5f5f5;
      }
      .top-bar {
        background-color: #2c3e50;
        color: white;
        padding: 8px 15px;
      }
      .timetable-header {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 10px;
        text-align: center;
        font-weight: bold;
      }
      .time-column {
        width: 10%;
        font-weight: bold;
        text-align: right;
        padding-right: 10px;
        color: #666;
      }
      .timetable-cell {
        height: 80px;
        padding: 0;
        border: 1px solid #dee2e6;
        position: relative;
      }
      .subject-block {
        padding: 5px;
        border-radius: 3px;
        height: 100%;
        font-size: 0.85em;
        overflow: hidden;
        color: white;
      }
      .today-column {
        background-color: #fffde7;
      }
      .week-navigator {
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        margin-bottom: 10px;
      }
      .week-navigator .date-range {
        font-weight: bold;
        color: #444;
      }
      .nav-arrow {
        cursor: pointer;
        color: #666;
        padding: 5px 10px;
      }
      .view-toggle {
        background-color: #eee;
        border-radius: 4px;
        overflow: hidden;
        display: inline-flex;
      }
      .view-toggle-btn {
        padding: 5px 15px;
        border: none;
        background: none;
      }
      .view-toggle-btn.active {
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
      }
      .all-day-row {
        background-color: #f5f5f5;
        border-bottom: 2px solid #ddd;
      }
      .all-day-cell {
        height: auto;
        min-height: 30px;
      }
      .all-day-label {
        writing-mode: vertical-lr;
        text-orientation: mixed;
        transform: rotate(180deg);
        height: 100%;
        padding: 5px;
        font-weight: bold;
        color: #666;
        text-align: center;
      }
    </style>
  </head>

  <body>
    <!-- Top navigation bar -->
    <div class="top-bar d-flex justify-content-between align-items-center">
      <div>
        <button class="btn btn-sm btn-outline-light">
          <i class="fas fa-bars"></i> Actions
        </button>
      </div>
      <div>
        <a href="index.php" class="btn btn-sm btn-outline-light">
          <i class="fas fa-list"></i> List View
        </a>
      </div>
    </div>

    <div class="container-fluid py-3">
      <!-- View controls -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <button class="btn btn-sm btn-outline-secondary">Today</button>
        </div>
        
        <div class="week-navigator">
          <a href="#" class="nav-arrow"><i class="fas fa-chevron-left"></i></a>
          <span class="date-range">
            <?php
              // Get current week's start and end dates
              $today = new DateTime();
              $weekStart = clone $today;
              $weekStart->modify('monday this week');
              $weekEnd = clone $weekStart;
              $weekEnd->modify('+6 days');
              
              echo $weekStart->format('j') . ' - ' . $weekEnd->format('j M Y');
            ?>
          </span>
          <a href="#" class="nav-arrow"><i class="fas fa-chevron-right"></i></a>
        </div>
        
        <div class="view-toggle">
          <button class="view-toggle-btn">Month</button>
          <button class="view-toggle-btn active">Week</button>
        </div>
      </div>

      <div class="card shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-bordered m-0">
              <thead>
                <tr>
                  <th class="time-column"></th>
                  <?php
                    $days = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
                    $fullDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    $today = date('N') - 1; // 0 for Monday, 6 for Sunday
                    
                    // Get dates for the current week
                    $dates = [];
                    $currentDate = new DateTime();
                    $currentDate->modify('monday this week');
                    
                    for ($i = 0; $i < 7; $i++) {
                      $dates[] = clone $currentDate;
                      $currentDate->modify('+1 day');
                    }
                    
                    foreach ($days as $index => $day) {
                      $todayClass = ($index == $today) ? 'today-column' : '';
                      echo "<th class='timetable-header $todayClass'>";
                      echo "$day " . $dates[$index]->format('j/n');
                      echo "</th>";
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <!-- All-day events row -->
                <tr class="all-day-row">
                  <td class="time-column all-day-label">ALL-DAY</td>
                  <?php
                    include('connection.php');
                    
                    // Get all schedule data
                    $query = mysqli_query($connection, "SELECT * FROM tb_schedules");
                    $schedules = [];
                    
                    while($row = mysqli_fetch_array($query)) {
                      $schedules[] = $row;
                    }
                    
                    // Display all-day cells for each day
                    foreach ($fullDays as $day) {
                      echo "<td class='all-day-cell'>";
                      
                      // Find all-day events or events without specific time
                      foreach($schedules as $schedule) {
                        if ($schedule['day_of_week'] == $day && empty($schedule['time_slot'])) {
                          echo "<div class='badge badge-pill' style='background-color: " . $schedule['subject_color'] . ";'>";
                          echo $schedule['subject_name'];
                          echo "</div> ";
                        }
                      }
                      
                      echo "</td>";
                    }
                  ?>
                </tr>
                
                <?php
                  // Define time slots
                  $timeSlots = [
                    "7AM" => "7:00am - 8:00am",
                    "8AM" => "8:00am - 9:00am",
                    "9AM" => "9:00am - 10:00am",
                    "10AM" => "10:00am - 11:00am",
                    "11AM" => "11:00am - 12:00pm",
                    "12PM" => "12:00pm - 1:00pm",
                    "1PM" => "1:00pm - 2:00pm",
                    "2PM" => "2:00pm - 3:00pm",
                    "3PM" => "3:00pm - 4:00pm",
                    "4PM" => "4:00pm - 5:00pm",
                    "5PM" => "5:00pm - 6:00pm",
                    "6PM" => "6:00pm - 7:00pm",
                    "7PM" => "7:00pm - 8:00pm",
                    "8PM" => "8:00pm - 9:00pm",
                    "9PM" => "9:00pm - 10:00pm"
                  ];
                  
                  // Build the timetable
                  foreach($timeSlots as $display => $timeSlot) {
                    echo "<tr>";
                    echo "<td class='time-column'>" . $display . "</td>";
                    
                    // For each day of the week
                    foreach($fullDays as $index => $day) {
                      $todayClass = ($index == $today) ? 'today-column' : '';
                      echo "<td class='timetable-cell $todayClass'>";
                      
                      // Find classes for this day and time
                      foreach($schedules as $schedule) {
                        if ($schedule['day_of_week'] == $day && $schedule['time_slot'] == $timeSlot) {
                          echo "<div class='subject-block' style='background-color: " . $schedule['subject_color'] . ";'>";
                          echo "<strong>" . $schedule['subject_name'] . "</strong><br>";
                          if (!empty($schedule['room_number'])) {
                            echo "Room: " . $schedule['room_number'] . "<br>";
                          }
                          if (!empty($schedule['teacher_name'])) {
                            echo "Teacher: " . $schedule['teacher_name'];
                          }
                          echo "</div>";
                        }
                      }
                      
                      echo "</td>";
                    }
                    
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        // Make the view toggle buttons work
        $('.view-toggle-btn').click(function() {
          $('.view-toggle-btn').removeClass('active');
          $(this).addClass('active');
          
          // If "Month" is clicked, we could redirect to a month view in the future
          if($(this).text() === 'Month') {
            // For now just show an alert
            alert('Month view is not implemented yet');
            // Reset the active state
            $('.view-toggle-btn').removeClass('active');
            $('.view-toggle-btn:contains("Week")').addClass('active');
          }
        });
      });
    </script>
    <footer class="text-center mt-4 mb-2">
  <small class="text-muted">&copy; 2025 SUP_Timetable by PforPyae. All rights reserved.</small>
</footer>
  </body>
</html>