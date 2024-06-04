<title>Login</title>
<?php
    include 'db.php';
    header("Content-Type: text/html; charset=utf8");
    if (isset($_POST['submit'])) {
        $name=$_POST['name'];
        $password=$_POST['password'];
        if ($name && $password) {
            $sql = "select * from users where name='$name' and password='$password'";
            $result = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows) {
                $output=mysqli_fetch_assoc($result);
                $ID=$output['ID'];
                echo '<div >welcome！ </div>';
                echo "
                <script>
                    setTimeout(function(){window.location.href='menu.php?ID=" .$ID . "';},600000);
                </script>";
                exit;
            } else {
                echo '<div>Wrong ID or Password！</div>';
            }
        } else {
            echo '<div>Incompleted form！ </div>';
            echo "
    <script>
        setTimeout(function(){window.location.href='index.php';},200000);
    </script>";
        }
        mysqli_close($db);
    }
?>

<body>
    <div>
        <form name="login" action="index.php" method="post">
        <p>Name : <input type=text name="name"></p>
        <p>Password : <input type=text name="password"></p>
        <p><input type="submit" name="submit" value="登入">
    </div>
</body>