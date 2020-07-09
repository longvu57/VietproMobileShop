<?php   
session_start();
include_once('config/connect.php');
if(isset($_SESSION['usermail']) && isset($_SESSION['userpass'])){
    include_once('admin.php');
}
else{
    include_once('login.php');
}
?>