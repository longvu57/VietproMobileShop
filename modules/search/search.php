<?php  
// nếu nhập vào ô search, tồn tại $_POST 
// -> giá trị nhận được sẽ là $_POST
// còn nếu F5 lại trang search, giá trị nhận xuống thông qua URL GET
if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
}else{
    $keyword = $_GET['keyword'];
}
// search: sản phẩm iphone xs -> explode -> ['sản'], ['phẩm'], ['...']
// iphone- xs- abc -> '- '
$arr_keyword = explode(' ',$keyword);
$end_keyword = '%'.implode('%',$arr_keyword).'%';
$sql = "SELECT * FROM product WHERE prd_name LIKE '$end_keyword' 
        ORDER BY prd_id DESC LIMIT 6";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
?>
<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
    <?php 
    // $i là tham số đại diện cho 1 item 
    // 1 item là 1 sản phẩm = 1 card trong card-deck
    $i = 1;
    while($row = mysqli_fetch_array($query)){ 
        if($i==1){
            echo '<div class="product-list card-deck">';
        }
    ?>
        <div class="product-item card text-center">
            <a href="#"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
            <h4><a href="#"><?php echo $row['prd_name']; ?></a></h4>
            <p>Giá Bán: <span><?php echo number_format($row['prd_price'],0,',','.'); ?>đ</span></p>
        </div>
    <?php 
        if($i==3){
            echo '</div>';
            $i = 1;
        }else {
            $i++;
        }
    } 
    if($num % 3 != 0){
        echo '</div>';
    }
    ?>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
    </ul> 
</div>
