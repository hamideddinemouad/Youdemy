<?php 
include_once "setup.php";
// var_dump($_POST);
$auth = $user->login();
if ($auth === 0)
{
    $_SESSION['incorrect'] = 'Incorrect email or password';
    header('location: login.php');
    exit();
}
$_SESSION['user'] = json_encode($auth);
header('location: index.php');
exit();
// switch
?>