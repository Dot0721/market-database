<title>editUser</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
        $name=$_POST['name'];
    }
    else{
        $ID=$_GET['ID'];
        $name=$_GET['name'];
    }
    echo "<a href='menu.php?ID=".$ID."'> <button> <b> menu </b> </button> </a>";
    $sql="select * from supplier where name='$name'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_assoc($result);
    $name=$row['name'];
    $address=$row['address'];
    if(isset($_POST['change'])){
        $ID=$_POST['ID'];
        $name=$_POST['name'];
        $address=$_POST['address'];
        $sql="UPDATE `supplier` SET `name`='$name',`address`='$address' WHERE name='$name'";
        $result = mysqli_query($db,$sql);
        if (!$result) {
            die('Error: ' . mysqli_error($db));
        } else {
                $sql="DELETE FROM connection
                WHERE name = '$name'";
                $result = mysqli_query($db,$sql);
                $inputCount = isset($_POST['inputCount']) ? (int)$_POST['inputCount'] : 0;
                $inputs = isset($_POST['dynamic-input']) ? $_POST['dynamic-input'] : [];
                for ($i = 0; $i < $inputCount; $i++) {
                    $value = isset($inputs[$i]) ? htmlspecialchars($inputs[$i], ENT_QUOTES, 'UTF-8') : '';
                    echo "$value";
                    $sql = "INSERT INTO connection (way, name) 
                    VALUES ('$value', '$name')";
                    $result = mysqli_query($db, $sql);
                }
            echo "
                <script>
                setTimeout(function(){window.location.href='supplierData.php?ID=" .$ID . "';},600);
                </script>";
            echo '<div class="success">Update successfully ！</div>';                
        }
    }elseif(isset($_POST['delete'])){
        $sql="DELETE FROM connection
                WHERE name = '$name'";
        $result = mysqli_query($db,$sql);
        $sql="DELETE FROM `supplier` WHERE name='$name'";
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
    }
?>
<body>
    <div>
        <form name="sales" action="editSupplier.php" method="post">
        <input type="hidden" name="ID" value="<?=$ID?>">
        <input type="hidden" name="name" value="<?=$name?>">
        <p>供應商名稱 : <input type="text" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"></p>
        <p>地址 : <input type="text" name="address" value="<?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?>"></p>
        <?php
        // 初始化輸入框數量
        $inputCount = isset($_POST['inputCount']) ? (int)$_POST['inputCount'] : 0;
        $inputs = isset($_POST['dynamic-input']) ? $_POST['dynamic-input'] : [];
        // 檢查是否提交表單來添加新的輸入框
        if (isset($_POST['addInput'])) {
            $inputCount++;
        }
        if (isset($_POST['deleteInput'])) {
            $inputCount--;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dynamic-input'])) {
            $inputs = $_POST['dynamic-input'];
        }
        ?>
        <form method="post">
            <div id="input-container">
                <?php
                // 根據輸入框數量動態生成輸入框
                for ($i = 0; $i < $inputCount; $i++) {
                    $value = isset($inputs[$i]) ? htmlspecialchars($inputs[$i], ENT_QUOTES, 'UTF-8') : '';
                    echo '<div class="input-container">';
                    echo '<input type="text" name="dynamic-input[]" value="' . $value . '">';
                    echo '<button type="submit" name="deleteInput">delete </button>';
                    echo '</div>';
                }
                ?>
            </div>
            <input type="hidden" name="inputCount" value="<?= $inputCount ?>">
            <button type="submit" name="addInput">新增聯絡方式 </button>
            <p><input type="submit" name="change" value="更新">
            <p><input type="submit" name="delete" value="刪除">
        </form>
    </div>
</body>