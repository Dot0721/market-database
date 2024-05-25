<title>Login</title>
<?php
    include 'db.php';
    include 'style.html';
    header("Content-Type: text/html; charset=utf8");
    if (isset($_POST['submit'])) {
        $id=$_POST['id'];
        $password=$_POST['password'];
        if ($name && $password) {
            $sql = "select * from user where id='$id' and password='$password'";
            $result = mysqli_query($db, $sql);
            if ($rows) {
                $output=mysqli_fetch_assoc($result);
                $id=$output['id'];
                echo '<div class="sucess">welcome！ </div>';
                echo "
                <script>
                    setTimeout(function(){window.location.href='menu.php?id=" .$id . "';},600);
                </script>";
                exit;
            } else {
                echo '<div class="warning">Wrong ID or Password！</div>';
            }
        } else {
            echo '<div class="warning">Incompleted form！ </div>';
            echo "
    <script>
        setTimeout(function(){window.location.href='index.php';},2000);
    </script>";
        }
        mysqli_close($db);
    }
?>

<body>
    <div>
        <form name="login" action="index.php" method="post">
        <p>ID : <input type=text name="id"></p>
        <p>Password : <input type=text name="password"></p>
        <p><input type="submit" name="submit" value="登入">
    </div>
</body>