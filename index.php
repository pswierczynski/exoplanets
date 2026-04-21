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
<link href="css/slide.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/exoplanets.ico">
<script type="text/javascript" src="js/jquery-1.10.1.js"></script>
<script type="text/javascript" src="js/easySlider1.7.js"></script>

<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({ 
				auto: true, 
				continuous: true
			});
		});	

function slideSwitch() {
    var $active = $('#slideshow IMG.active');

    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');

    var $next =  $active.next().length ? $active.next()
        : $('#slideshow IMG:first');

    $active.addClass('last-active');

    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}

$(function() {
    setInterval( "slideSwitch()", 12000 );
});
</script>

</head>


<body class="bg">
<?php include_once("analyticstracking.php"); ?>
<div class="top">
<div style="width:1150px; background-color:#000">
<div class="top_frame">
<div style="float:left; margin-top:26px"><a href="."><img src="images/logo.png"></a></div>
<div class="top_menu">

<div class="link" style="margin-right:25px; border-bottom: 1px solid #fff; color: #fff; position: relative;"><a href="." class="white">HOME</a></div><div class="link" style="margin-right:15px"><a href="events.php" class="white">EVENTS</a></div><div class="link" style="margin-right:15px"><a href="ranking.php" class="white">RANKING</a></div>
<div class="link" style="margin-right:15px"><a href="about.php" class="white">ABOUT</a></div><div class="link"><a href="contact.php" class="white">CONTACT</a></div>

</div>
</div>
</div>
</div>


<div style="width:1150px;">

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

<?php
/* ZAMIANA PRZESTARZAŁYCH mysql_* NA mysqli + prepared statements + zabezpieczenia podstawowe.
   Zmieniono tylko fragmenty PHP — reszta kodu (HTML/CSS/JS) pozostała bez zmian. */

session_start();

/* Konfiguracja połączenia - jeśli chcesz, przenieś dane do pliku konfiguracyjnego */
$dbHost = 'localhost';
$dbUser = 'przemeks_exoplanets';
$dbPass = 'Przemek121!';
$dbName = 'przemeks_exoplanets';

/* Połączenie mysqli z obsługą błędów */
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    /* Jeżeli połączenie nie działa, przerwij wykonanie - w produkcji lepiej logować błąd zamiast wyświetlać surowe informacje */
    die("Database connection failed.");
}

/* Inicjalizacja zmiennej sesyjnej */
if (empty($_SESSION["zalogowany"])) $_SESSION["zalogowany"] = 0;

/* Funkcja pokazująca formularz logowania (treść identyczna jak w oryginale) */
function ShowLogin($komunikat = ""){
echo'
<div class="top_info">
<div style="float:left">LOGIN TO YOUR PLANET</div>
</div>

<div class="main_frame_top"></div>
<div class="main_frame" style="text-align:center">

<div class="login">

<div style="font-size:16px; font-weight:bold; margin-bottom:10px; width:340px; text-align:center">WELCOME IN OUR UNIVERSE</div>
<div style="font-size:12px; margin-top:8px; margin-bottom:30px">Become a part of our journey and explore mysterious cosmos.<br>Get your own planet, create life and protect your planet against cosmic events.</div>

<div style="font-size:12px; margin-top:8px; margin-bottom:30px">Dear Universe Builder, to login to our universe you have to <a href="tips.php" class="odnosnik"><strong>register</strong></a> first.</div>
<form action="" method=post>
<input type="input" name="login" class="input" placeholder="Login (BGG user name)">
<input type="password" name="password" class="input" placeholder="Password">
<input type="submit" value="LOGIN" class="button">
</form>
<div style="padding-top:12px; font-size:14px; float:left; color:#f1be4c">'.htmlspecialchars($komunikat).'</div>
<div style="font-size:14px; margin-top:12px; width:345px; text-align:right"><a href="tips.php" class="odnosnik" style="color:#fff">Register new planet</a></div>

</div>
</div>
<div class="main_frame_bot"></div>';
}

/* Wylogowanie */
if (isset($_GET["logout"]) && $_GET["logout"] === "yes") {
    $_SESSION["zalogowany"] = 0;
    /* Bezpieczne zakończenie sesji */
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

/* Obsługa logowania */
if ($_SESSION["zalogowany"] != 1) {
    if (!empty($_POST["login"]) && !empty($_POST["password"])) {
        $login = trim($_POST["login"]);
        $password = trim($_POST["password"]);

        /* Przygotowane zapytanie - wybieramy id i (jeśli w bazie jest) hasło.
           UWAGA: jeśli hasła są w bazie haszowane, użyj password_verify(). */
        $stmt = $mysqli->prepare("SELECT user_id, user_password FROM users WHERE user_login = ?");
        if ($stmt) {
            $stmt->bind_param("s", $login);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                /* Jeżeli hasła przechowywane są jawnie (tak jak w oryginale) - porównanie bez hash.
                   Jeżeli wolisz bezpieczeństwo, zmień na password_hash()/password_verify(). */
                if ($password === $row['user_password']) {
                    $_SESSION['id'] = $row['user_id'];
                    $_SESSION["zalogowany"] = 1;
                    /* Przekierowanie po zalogowaniu (oryginalnie użyto Refresh:0) */
                    header('Location: .');
                    exit;
                } else {
                    ShowLogin("This planet doesn't exist yet");
                }
            } else {
                ShowLogin("This planet doesn't exist yet");
            }

            $stmt->close();
        } else {
            /* W razie błędu przygotowania zapytania */
            ShowLogin("Login error.");
        }
    } else {
        ShowLogin();
    }
} else {
    /* Pobranie danych zalogowanego użytkownika - przygotowane zapytanie */
    $userId = isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0;
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($wiersz = $res->fetch_assoc()) {

            $name = strtoupper(htmlspecialchars($wiersz['user_login']));

            echo'<div class="top_info">
<div style="float:left">MAIN EVENTS</div>
<div style="float:right">PLANET: <strong>'.$name.'</strong> / <a href="./?logout=yes" class="odnosnik">LOGOUT</a></div>
</div>

<div class="main_frame_top"></div>
<div class="main_frame">

<div id="container" style="float:left; z-index:0;">
<div id="content">
<div id="slider" >
<ul>

<li>

<div style="height:261px; height:262px"><img src="images/wormhole.png"></div>
<div class="main_left_text">
<div style="font-weight:bold; font-size:18px; margin-bottom:20px">3. CREATE A WORMHOLE</div>
In this event we will go through 3 Wormholes. But first thing to do is to decide in which order we will visit them - read more in <strong><a href="https://boardgamegeek.com/thread/1334934/event-entering-wormhole" target="_blank" class="odnosnik">this thread.</a></strong><br><br>
It may be important decision... We are doing this first time, so we do not know what we will find there: Resources? Threat? or who knows... Maybe both!<br><br>
For voiting players we have prepared special WormholeBadge . It will be visible after voting in your ExoPlanets dashboard
</div>

</li>

<li>

<div style="height:261px; height:262px"><img src="images/note.png"></div>
<div class="main_left_text">
<div style="font-weight:bold; font-size:18px; margin-bottom:20px">2. SEARCHING FOR PARTICLE</div>
In this event you need to become a cosmic creators. We need to discover new resource in our universe which will help you build your world and universe much effective.
We are looking for new particle… the elementary particle.
<br><br>
To receive elementary particle (you can use it as any recource) and particle badges you need to post in <strong><a href="https://boardgamegeek.com/thread/1325594/event-searching-particle" target="_blank" class="odnosnik">this thread</a></strong> a music video that will be ideally suited to relax and thinking about the cosmos.
</div>

</li>

<li>
<div style="height:261px; height:262px"><img src="images/sun.png"></div>
<div class="main_left_text">
<div style="font-weight:bold; font-size:18px; margin-bottom:20px">1. COLLECT LIGHT</div>
The first resource which you can collect is the solar energy. You have got it 
from your sun. Therefore, we want to invite you to our thread on BGG, where
you can see your sun located in the center of your solar system. <br><br>Track <strong><a href="https://boardgamegeek.com/thread/1320125/sunrise" target="_blank" class="odnosnik">this 
topic</a></strong> to learn more about your sun and to keep up with information how it will impact on your system and your planet.
<br><br>
It is time to recive your first recource which will help you to create life or protect your planet. To get your Light Token like <strong><a href="https://boardgamegeek.com/thread/1320125/sunrise" target="_blank" class="odnosnik">this thread.</a></strong>
</div>
</li>

</ul>
</div>
</div>
</div>



<div class="main_right">
<div style="height:231px; height:262px; margin-top:16px"><img src="planets/'.htmlspecialchars($wiersz['planet']).'"></div>
<div style="height:77px; height:77px; position: absolute; margin-left:170px; margin-top:-230px"><img src="images/'.htmlspecialchars($wiersz['life']).'"></div>
<div class="main_right_bot" style="text-align:left">

<div style="font-weight:bold; font-size:18px; margin-top:14px">RESOURCE TOKENS <img src="images/'.htmlspecialchars($wiersz['life_cost']).'" style="margin-bottom:-6px"></div>

<div class="tokens_bar">
<div class="token" style="margin-right:18px"><img src="images/'.htmlspecialchars($wiersz['token1']).'"></div>
<div class="token" style="margin-right:18px"><img src="images/'.htmlspecialchars($wiersz['token2']).'"></div>
<div class="token" style="margin-right:18px"><img src="images/'.htmlspecialchars($wiersz['token3']).'"></div>
<div class="token" style="margin-right:18px"><img src="images/'.htmlspecialchars($wiersz['token4']).'"></div>
<div class="token" style="margin-right:17px"><img src="images/'.htmlspecialchars($wiersz['token5']).'"></div>
<div class="token" style="margin-right:0px"><img src="images/'.htmlspecialchars($wiersz['token6']).'"></div>
</div>

<div style="font-weight:bold; font-size:14px; margin-top:5px">SPECIAL BADGES</div>

<div class="badges_bar">
<div class="badge" style="margin-right:10px"><img src="images/'.htmlspecialchars($wiersz['badge1']).'"></div>
<div class="badge" style="margin-right:10px"><img src="images/'.htmlspecialchars($wiersz['badge2']).'"></div>
<div class="badge" style="margin-right:10px"><img src="images/'.htmlspecialchars($wiersz['badge3']).'"></div>
<div class="badge" style="margin-right:10px"><img src="images/'.htmlspecialchars($wiersz['badge4']).'"></div>
<div class="badge" style="margin-right:10px"><img src="images/'.htmlspecialchars($wiersz['badge5']).'"></div>
<div class="badge" style="margin-right:0px"><img src="images/'.htmlspecialchars($wiersz['badge6']).'"></div>
</div>

<div class="stats">
<div style="float:left">RANK: <a href="ranking.php" class="odnosnik">'.htmlspecialchars($wiersz['rank']).'</a></div> 
<div style="float:right">POINTS: '.htmlspecialchars($wiersz['points']).'</div>
</div>

</div>
</div>
</div>

<div class="main_frame_bot"></div>';
        }

        $stmt->close();
    } else {
        /* Jeżeli przygotowanie zapytania się nie powiodło */
        echo '<div class="main_frame"><div class="main_frame_top"></div><div class="main_frame" style="text-align:center">User data error.</div><div class="main_frame_bot"></div></div>';
    }
}

/* Zamknięcie połączenia */
$mysqli->close();
?>

<div class="foot">made by <a href="mailto:przemyslaw.swierczynski@o2.pl" class="odnosnik">Przemyslaw Świerczyński</a></div>

</div>

</div>

</body>
</html>