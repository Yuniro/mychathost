
<?php include("header.php"); ?>
<html>
<head>
<title>Регистрация</title>
</head>
<body>
<?php
$db = mysqli_connect('localhost', 'root', '','mychat');
if(isset($_POST['submit'])) {
    $id = uniqid(rand(0,9000000), true);
    $username = mysqli_real_escape_string($db, trim($_POST['username']));
    $names = mysqli_real_escape_string($db, trim($_POST['names']));
    $surname = mysqli_real_escape_string($db, trim($_POST['surname']));
    $pass = mysqli_real_escape_string($db, trim($_POST['pass']));
    $agreepass = mysqli_real_escape_string($db, trim($_POST['agreepass']));
    if($pass != $agreepass) {
        echo '<div style="color: dark;"><p>Введенне пароли не соответсвуют друг другу!</p></div>';
    }
    if((!empty($username)) && (!empty($names)) && (!empty($surname)) && (!empty($pass)) && (!empty($agreepass)) && ($pass == $agreepass)) {
        $query = "SELECT * FROM signup WHERE username = '$username'";
        $data = mysqli_query($db, $query);
        if(mysqli_num_rows($data) == 0) {
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $query = "INSERT INTO signup (user_id, username, names, surname, pass) values ('$id','$username', '$names', '$surname', '$pass')";
            $res = mysqli_query($db, $query);
            if($res) {
                echo "<script>window.location = 'login.php'</script>";
            mysqli_close($db);
            exit();
            } else {
                echo "Не удалось зарегистрироватся";
            }
        }
        else {
            echo "Логин уже существует, придумайте другой!";
        }
    } else {
        echo "Пожалуйста, заполните все поля!";
    }
}
?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="registerform">
    <h3><label>Заполните форму регистрации</label></h3>
   <p><input type="text" name="username" placeholder="Логин" value="<?php echo $username ?>"></p>
   <p><input type="text" name="names" placeholder="Имя" pattern="^(([A-Z^А-Я]{1}[a-z^А-я]{0,29}|[A-Z^А-Я']{1}[a-z^А-я']{0,29})|[A-Z^А-Я]{1}[a-z^А-я]{0,29}[-][A-Z^А-Я']{1}[a-z^А-я']{0,29}|[A-Z^А-Я']{1}[a-z^А-я']{0,29}[-][A-Z^А-Я']{1}[a-z^А-я']{0,29})" value="<?php echo $names ?>"></p>
   <p><input type="text" name="surname" placeholder="Фамилия" pattern="([A-Z^А-Я']{1}[a-z^А-я']{0,29})|([A-Z^А-Я]{1}[a-z^А-я]{0,29)" value="<?php echo $surname ?>"></p>
   <p><input type="password" name="pass" placeholder="Пароль" pattern="[A-Za-z0-9]{4,16}|[А-Яа-я0-9]{4,16}"></p>
   <p><input type="password" name="agreepass" placeholder="Подтвердите пароль" pattern="[A-Za-z0-9]{4,16}|[А-Яа-я0-9]{4,16}"></p>
    <p><button type="submit" name="submit">Регистрация</button></p>
    <p><a href="login.php">Уже зарегистрированы?</a></p>
    </form>
</body>
</html>