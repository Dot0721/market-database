<title>menu</title>
<?php
    include 'db.php';
    $ID=$_GET['ID'];
    $sql="select * from users where ID=$ID";
    $result= mysqli_query($db, $mysql);
    $row=mysqli_fetch_assoc($find);
    if($row['casherflag']==1){
        echo ' <a href="salesOrder.php?ID=' . $ID . '">Sales Order</a>';
    }
    else if($row['storeflag']==1){
        echo '<a href="purchaseOrder.php?ID=' . $ID . '">Purchase Order</a>';
        echo '<a href="purchaseReport.php?ID=' . $ID . '">Purchase Report</a>';
    }
    else if($row['managerflag']==1){
        echo '<a href="editUser.php?ID=' . $ID . '">edit User</a>';
        echo '<a href="userData.php?ID=' . $ID . '">user data</a>';
        echo '<a href="purchaseReport.php?ID=' . $ID . '">Purchase Report</a>';
        echo '<a href="salesReport.php?ID=' . $ID . '">Sales Report</a>';
        echo '<a href="supplierData.php?ID=' . $ID . '">supplier</a>';
    }
?>
