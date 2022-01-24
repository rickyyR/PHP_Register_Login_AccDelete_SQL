<?php
session_start();
session_destroy(); // zerstoere die session und all ihre daten

echo "Logout erfolgreich <br> <a href='http://localhost/GFN_Projects/php_Eigenarbeit/home.php'>Home</a>";
?>