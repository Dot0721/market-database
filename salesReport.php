<title>Sales Report</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
    }
    else{
        $ID=$_GET['ID'];
    }
    echo "<a href='menu.php?ID=".$ID."'> <button> <b> menu</b> </button> </a>";
    if (isset($_POST['submit'])) {
        $query_date = "'$year-$month-$day'";
        $sql="SELECT 
        SUM(so.sales_price * so.sales_amount) AS sum,
        so.snumber AS 銷售訂單編號,
        m.mnumber AS 商品編號,
        m.mname AS 商品名稱,
        so.sales_amount AS 銷售數量,
        so.sales_price AS 單價,
        so.sale_date AS 銷售日期
        FROM 
            sales_order so
        JOIN 
            Merchandise m ON so.snumber = m.mnumber
        WHERE 
            so.sale_date = $query_date
        GROUP BY 
            so.snumber, m.mnumber, m.mname, so.sales_amount, so.sales_price, so.sale_date;    
    ";
    $result= mysqli_query($db, $sql);
    $row=mysqli_fetch_assoc($result);
    $sum=$row['sum'];
    echo"本日銷售額:$sum<br>";
    echo"<hr>";
    $result= mysqli_query($db, $sql);
    while($row=mysqli_fetch_assoc($result)){
        $s=$row['銷售訂單編號'];
        $m=$row['商品編號'];
        $a=$row['銷售數量'];
        $p=$row['單價'];
        $n=$row['商品名稱'];
        echo"銷售編號=$s<br>";
        echo"商品名稱=$n<br>";
        echo"銷售數量=$a<br>";
        echo"單價=$p<br>";
        echo"<hr>";
    }
    }

?>
<body>
    <form name="sales" action="salesReport.php" method="post">
    <input type="hidden" name="ID" value="<?=$ID?>">
    <label for="year">Year:</label>
        <select id="year" name="year">
            <?php
            for ($i = 2000; $i <= 2024; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            ?>
        </select>

        <label for="month">Month:</label>
        <select id="month" name="month">
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $month = str_pad($i, 2, '0', STR_PAD_LEFT);
                echo "<option value=\"$month\">$month</option>";
            }
            ?>
        </select>

        <label for="day">Day:</label>
        <select id="day" name="day">
            <?php
            for ($i = 1; $i <= 31; $i++) {
                $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                echo "<option value=\"$day\">$day</option>";
            }
            ?>
        </select>
        <p><input type="submit" name="submit" value="確認"> 
    </form>
</body>