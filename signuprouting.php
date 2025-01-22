<?php
include_once "setup.php";
var_dump($_POST);
if (isset($_POST['signup']))
{
$signedup = $user->signup();
if ($signedup !== 'false') {
    switch ($signedup['role']) {
        case 'student':
            echo "it's a student echo from signup.php";
            $user = new Student($db, $signedup['name'], $signedup['email'], $signedup['role'], $signedup['id'], $signedup['password']);
            $_SESSION['user'] = $user->encode();
            header('location: index.php');
            exit();
        case 'teacher':
            echo "it's a teacher echo from signup.php";
            $user = new Teacher($db, $signedup['name'], $signedup['email'], $signedup['role'], $signedup['id'], $signedup['password']);
            $_SESSION['user'] = $user->encode();
            header('location: index.php');
            exit();
    }
}
else if ($signedup === 'false') {
    $_SESSION['error'] = 'User already exists';
    header('location: signup.php');
    exit();
}
}
?>