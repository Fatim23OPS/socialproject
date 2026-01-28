<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'natfwa9');

define('DASHBOARDS', [
    'student' => 'dashboard-student.php',
    'mentor' => 'dashboard-mentor.php',
    'volunteer' => 'dashboard-volunteer.php',
    'orphan' => 'dashboard-orphan.php'
]);

define('PASSWORD_MIN_LENGTH', 8);
define('SESSION_DURATION', 3600 * 24 * 30);

session_start();
?>