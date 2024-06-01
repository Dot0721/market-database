<title>salesOrder</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
        $pnumber=$_POST['pnumber'];
        $amount=$_POST['amount'];
        $purchase_price=$_POST['purchase_price'];
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
        $pnumber=$_POST['pnumber'];
        $amount=$_POST['amount'];
        $purchase_price=$_POST['purchase_price'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $query_date = "'$year-$month-$day'";
        $sql="insert  purchase_order(purchase_date,pnumber,ID,amount,purchase_price) values ($query_date,$pnumber,$ID,$amount,$purchase_price)";
        $result = mysqli_query($db, $sql);
            if (!$result) {
                die('Error: ' . mysqli_error($con));
            } else {
                $sql="UPDATE `merchandise` SET amount=amount+$amount WHERE mnumber=$pnumber";
                $result = mysqli_query($db, $sql);
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
        <form name="sales" action="purchaseOrder.php" method="post">
        <input type="hidden" name="ID" value="<?=$ID?>">
        <p>商品編號 : <input type=text name="pnumber"></p>
        <p>進貨數量 : <input type=text name="amount"></p>
        <p>單價 : <input type=text name="purchase_price"></p>
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
        <p><input type="submit" name="submit" value="進貨紀錄">
    </div>
</body>