<?php  
session_start();
if(isset($_SESSION['usermail']) && isset($_SESSION['userpass'])){
    session_destroy();
    header('location: index.php');
}
else{
    header('location: index.php');
}
?>