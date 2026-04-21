<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Exoplanets</title>
<meta name="title" content="Exoplanets" />
<meta name="description" content="Exoplanets" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/exoplanets.ico">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.js"></script>
<script type="text/javascript" src="js/slimScroll.min.js"></script>

</head>


<body class="bg">
<?php include_once("analyticstracking.php") ?>
<div class="top">
<div style="width:1150px; background-color:#000">
<div class="top_frame">
<div style="float:left; margin-top:26px"><a href="."><img src="images/logo.png"></a></div>
<div class="top_menu">

<div class="link" style="margin-right:25px;"><a href="." class="white">HOME</a></div><div class="link" style="margin-right:15px"><a href="events.php" class="white">EVENTS</a></div><div class="link" style="margin-right:15px"><a href="ranking.php" class="white" style="border-bottom: 1px solid #fff; color: #fff; position: relative;">RANKING</a></div>
<div class="link" style="margin-right:15px"><a href="about.php" class="white">ABOUT</a></div><div class="link"><a href="contact.php" class="white">CONTACT</a></div>

</div>
</div>
</div>
</div>


<div style="width:1150px;">
<div style="float:left; margin-top:322px;"><img src="images/arrow.png"></div>
<div style="float:right; margin-top:322px;"><img src="images/arrow-right.png"></div>


<div class="main">

<a href="https://boardgamegeek.com/boardgame/163976/exoplanets" target="_blank" class="odnosnik">
<div class="top_bgg">
<div style="float:right"><img src="images/bgg.png"></div>
<div style="float:right; margin-right:5px; margin-top:7px">
<div style="color:#fff">BoardGameGeek PRE-PREMIERE GAME</div>
<div style="font-size:9px">VISIT EXOPLANETS PROFILE</div>
</div></a>
</div>



<div class="top_info">
<div style="float:left">RANKING OF ALL PLANETS</div>
</div>

<div class="main_frame_top"></div>
<div class="main_frame" style="text-align:center">

<div id="test1" style="text-align:left; padding-bottom:0px; padding-top:0px;">



<?php
// --- POPRAWIONA CZĘŚĆ PHP ---

$conn = new mysqli("localhost", "przemeks_exoplanets", "Przemek121!", "przemeks_exoplanets");
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

$sql = "SELECT * FROM `users` ORDER BY `user_id` DESC";
$result = $conn->query($sql);

$number = 0;
if ($result && $result->num_rows > 0) {
    while ($wiersz = $result->fetch_assoc()) {
        $number++;

        $name = ucwords(strtolower($wiersz['user_login']));
        echo '<div style="padding-top:18px; margin-bottom:6px; padding-bottom:5px; font-size:17px; width:830px; margin-right:70px; height:30px; background-color:rgba(0,0,0,0.2); border-radius: 15px;">
        <div style="float:left; padding-left:20px; margin-right:20px; padding-right:10px; width:45px; text-align:right; border-right-style:solid; border-width:2px; border-color:#002343">
        <div style="float:right"> ' . $number . '</div>
        <div style="font-size:12px; opacity:0.5; padding-top:4px; float:right; margin-right:2px">#</div></div>
        <div style="float:left; width:60px"><img src="planets/' . htmlspecialchars($wiersz['planet']) . '" style="height:30px; margin-top:-6px;"></div>
        <div style="float:left;width:235px"><a href="ranking.php?id=' . htmlspecialchars($wiersz['user_id']) . '" class="odnosnik">' . htmlspecialchars($name) . '</a></div>

        <div class="badge" style="margin-right:10px"><img src="images/' . htmlspecialchars($wiersz['badge1']) . '"></div>
        <div class="badge" style="margin-right:10px"><img src="images/' . htmlspecialchars($wiersz['badge2']) . '"></div>
        <div class="badge" style="margin-right:10px"><img src="images/' . htmlspecialchars($wiersz['badge3']) . '"></div>
        <div class="badge" style="margin-right:10px"><img src="images/' . htmlspecialchars($wiersz['badge4']) . '"></div>
        <div class="badge" style="margin-right:10px"><img src="images/' . htmlspecialchars($wiersz['badge5']) . '"></div>
        <div class="badge" style="margin-right:10px"><img src="images/' . htmlspecialchars($wiersz['badge6']) . '"></div>

        <div style="float:right; padding-right:20px">' . htmlspecialchars($wiersz['points']) . '</div></div>';
    }
} else {
    echo "<p style='color:#fff'>No planets found in ranking.</p>";
}

$conn->close();

// --- KONIEC POPRAWIONEGO PHP ---
?>

</div>

<script type="text/javascript">
		  $(function(){
			  $('#test1').slimScroll({
				  height: '526px',
                  width: '880px',
				  alwaysVisible: true,
				  start: 'top',
				  wheelStep: 10
			  })

			  $('#scrollDown').click(function(){
				  $('#testrailalwaysvisible').slimScroll({ scroll: '50px' });
			  });
			  $('#scrollUp').click(function(){
				  $('#testrailalwaysvisible').slimScroll({ scroll: '-50px' });
			  });

			  $('#noinitialcontent').slimScroll({ 
				  width: '400px',
				  alwaysVisible: true
			  });
			  $('#notlongenough').slimScroll({ width:'400px', height:'300px' });
			  
		  });
</script>


</div>

<div class="main_frame_bot"></div>


<div class="foot">made by <a href="mailto:przemyslaw.swierczynski@o2.pl" class="odnosnik">Przemyslaw Świerczyński</div>


</div>

</div>



</body>
</html>
