<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'vietpro_mobile_shop';
$conn = mysqli_connect($host, $user, $pass, $dbname);

if($conn){
    // echo "TC";
    // nếu kết nối thành công, thiết lập tiếng việt
    $sql = "SET NAMES 'utf8'";
    mysqli_query($conn, $sql);
    // mysqli_set_charset($conn, 'utf8');
}
else {
    die("Kết nối Cơ sở dữ liệu thất bại!" . mysqli_error());
}
?>