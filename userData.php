<title>userData</title>
<body>
<table border="1">
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>密碼</th>
        <th>使用者權限</th>
        <th>職位</th>
        <th>設定</th>
    </tr>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
    }
    else{
        $ID=$_GET['ID'];
    }
    echo "<a href='menu.php?ID=".$ID."'> <button> <b> menu </b> </button> </a>";
    $sql = "select * from users group by ID";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $UID = $row["ID"];
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["permissionlevel"] . "</td>";
            if($row['casherflag']==1){
                echo "<td>" . "收銀員/銷售人員" . "</td>";
            }elseif($row['storeflag']==1){
                echo "<td>" . "倉庫管理員" . "</td>";
            }else{
                echo "<td>" . "主管" . "</td>";
            }         
            echo "<td>" . '<a href="editUser.php?ID=' . $ID .'&UID=' . $UID .'">Edit</a>' . "</td>";
            echo "</tr>";
        }
    }else{
        echo "目前沒有資料";
    }
    if(isset($_POST['back'])){
            echo "
                <script>
                setTimeout(function(){window.location.href='menu.php?ID=". $ID."';},600);
                </script>";
    }
?>
</table>
<?php echo '<a href="addUser.php?ID='.$ID.'">新增使用者</a>'; ?>
<form name="user" action="userData.php" method="post">
<input type="hidden" name="ID" value="<?=$ID?>">
<p><input type="submit" name="back" value="返回">
</body> 
