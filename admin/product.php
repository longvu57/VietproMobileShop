<script>
    function xacNhanXoa(){
        var conf = confirm("Bạn có chắc chắn xóa sản phẩm này hay không?");
        return conf;
    }
</script>

<?php  
// chức năng hiển thị danh sách sản phẩm
// https://www.w3schools.com/sql/sql_join.asp
// tìm $page
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}
$rowPerPage = 5;
$perRow = $page * $rowPerPage - $rowPerPage;
$sql = "SELECT * FROM product INNER JOIN category 
        ON product.cat_id=category.cat_id ORDER BY prd_id DESC 
        LIMIT $perRow,$rowPerPage";
$query = mysqli_query($conn, $sql);

// Xây dựng thanh phân trang
// previous
$listPage = '';
$prePage = $page - 1;
if($prePage <= 0){
    $prePage = 1;
}
$listPage .= '<li class="page-item"><a class="page-link" 
href="index.php?page_layout=product&page='.$prePage.'">&laquo;</a></li>';

// vòng lặp phân trang
$sql_total = "SELECT * FROM product";
$query_total = mysqli_query($conn, $sql_total);
// hàm num rows giúp trả về tổng số lượng bản ghi của câu truy vấn
$totalRow = mysqli_num_rows($query_total);
$totalPage = ceil($totalRow/$rowPerPage);
for($i = 1; $i <= $totalPage; $i++){
    if($i == $page){
        $active = 'active';
    }
    else {
        $active = '';
    }
    $listPage .= '<li class="page-item '.$active.'"><a class="page-link" 
    href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';
}

// next
// trang cuối cùng chính là tổng số trang
$nextPage = $page + 1;
if($nextPage > $totalPage){
    $nextPage = $totalPage;
}
$listPage .= '<li class="page-item"><a class="page-link" 
href="index.php?page_layout=product&page='.$nextPage.'">&raquo;</a></li>';

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm</h1>
        </div>
    </div><!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_product" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table 
                        data-toolbar="#toolbar"
                        data-toggle="table">

                        <thead>
                        <tr>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="name"  data-sortable="true">Tên sản phẩm</th>
                            <th data-field="price" data-sortable="true">Giá</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Danh mục</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($query)){ ?>
                                <tr>
                                    <td style=""><?php echo $row['prd_id']; ?></td>
                                    <td style=""><?php echo $row['prd_name']; ?></td>
                                    <td style=""><?php echo number_format($row['prd_price'], 0, ',', '.'); ?> vnd</td>
                                    <td style="text-align: center"><img width="130" height="180" src="img/products/<?php echo $row['prd_image']; ?>" /></td>
                                    <td><span class="label <?php if($row['prd_status']==1){echo 'label-success';}else{echo 'label-danger';} ?>"><?php if($row['prd_status']==1){echo 'Còn hàng';}else{echo 'Hết hàng';} ?></span></td>
                                    <td><?php echo $row['cat_name']; ?></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_product&prd_id=<?php echo $row['prd_id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a onclick="return xacNhanXoa();" href="delete_product.php?prd_id=<?php echo $row['prd_id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                             </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php
                                echo $listPage;    
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div><!--/.row-->	
</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
</script>	

