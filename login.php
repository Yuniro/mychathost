<?php
    session_start();
    $db = mysqli_connect('localhost', 'root', '','mychat');
    if( isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($db, trim($_POST['username']));
        $_SESSION['user']=$username;
        Header("Location:chat.php");
        
        $query = "SELECT * FROM signup WHERE username = '$username'";
        $password = "SELECT pass FROM signup";
        $data = mysqli_query($db, $query);
        $date = mysqli_query($db, $password);
        while($result = mysqli_fetch_array($date)) {
        $res = "{$result['pass']}";
        }
        if(mysqli_num_rows($data) != 0) {
            if(password_verify($_POST['pass'], $res)) {
             echo "<script>window.location = 'chat.php'</script>";
            } else {
                echo "Пароль введен не верно!";
            }
        } else {
            echo "Пользователя с таким логином не существует!";
        }
    }
    include("header.php");
    ?>
<html>
    <head>
        <title>Вход</title>
    </head>
    <body>
    <form class="registerform" method="POST">
        <h3><label>Заполните поля данными</label></h3>
        <p><input type="text" placeholder="Логин" name="username"></p>
        <p><input type="password" placeholder="Пароль" name="pass"></p>
        <p><button type="submit" name="submit">Войти</button></p>
        <p>Еще не зарегистрированы? </br><a href= "index.php">Зарегистрируйтесь</a>!</p>
    </form>
    </body>
</html>