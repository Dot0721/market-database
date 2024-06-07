<title>salesOrder</title>
<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ID=$_POST['ID'];
    }
    else{
        $ID=$_GET['ID'];
    }
    echo "<a href='menu.php?ID=".$ID."'> <button> <b> menu </b> </button> </a>";
    if (isset($_POST['submit'])) {
        $ID=$_POST['ID'];
        $name=$_POST['name'];
        $address=$_POST['address'];
        $sql="INSERT INTO supplier (name, address)
        VALUES ('$name', '$address');";
        $inputCount = isset($_POST['inputCount']) ? (int)$_POST['inputCount'] : 0;
        $inputs = isset($_POST['dynamic-input']) ? $_POST['dynamic-input'] : [];
        $result = mysqli_query($db, $sql);
        for ($i = 0; $i < $inputCount; $i++) {
            $value = isset($inputs[$i]) ? htmlspecialchars($inputs[$i], ENT_QUOTES, 'UTF-8') : '';
            echo "$value";
            $sql = "INSERT INTO connection (way, name) 
            VALUES ('$value', '$name')";
            $result = mysqli_query($db, $sql);
        }
                echo '<div class="success">Insert successfully ！</div>';
                echo "
                    <script>
                    setTimeout(function(){window.location.href='menu.php?ID=" .$ID . "';},600);
                    </script>";
    }
?>
<body>
    <div>
        <form name="sales" action="supplierData.php" method="post">
        <input type="hidden" name="ID" value="<?=$ID?>">
        <p>供應商名稱 : <input type="text" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '' ?>"></p>
        <p>地址 : <input type="text" name="address" value="<?= isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8') : '' ?>"></p>
        <?php
        // 初始化輸入框數量
        $inputCount = isset($_POST['inputCount']) ? (int)$_POST['inputCount'] : 0;
        $inputs = isset($_POST['dynamic-input']) ? $_POST['dynamic-input'] : [];
        // 檢查是否提交表單來添加新的輸入框
        if (isset($_POST['addInput'])) {
            $inputCount++;
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
                    echo '</div>';
                }
                ?>
            </div>
            <input type="hidden" name="inputCount" value="<?= $inputCount ?>">
            <button type="submit" name="addInput">新增聯絡方式 </button>
            <p><input type="submit" name="submit" value="新增">
        </form>
    </div>
</body>