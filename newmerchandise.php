<title>addUser</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
        $mnumber=$_POST['mnumber'];
        $mname=$_POST['mname'];
        $sname=$_POST['sname'];
        $min=$_POST['min'];
    }
    else{
        $ID=$_GET['ID'];
    }
    echo "<a href='menu.php?ID=".$ID."'> <button> <b> menu </b> </button> </a>";
    if(isset($_POST['add'])){
        $ID=$_POST['ID'];
        $mnumber=$_POST['mnumber'];
        $mname=$_POST['mname'];
        $sname=$_POST['sname'];
        $min=$_POST['min'];
        $sql="INSERT INTO merchandise(mnumber, mname, sname, amount, minimum) VALUES ($mnumber,'$mname','$sname',0,$min)";
        $result= mysqli_query($db,$sql);
        if (!$result) {
            die('Error: ' . mysqli_error($db));
        } else {
            echo "
                <script>
                setTimeout(function(){window.location.href='UserData.php?';},60000);
                </script>";
            echo '<div class="success">Update successfully ！</div>';                
        }
    }
?>
<body>
    <form name="addUser" action="newmerchandise.php" method="post">
    <input type="hidden" name="ID" value="<?=$ID?>">
    <p> 商品ID：<input type="text" name="mnumber"></p>
    <p> 商品名稱：<input type="text" name="mname"></p>
    <p> 供應商名稱：<input type="text" name="sname"></p>
    <p> 最小庫存數量：<input type="text" name="min"></p>
    </select>
    <p><input type="submit" name="add" value="新增商品">
</body>