<?php
include_once "signuprouting.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function validateForm() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const role = document.querySelector('input[name="role"]:checked');
            if (name === '' || email === '' || password === '' || role === null) {
                alert('All fields are required');
                return false;
            }
        }
        </script>
</head>
<body class="flex flex-col gap-7 items-center">
    <header class="bg-white shadow w-screen">
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
            <?php include "nav.php"; ?>
        </div>
    </header>
    <?php if (isset($_SESSION['error']))
{
    echo "<div id='user-exists' class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
<strong class='font-bold'>Error!</strong>
<span class='block sm:inline'>A user with this email already exists.</span>
</div>";
unset($_SESSION['error']);
} ?>
<?php if (isset($_SESSION['teacher already registred']))
{
    echo "    <div id='teacher-exists' class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
        <strong class='font-bold'>Error!</strong>
        <span class='block sm:inline'>A teacher with this email is already registered.</span>
    </div>";
    unset($_SESSION['teacher already registred']);
}
if (isset($_SESSION['teacher demand submitted']))
{
    echo "<div id='teacher-demand-submitted' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
        <strong class='font-bold'>Success!</strong>
        <span class='block sm:inline'>Your demand to become a teacher has been submitted successfully.</span>
    </div>";
    unset($_SESSION['teacher demand submitted']);
}
?>
    <div class="bg-white rounded-lg shadow-lg p-8 w-96">
        <h2 class="text-2xl font-bold text-blue mb-6 text-center">Sign Up</h2>
        <form action="signuprouting.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name = "signup" value= 1>
            <div class="mb-4">
                <label for="name" class="block text-gray">Full Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue" placeholder="Your Name">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray">Email</label>
                <input type="email" id="email" name="email"  class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue" placeholder="you@example.com">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray">Password</label>
                <input type="password" id="password" name="password"  class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue" placeholder="Your Password">
            </div>
            <div class="mb-6">
                <span class="block text-gray mb-2">Register as:</span>
                <div class="flex items-center">
                    <input type="radio" id="student" name="role" value="student" class="mr-2" >
                    <label for="student" class="text-gray">Student</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="teacher" name="role" value="teacher" class="mr-2" >
                    <label for="teacher" class="text-gray">Teacher</label>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white rounded-md py-2 hover:bg-blue-700 transition duration-200">Sign Up</button>
        </form>
        <p class="mt-4 text-gray text-center">
            Already have an account? <a href="login.php" class="text-blue hover:underline">Login</a>
        </p>
    </div>
</body>
</html>