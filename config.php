<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'natfwa9');

define('DASHBOARDS', [
    'student' => 'dashboard-student.html',
    'mentor' => 'dashboard-mentor.html',
    'volunteer' => 'dashboard-volunteer.html',
    'orphan' => 'dashboard-orphan.html'
]);

define('PASSWORD_MIN_LENGTH', 8);
define('SESSION_DURATION', 3600 * 24 * 30);

session_start();
?>