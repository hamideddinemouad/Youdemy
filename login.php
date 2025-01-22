<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
            <?php include_once "nav.php"; ?>
        </div>
    </header>
    <div class="bg-white rounded-lg shadow-lg p-8 w-96">
        <h2 class="text-2xl font-bold text-blue mb-6 text-center">Login</h2>
        <form action="loginredirect.php" method="POST">
            <?php
            if (isset($_SESSION['incorrect'])) {
                echo '<p class="text-red-500 text-center mb-4">User or password not correct</p>';
                unset($_SESSION['incorrect']);
            }
            ?>
            <div class="mb-4">
                <label for="email" class="block text-gray">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue" placeholder="you@example.com">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue" placeholder="Your Password">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white rounded-md py-2 hover:bg-blue-700 transition duration-200">Login</button>
        </form>
        <p class="mt-4 text-gray text-center">
            Don't have an account? <a href="#" class="text-blue hover:underline">Sign up</a>
        </p>
    </div>
</body>
</html>