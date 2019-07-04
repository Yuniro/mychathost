<?
session_start();
if(isset($_SESSION['user'])){
    $text = $_POST['text'];
    var_dump([$_POST['text']]);
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['user']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>
