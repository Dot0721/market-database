<title>purchas Report</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
        $mnumber=$_POST['mnumber'];
    }
    else{
        $ID=$_GET['ID'];
    }
    echo "<a href='menu.php?ID=".$ID."'> <button> <b> menu </b> </button> </a>";
    if (isset($_POST['submit'])) {
        $sql="SELECT 
            m.mnumber,
            m.mname,
            (
                SELECT COALESCE(AVG(p.purchase_price), 0)
                FROM purchase_order p
                WHERE p.pnumber = m.mnumber
            ) AS avg,
            m.sname,
            m.amount,
            (m.minimum - m.amount) AS lack,
            m.minimum
            FROM 
            Merchandise m
            WHERE 
            m.mnumber = $mnumber;
        ";
        $result= mysqli_query($db, $sql);
        $row=mysqli_fetch_assoc($result);
        $mnumber=$row['mnumber'];
        $mname=$row['mname'];
        $avg=$row['avg'];
        $sname=$row['sname'];
        $amount=$row['amount'];
        $lack=$row['lack'];
        $min=$row['minimum'];
        echo"商品編號:$mnumber <br>";
        echo"商品名稱:$mname<br>";
        echo"進貨平均單價:$avg<br>";
        echo"供應商名稱:$sname<br>";
        echo"剩餘商品數量:$amount<br>";
        if($lack<=0){
           echo"需採購數量:0<br>"; 
        }
        echo"最低需求庫存量:$min<br>";
    }
?>
<body>
    <div>
    <form name="sales" action="purchaseReport.php" method="post">
        <input type="hidden" name="ID" value="<?=$ID?>">
        <p>商品編號 : <input type=text name="mnumber"></p>
        <p><input type="submit" name="submit" value="確認">
    </form>
    </div>
</body>