<?php
session_start();
$fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>Пользыватель ". $_SESSION['user'] ." покинул эту сессию.</i><br></div>");
    fclose($fp);
session_destroy();
header('Location: login.php');
exit;
?>