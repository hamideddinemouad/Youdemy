<?php

include "Course.php";
include "db.php";
// Calling the getCourseDetails method
echo Course::renderCourseCatalog($db);
?>