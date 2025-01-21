<?php
include_once "Course.php";
include_once "db.php";
$popular= Course::getRandomCourses($db);
echo $popular;
?>