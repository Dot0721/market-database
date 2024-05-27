<title>menu</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id=$_GET['id'];
    }
    else{
        $name=$_POST['name'];
        $sales_amount=$_POST['sales_amount'];
        $sales_price=$_POST['sales_price'];
        $total_sales_money=$_POST['total_sales_money'];
        $sale_date=$_POST['sale_date'];

    }
    $sql="select * from users where id=$id";
    $result= mysqli_query($db, $sql);
    $row=mysqli_fetch_assoc($result);
    if (isset($_POST['submit'])) {
        $name=$_POST['name'];
        $sales_amount=$_POST['sales_amount'];
        $sales_price=$_POST['sales_price'];
        $total_sales_money=$_POST['total_sales_money'];
        $sale_date=$_POST['sale_date'];
    }
?>
<body>
    <div>
        <form name="sales" action="salesOrder.php" method="post">
        <p>商品名稱 : <input type=text name="name"></p>
        <p>銷售數量 : <input type=text name="sales_amount"></p>
        <p>單價 : <input type=text name="sales_price"></p>
        <p>總金額 : <input type=text name="total_sales_money"></p>
        <p>銷售日期 : <input type=text name="sale_date"></p>
        <p><input type="submit" name="submit" value="販售紀錄">
    </div>
</body>