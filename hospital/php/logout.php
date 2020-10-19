<?php
session_start();
require_once './handeler.php';
$user = new HOSPITAL();

if(!$user->is_logged_in())
{
 $user->redirect('../index.php');
}

if($user->is_logged_in()!="")
{
 $user->logout(); 
 $user->redirect('../index.php');
}
?>