# SUP_Timetable

A comprehensive timetable management system developed by PforPyae. This web application allows users to create, manage, and visualize their weekly schedules in an intuitive interface.

## Features

- Add, edit, and delete schedule entries
- Color-code subjects for better visualization
- View schedules in list format or weekly timetable view
- Print timetable functionality
- Responsive design for mobile and desktop use
- Interactive data tables with sorting and search capabilities


## Installation

1. Clone the repository
```
git clone https://github.com/PforPyae/SUP_Timetable.git
```

2. Set up a local web server with PHP and MySQL (XAMPP, WAMP, MAMP, etc.)

3. Create a database named `timetable_db`

4. Import the database structure (SQL file included in the repository)

5. Configure the database connection in `connection.php` if needed

6. Access the application through your local web server

## Database Structure

The application uses a single table `tb_schedules` with the following structure:

| Column Name   | Data Type    | Description                   |
|---------------|--------------|-------------------------------|
| schedule_id   | INT          | Primary key, auto-increment   |
| day_of_week   | VARCHAR(20)  | Day of the week               |
| time_slot     | VARCHAR(50)  | Time slot (e.g. 9:00am-10:00am) |
| subject_name  | VARCHAR(100) | Name of the subject           |
| subject_color | VARCHAR(20)  | HEX code for subject color    |
| room_number   | VARCHAR(20)  | Room number or location       |
| teacher_name  | VARCHAR(100) | Name of the teacher           |
| notes         | TEXT         | Additional notes              |

## Technologies Used

- PHP
- MySQL
- Bootstrap 4
- jQuery
- DataTables plugin
- Font Awesome (in weekly view)

## Future Enhancements

- User authentication system
- Multiple timetables for different users
- Export functionality (PDF, Excel)
- Mobile app version
- Recurring event support
- Notifications and reminders

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Author

Developed by PforPyae © 2025

## Acknowledgments

- Bootstrap team for the responsive framework
- DataTables for the interactive table functionality
- All contributors who have helped improve this project

## Contact

For any questions or suggestions, please contact:
- GitHub: [PforPyae](https://github.com/PforPyae)
- Email: [Your Email]
