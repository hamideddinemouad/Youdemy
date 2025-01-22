<?php
include_once "Setup.php";
include_once "Course.php";
include_once "db.php";
$course = new Course($db);
// print_r($_GET);
$course->search($_GET['course']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Search</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-light-gray">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold text-blue-600">YouDemy</h1>
            <form action="courses.php" method="GET" class="flex items-center">
                <input 
                    type="text" 
                    name="course" 
                    placeholder="Search courses..." 
                    class="border rounded-l px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                />
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700">
                    Search
                </button>
            </form>
            <?php include_once "nav.php"; ?>
        </div>
    </header>
    <!-- Search Bar -->
    <div class="container mx-auto my-6">
    </div>
    <!-- Course Cards -->
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Example Course Card -->
    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
        <h2 class="text-xl font-semibold text-blue-600 p-2"><?php echo htmlspecialchars($course->getTitle()) ?></h2>
        <p class="text-gray-800 p-2"><?php echo htmlspecialchars($course->getDescription()) ?></p>
        <p class="text-gray-600 p-2">Total students: <?php echo htmlspecialchars($course->getTotalStudents()) ?></p>
        <p class="text-gray-600 p-2">Teacher: <?php echo htmlspecialchars($course->getTeacher()) ?></p>
        <p class="text-gray-600 p-2">Tags: <?php $course->renderTags(); echo $course->getTagsHtml(); ?></p>
        <?php if (isset($_SESSION['user'])): ?>
        <form action="sign" method="POST" class="mt-4">
            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course->getId()); ?>">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Enroll in this course
            </button>
        </form>
        <?php else: ?>
        <p class="mt-4">Please <a href="login.php" class="text-blue-500 hover:underline">login</a> to enroll in this course.</p>
        <?php endif; ?>
        </div>
    <!-- Repeat Course Cards as needed -->
</div>
    <!-- Footer -->
    <footer class="bg-dark-gray text-white p-4 mt-6">
        <p class="text-center">© 2023 Course Platform. All rights reserved.</p>
    </footer>

</body>
</html>