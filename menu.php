<title>menu</title>
<?php
    include 'db.php';
    $id=$_GET['id'];
    $sql="select * from users where id=$id";
    $result= mysqli_query($db, $mysql);
    $row=mysqli_fetch_assoc($find);
    if($row['casherflag']==1){
        echo ' <a href="salesOrder.php?userid=' . $userid . '&postid=' . $postid. '&areaid='.$areaid.'">close post</a>';
    }
?>
