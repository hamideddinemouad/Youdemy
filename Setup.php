<?php
session_start();
include_once "user.php";
include_once "student.php";
include_once "teacher.php";
include_once "db.php";
include_once "course.php";
echo "setup file included";
var_dump($_SESSION);
if (isset($_SESSION['user']))
{
    echo "session user set";
    $userinfo = json_decode($_SESSION['user']);
    var_dump($userinfo);
    $role = $userinfo->role;
    if ($role === 'student')
    {
        echo "it's a student";
        $user = new Student($db, $userinfo->name, $userinfo->email, $userinfo->role, $userinfo->id, $userinfo->password);
        $_SESSION['user'] = $user->encode();
    }
    else if ($role === 'teacher')
    {
        echo "it's a teacher";
        $user = new Teacher($db, $userinfo->name, $userinfo->email, $userinfo->role, $userinfo->id, $userinfo->password);
        $_SESSION['user'] = $user->encode();
    }
    // $user = new User($db, $userinfo->name, $userinfo->email, $userinfo->id, $userinfo->password);
}
else
{
    echo "session user not set";
    $user = new User($db);
}
?>