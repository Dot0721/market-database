<title>editUser</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
        $UID=$_POST['UID'];
        $name=$_POST['name'];
        $password=$_POST['password'];
        $permissionlevel=$_POST['permissionlevel'];
    }
    else{
        $ID=$_GET['ID'];
        $UID=$_GET['UID'];
    }
    $sql="select * from users where ID=$UID";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_assoc($result);
    if(isset($_POST['change'])){
        $ID=$_POST['ID'];
        $UID=$_POST['UID'];
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
        $sql="UPDATE `users` SET `name`='$name',`password`='$password',`permissionlevel`=$permissionlevel,`casherflag`=$casherflag,`storeflag`=$storeflag,`managerflag`=$managerflag WHERE ID=$UID";
        $result = mysqli_query($db,$sql);
        if (!$result) {
            die('Error: ' . mysqli_error($db));
        } else {
            echo "
                <script>
                setTimeout(function(){window.location.href='UserData.php?ID=" .$ID . "';},600);
                </script>";
            echo '<div class="success">Update successfully ！</div>';                
        }
    }elseif(isset($_POST['delete'])){
        $sql="DELETE FROM `users` WHERE ID=$UID";
        $result = mysqli_query($db,$sql);
        if (!$result) {
            die('Error: ' . mysqli_error($db));
        } else {
            echo "
                <script>
                setTimeout(function(){window.location.href='UserData.php?ID=" .$ID . "';},600);
                </script>";
            echo '<div class="success">Delete successfully ！</div>';                
        }
    }elseif(isset($_POST['back'])){
        echo "
        <script>
        setTimeout(function(){window.location.href='UserData.php?ID=" .$ID . "';},600);
        </script>";
    }
?>
<body>
    <div>
        <form name = "editUser" action= "editUser.php" method="post">
        <input type="hidden" name="ID" value="<?=$ID?>">
        <input type="hidden" name="UID" value="<?=$UID?>">
        <p> ID : <?php echo "$UID" ?> </p>
        <p> 姓名: <input type=text name="name" value="<?php echo $row["name"]?>"></p>
        <p> password: <input type=text name="password" value="<?php echo $row["password"]?>"></p>
        <label for="permissionlevel"> 使用者權限: </label>
        <select id="permissionlevel" name="permissionlevel">
            <?php 
            $permissionlevel = $row["permissionlevel"];
            for ($i = 1; $i <= 3; $i++){
                echo "<option value='$i' ".(($i == $permissionlevel?'selected="selected"':'')).">
                $i</option>";
            }
            ?>
        </select>
        <label for="flag"> 職位: </label>
        <select id="flag" name="flag">
            <?php 
            if($row["casherflag"] == 1){
                $Uflag = 1;
            }elseif($row["storeflag"] == 1){
                $Uflag = 2;
            }else{
                $Uflag = 3;
            }
            for ($i = 1; $i <= 3; $i++){
                if($i == 1){
                    $String = "收銀員/銷售人員";
                }elseif($i == 2){
                    $String = "倉庫管理員";
                }else{
                    $String = "主管";
                }
                echo "<option value='$i' ".(($i == $Uflag?'selected="selected"':'')).">
                $String</option>";
            }
            ?>
        </select>
        <p><input type="submit" name="change" value="更改">
        <?php
            if($UID != $ID){
                echo '<p><input type="submit" name="delete" value="刪除">';
            }
        ?>
        <p><input type="submit" name="back" value="返回">
    </div>
</body>
