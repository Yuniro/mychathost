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
    <style>
        .card {
        display:flex;
        justify-content: flex-end;
    }

    .fone {
    background: linear-gradient(90deg, red, green, blue);
    width: 330px;
    height:130px;
    }
    
    #title {
        display:flex;
        justify-content: center;
        color: white;
        text-transform: uppercase;
    }
    #about {
        padding-top: 3px;
        color: white;
        font-size: 12px;
        text-transform: uppercase;
    }
</style>
    <body>
    <form class="registerform" method="POST">
        <h3><label>Заполните поля данными</label></h3>
        <p><input type="text" placeholder="Логин" name="username"></p>
        <p><input type="password" placeholder="Пароль" name="pass"></p>
        <p><button type="submit" name="submit">Войти</button></p>
        <p>Еще не зарегистрированы? </br><a href= "index.php">Зарегистрируйтесь</a>!</p>
    </form>
<div class="card">
        <div class="fone">
                <div id="title">Bussines card</div>
                <div id="about">Sergey Ryzhak</div>
                <div id="about">30/11/1997</div>
                <div id="about">keya9711@gmail.com</div>
                <div id="about">About self: I'm am student, fond of computer games, programming,movies.</div>
            </div>
        </div>
    </body>
</html>
