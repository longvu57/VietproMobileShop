<?php
// start khởi động session
session_start();
// nhận id sản phẩm trên thanh url thông qua href
$prd_id = $_GET['prd_id'];

// kiểm tra lần thứ mấy mua hàng
// nếu mua hàng lần đầu thì là sản phẩm đầu tiên, giỏ hàng bằng 1
// còn nếu mua hàng tiếp tục thì mỗi lần mua cộng lên 1 sản phẩm
if(isset($_SESSION['cart'][$prd_id])){
    $_SESSION['cart'][$prd_id]++;
}else{
    $_SESSION['cart'][$prd_id] = 1;
}
header('location: ../../index.php?page_layout=cart');
?>