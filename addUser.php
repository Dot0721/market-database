<title>addUser</title>
<?php
    include 'db.php';
    if(isset($_POST['add'])){
        $name=$_POST['name'];
        $password=$_POST['password'];
        $permissionlevel=$_POST['permissionlevel'];
        $casherflag = 0;
        $storeflag = 0;
        $managerflag = 0;
        if($permissionlevel == 1){
            $casherflag = 1;
        }elseif($permissionlevel == 2){
            $storeflag = 1;
        }else{
            $managerflag = 1;
        }
        $sql="INSERT INTO `users`(`name`, `password`, `permissionlevel`, `casherflag`, `storeflag`, `managerflag`) VALUES ('$name',$password,$permissionlevel,$casherflag,$storeflag,$managerflag)";
        $result= mysqli_query($db,$sql);
        if (!$result) {
            die('Error: ' . mysqli_error($db));
        } else {
            echo "
                <script>
                setTimeout(function(){window.location.href='UserData.php?';},600);
                </script>";
            echo '<div class="success">Update successfully ！</div>';                
        }
    }
?>
<body>
    <form name="addUser" action="addUser.php" method="post">
    <p> 姓名：<input type="text" name="name"></p>
    <p> 密碼：<input type="text" name="password"></p>
    <label for="permissionlevel"> 使用者權限： </label>
    <select id="permissionlevel" name="permissionlevel">
    <?php
        for($i=1;$i<=3;$i++){
            echo "<option value\"$i\">$i</option>";
        }
    ?>
    </select>
    <p><input type="submit" name="add" value="新增使用者">
</body>