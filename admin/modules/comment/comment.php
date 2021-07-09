<?php
if(!defined("SECURITY")){
	die("Hành vi của bản không được chấp nhận!!!");
}
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page=1;
}
$row_per_page = 5;
$per_rows = ($page * $row_per_page) - $row_per_page;
echo $total_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM comment"));
$total_page = ceil($total_rows/$row_per_page);

$list_page = '';
//preview
$page_prev = $page-1;
if($page_prev<=0) $page_prev=1;
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page='.$page_prev.'">&laquo;</a></li>';

//tinh toan so trang
for($i=1; $i<=$total_page;$i++){
    if($i==$page) $active ='active';
    else $active = '';
    $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=comment&page='.$i.'">'.$i.'</a></li>';
}

//next
$page_next = $page + 1;
if($page_next>$total_page) $page_next=$total_page;
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page='.$page_next.'">&raquo;</a></li>';

//khong hien thi khi khong qua 1 trang
if ($total_page<=1) $list_page='';
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="#" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Sản phẩm được bình luận</th>
                                <th data-field="price" data-sortable="true">Tên</th>
                                <th>Email</th>
                                <th>Ngày</th>
                                <th>Chi tiết</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM comment INNER JOIN product ON comment.prd_id = product.prd_id ORDER BY comm_id DESC LIMIT $per_rows, $row_per_page";
                            $query = mysqli_query($connect,$sql);
                            while($row = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td style=""><?=$row['comm_id'] ?></td>
                                <td style=""><?=$row['prd_name'] ?></td>
                                <td style=""><?=$row['comm_name'] ?></td>
                                <td style=""><?=$row['comm_mail'] ?></td>
                                <td style=""><?=$row['comm_date'] ?></td>
                                <td style=""><?=$row['comm_details'] ?></td> 
                                <td class="form-group">
                                    <a href="#" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        <?= $list_page ?>
                            <!-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>
<!--/.main-->