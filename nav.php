<?php include_once "Setup.php"; ?>
<nav>
<?php 
    if ($user->getisguest() === 'false')
    {
        $username = $user->getname();
        echo 
        "
        <ul class='flex space-x-4'>
        <li><a href='http://localhost:8000/home.php' class='text-gray-700 hover:text-blue-600'>Home</a></li>
        <li><a href='http://localhost:8000/dashboard.php' class='text-gray-700 hover:text-blue-600'>Dashboard</a></li>
        <li class = 'text-xl font-bold text-blue-600'>$username</li>
        <li><a href='http://localhost:8000/logout.php' class='text-gray-700 hover:text-blue-600'>Logout</a></li>
        </ul>
        ";
    }
    else 
    {
        echo
        "
        <ul class='flex space-x-4'>
        <li><a href='http://localhost:8000/' class='text-gray-700 hover:text-blue-600'>Home</a></li>
        <li><a href='http://localhost:8000/signup.php' class='text-gray-700 hover:text-blue-600'>Sign-up</a></li>
        <li><a href='http://localhost:8000/login.php' class='text-gray-700 hover:text-blue-600'>login</a></li>
        <li><a href='http://localhost:8000/contact.php' class='text-gray-700 hover:text-blue-600'>Contact</a></li>
        </ul>
        ";
    }
?>
</nav>