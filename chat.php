<?php 
session_start();
$db = mysqli_connect('localhost', 'root', '','mychat');
$chec = $_SESSION['user'];
$username = "SELECT username FROM signup WHERE username = '$chec'";
$data = mysqli_query($db, $username);
while($result = mysqli_fetch_array($data)) {
  $res = "{$result['username']}";
  }
  if($_SESSION['user']!=$res) {
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Chat - Общайся</title>
<link type="text/css" rel="stylesheet" href="style.css" />
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
<div id="wrapper">
  <div id="menu">
        <p class="welcome">Добро пожаловать, <?php echo $_SESSION['user']; ?><b></b></p>
        <p class="logout"><a id="exit" href="logout.php">Выйти</a></p>
        <div style="clear:both"></div>
    </div>
     
    <div id="chatbox"><?php
    if(file_exists("log.html") && filesize("log.html") > 0){
        $handle = fopen("log.html", "r");
        $contents = fread($handle, filesize("log.html"));
        fclose($handle);
        echo $contents;
    }
    ?></div>
     
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Отправить" />
        <input name="sub" type="submit"  id="sub" value="Очистить чат" />
    </form>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
  $("#sub").click(function(){	
		$.post("clean.php", {text: ''});				
	});
  function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}
  setInterval (loadLog, 200);

</script>
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

