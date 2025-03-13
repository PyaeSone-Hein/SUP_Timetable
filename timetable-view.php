<?php 
include('session_check.php');
include('connection.php');

// Fetch all unique time slots and sort them
$timeQuery = mysqli_query($connection, "SELECT DISTINCT time_slot FROM tb_schedules ORDER BY time_slot");
$timeSlots = array();
while($timeRow = mysqli_fetch_array($timeQuery)) {
    $timeSlots[] = $timeRow['time_slot'];
}

// Define days of week in desired order
$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

// Fetch all schedules
$schedulesQuery = mysqli_query($connection, "SELECT * FROM tb_schedules");
$schedules = array();

// Organize schedules by day and time for easier access
while($row = mysqli_fetch_array($schedulesQuery)) {
    $schedules[$row['day_of_week']][$row['time_slot']] = $row;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Weekly Timetable</title>
    <style>
        .timetable-cell {
            height: 100px;
            padding: 5px;
            border: 1px solid #dee2e6;
            vertical-align: top;
        }
        .subject-block {
            border-radius: 5px;
            padding: 8px;
            margin-bottom: 5px;
            height: 100%;
            color: #333;
            font-size: 0.9rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
        .time-column {
            font-weight: bold;
            width: 150px;
            text-align: center;
            vertical-align: middle !important;
            background-color: #f8f9fa;
        }
        .day-header {
            text-align: center;
            font-weight: bold;
            background-color: #f8f9fa;
        }
        .empty-cell {
            background-color: #f8f9fa;
            opacity: 0.7;
        }
        .mini-info {
            font-size: 0.8rem;
            margin-top: 3px;
        }
        .action-buttons {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        .user-info {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        .user-info .username {
            margin-right: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Weekly Timetable</h4>
                            <div class="user-info no-print">
                                <span class="username">Welcome, <?php echo $_SESSION['username']; ?></span>
                                <a href="logout.php" class="btn btn-sm btn-light">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="action-buttons no-print">
                            <a href="addschedule.php" class="btn btn-success">Add Subject</a>
                            <a href="index.php" class="btn btn-secondary">List View</a>
                            <button onclick="window.print()" class="btn btn-info">Print Timetable</button>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="time-column">Time / Day</th>
                                        <?php foreach($daysOfWeek as $day): ?>
                                            <th class="day-header"><?php echo $day; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($timeSlots as $timeSlot): ?>
                                        <tr>
                                            <td class="time-column"><?php echo $timeSlot; ?></td>
                                            <?php foreach($daysOfWeek as $day): ?>
                                                <td class="timetable-cell <?php echo !isset($schedules[$day][$timeSlot]) ? 'empty-cell' : ''; ?>">
                                                    <?php if(isset($schedules[$day][$timeSlot])): ?>
                                                        <?php $schedule = $schedules[$day][$timeSlot]; ?>
                                                        <div class="subject-block" style="background-color: <?php echo $schedule['subject_color']; ?>">
                                                            <strong><?php echo $schedule['subject_name']; ?></strong>
                                                            
                                                            <?php if(!empty($schedule['room_number'])): ?>
                                                                <div class="mini-info">Room: <?php echo $schedule['room_number']; ?></div>
                                                            <?php endif; ?>
                                                            
                                                            <?php if(!empty($schedule['teacher_name'])): ?>
                                                                <div class="mini-info">Teacher: <?php echo $schedule['teacher_name']; ?></div>
                                                            <?php endif; ?>
                                                            
                                                            <div class="mini-info no-print">
                                                                <a href="editschedule.php?id=<?php echo $schedule['schedule_id']; ?>" class="text-dark">
                                                                    <small>Edit</small>
                                                                </a> | 
                                                                <a href="deleteschedule.php?id=<?php echo $schedule['schedule_id']; ?>" class="text-dark" onclick="return confirm('Are you sure you want to delete this schedule?')">
                                                                    <small>Delete</small>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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