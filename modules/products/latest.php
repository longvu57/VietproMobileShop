<?php  
$sql = "SELECT * FROM product ORDER BY prd_id DESC LIMIT 6";
$query = mysqli_query($conn, $sql);
?>
<!--	Latest Product	-->
<div class="products">
    <h3>Sản phẩm mới</h3>
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
    ?>
</div>
<!--	End Latest Product	-->