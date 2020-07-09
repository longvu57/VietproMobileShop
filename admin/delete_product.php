<?php  
session_start();
include_once('config/connect.php');
if(isset($_SESSION['usermail']) && isset($_SESSION['userpass'])){
    $prd_id = $_GET['prd_id'];
    $sql = "DELETE FROM product WHERE prd_id=$prd_id";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=product');
}
?>