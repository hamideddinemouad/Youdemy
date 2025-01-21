<?php
include_once "user.php";
include_once "db.php";
include_once "course.php";
if (isset($_SESSION['user']))
{
    $userinfo = json_decode($_SESSION['user']);
    $user = new User($db, $userinfo->name, $userinfo->email, $userinfo->id, $userinfo->password);
}
else
{
    $user = new User($db);
    $_SESSION['user'] = $user->encode();
}
?>