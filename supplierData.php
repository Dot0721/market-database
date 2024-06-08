<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .name{
            width:200px;
        }
        .address{
            width:200px;
        }
        .contact-cell {
            width: 200px; /* 根據需要調整這裡的寬度 */
        }
        .control{
            width: 100px;
        }
    </style>
</head>
<body>
<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID = $_POST['ID'];
} else {
    $ID = $_GET['ID'];
}
    echo "<a href='menu.php?ID=" . $ID . "'> <button> <b> menu </b> </button> </a>";
?>
<table>
    <tr>
        <th>名稱</th>
        <th>地址</th>
        <th>聯絡方式</th>
        <th>操作</th>
    </tr>
    <?php
    $sql = "SELECT * FROM supplier";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='name'>" . $row["name"] . "</td>";
            $name = $row["name"];
            echo "<td class='address'>" . $row["address"] . "</td>";
            $consql = "SELECT * FROM connection WHERE name = '$name'";
            $conre = mysqli_query($db, $consql);
            $n = mysqli_num_rows($conre);
            echo "<td class='contact-cell'>";
            for ($i = 0; $i < $n; $i++) {
                $conro = mysqli_fetch_assoc($conre);
                $way = $conro['way'];
                echo $way . "<br>"; // 每個聯絡方式換行顯示
            }
            echo "</td>";
            echo "<td class='control'><a href='editSupplier.php?ID=" . $ID . "&name=".$name."'>Edit</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>目前沒有資料</td></tr>";
    }
    ?>
</table>
<?php echo '<a href="addSupplier.php?ID='.$ID.'">新增供應商</a>'; ?>
<form name="user" action="suppilerData.php" method="post">
<input type="hidden" name="ID" value="<?=$ID?>">
</body> 