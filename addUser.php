<title>addUser</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
        $name=$_POST['name'];
        $password=$_POST['password'];
        $permissionlevel=$_POST['permissionlevel'];
    }
    else{
        $ID=$_GET['ID'];
    }
    if(isset($_POST['add'])){
        $name=$_POST['name'];
        $password=$_POST['password'];
        $permissionlevel=$_POST['permissionlevel'];
        $flag=$_POST['flag'];
        $casherflag = 0;
        $storeflag = 0;
        $managerflag = 0;
        if($flag == 1){
            $casherflag = 1;
        }elseif($flag == 2){
            $storeflag = 1;
        }else{
            $managerflag = 1;
        }
        $sql="INSERT INTO `users`(`name`, `password`, `permissionlevel`, `casherflag`, `storeflag`, `managerflag`) VALUES ('$name','$password',$permissionlevel,$casherflag,$storeflag,$managerflag)";
        $result= mysqli_query($db,$sql);
        if (!$result) {
            die('Error: ' . mysqli_error($db));
        } else {
            echo "
                <script>
                setTimeout(function(){window.location.href='UserData.php?ID=".$ID."';},600);
                </script>";
            echo '<div class="success">Update successfully ！</div>';                
        }
    }elseif(isset($_POST['back'])){
        echo "
        <script>
        setTimeout(function(){window.location.href='UserData.php?ID=".$ID."';},600);
        </script>";
    }
?>
<body>
    <form name="addUser" action="addUser.php" method="post">
    <input type="hidden" name="ID" value="<?=$ID?>">
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
    <label for="flag"> 職位: </label>
    <select id="flag" name="flag">
        <?php 
        for ($i = 1; $i <= 3; $i++){
            if($i == 1){
                $String = "收銀員/銷售人員";
            }elseif($i == 2){
                $String = "倉庫管理員";
            }else{
                $String = "主管";
            }
            echo "<option value='$i' >$String</option>";
        }
        ?>
    </select>
    <p><input type="submit" name="add" value="新增使用者"> <p><input type="submit" name="back" value="返回">
</body>
