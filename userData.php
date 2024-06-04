<title>userData</title>
<body>
<table border="1">
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>密碼</th>
        <th>使用者權限</th>
        <th>設定</th>
    </tr>
<?php
    include 'db.php';
    $sql = "select * from users group by ID";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $ID = $row["ID"];
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["permissionlevel"] . "</td>";
            echo "<td>" . '<a href="editUser.php?ID=' . $ID .'">Edit</a>' . "</td>";
            echo "</tr>";
        }
    }else{
        echo "目前沒有資料";
    }
    if(isset($_POST['back'])){
        $sql="select * from users where permissionlevel=3 LIMIT 1";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        if (!$result) {
            die('Error: ' . mysqli_error($db));
        } else {
            echo "
                <script>
                setTimeout(function(){window.location.href='menu.php?ID=" .$row['ID']."';},600);
                </script>";
        }
    }
?>
</table>
<?php echo '<a href="addUser.php?">新增使用者</a>'; ?>
<form name="user" action="userData.php" method="post">
<p><input type="submit" name="back" value="返回">
</body> 
