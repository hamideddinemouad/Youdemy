<?php
session_start();
include_once "Setup.php";
// var_dump($user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouDemy - Online Learning Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6; /* Light Gray */
        }
    </style>
</head>
<body>
<!-- Color Codes Used
Light Gray: #f3f4f6
Blue: #3b82f6 (used for the hero section background and text links)
White: #ffffff (used for the header and course cards)
Gray: #6b7280 (used for text in course descriptions)
Dark Gray: #1f2937 (used for footer background) -->

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

    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Unlock Your Potential</h2>
            <p class="mb-6">Join thousands of learners and start your journey today.</p>
            <a href="#" class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold">Get Started</a>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold mb-8">Popular Courses</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php include_once "popular.php";?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2023 YouDemy. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
