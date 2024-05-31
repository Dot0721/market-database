<title>salesOrder</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
        $snumber=$_POST['snumber'];
        $sales_amount=$_POST['sales_amount'];
        $sales_price=$_POST['sales_price'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
    }
    else{
        $ID=$_GET['ID'];
    }
    $sql="select * from users where ID=$ID";
    $result= mysqli_query($db, $sql);
    $row=mysqli_fetch_assoc($result);
    if (isset($_POST['submit'])) {
        $ID=$_POST['ID'];
        $snumber=$_POST['snumber'];
        $sales_amount=$_POST['sales_amount'];
        $sales_price=$_POST['sales_price'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $query_date = "'$year-$month-$day'";
        echo "$query_date,$snumber,$sales_amount,$sales_price,$ID";
        $sql="insert sales_order(sale_date,snumber,sales_amount,sales_price,ID) values ($query_date,$snumber,$sales_amount,$sales_price,$ID)";
        $result = mysqli_query($db, $sql);
            if (!$result) {
                die('Error: ' . mysqli_error($con));
            } else {
                
                echo '<div class="success">Insert successfully ！</div>';
                echo "
                    <script>
                    setTimeout(function(){window.location.href='menu.php?ID=" .$ID . "';},600);
                    </script>";
            }
    }
?>
<body>
    <div>
        <form name="sales" action="salesOrder.php" method="post">
        <input type="hidden" name="ID" value="<?=$ID?>">
        <p>商品編號 : <input type=text name="snumber"></p>
        <p>銷售數量 : <input type=text name="sales_amount"></p>
        <p>單價 : <input type=text name="sales_price"></p>
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
        <p><input type="submit" name="submit" value="販售紀錄">
    </div>
</body>