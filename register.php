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
</head>


<body class="bg">
<?php include_once("analyticstracking.php") ?>
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

<div style="float:left; margin-top:322px;"><img src="images/arrow.png"></div>



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
<div style="float:left">REGISTER NEW PLANET</div>

</div>




<div class="main_frame_top"></div>
<div class="main_frame" style="text-align:center">

<div class="login">

<div style="font-size:16px; font-weight:bold; margin-bottom:10px; width:340px; text-align:center">CREATE A NEW PLANET</div>
<div style="font-size:12px; margin-top:8px; margin-bottom:30px">Remember to use exactly the same nickname as your BGG account. If any trouble contact with us <a href="contact.php" class="odnosnik"><strong>here.</strong></a></div>

<div style="font-size:12px; margin-top:0px; margin-bottom:30px">In nature creating a planet takes bilions of years but in Exoplanets universe it takes just a moment. Please check your created account in few hours.</div>

<?php
// --- POPRAWIONA CZĘŚĆ PHP ---

$conn = new mysqli("localhost", "przemeks_exoplanets", "Przemek121!", "przemeks_exoplanets");
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}
$conn->set_charset("utf8mb4");

function ShowForm($komunikat=""){	
    echo '<form action="register.php" method="post">
    <input type="input" name="login" class="input" placeholder="Login (BGG user name)">
    <input type="password" name="password" class="input" placeholder="Password">
    <input type="input" name="email" class="input" placeholder="E-mail">
    <input type="hidden" value="1" name="send">
    <input type="submit" value="Register" class="button">
    </form>
    <div style="padding-top:12px; font-size:14px; float:left; color:#f1be4c">'.$komunikat.'</div>';
}

if (isset($_POST["send"]) && $_POST["send"] == 1) {
    $login = trim($_POST["login"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $email = trim($_POST["email"] ?? '');

    if (!empty($login) && !empty($password) && !empty($email)) {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            ShowForm("This planet already exists");
        } else {
            $stmt = $conn->prepare("INSERT INTO users (user_login, user_password, user_email, planet, token1, token2, token3, token4, token5, token6, badge1, badge2, badge3, badge4, badge5, badge6, life, life_cost, rank, points)
            VALUES (?, ?, ?, 'planet_blank.png', 'token.png', 'token.png', 'token.png', 'token.png', 'token.png', 'token.png',
            'badge.png', 'badge.png', 'badge.png', 'badge.png', 'badge.png', 'badge.png', 'life_blank.png', 'var1.png', 'Unknown', 'Unknown')");
            $stmt->bind_param("sss", $login, $password, $email);
            if ($stmt->execute()) {
                ShowForm("Planet created");
                header('Refresh:2; URL=.');
            } else {
                ShowForm("Database error");
            }
        }
    } else {
        ShowForm("Fill-in all fields");
    }
} else {
    ShowForm();
}

$conn->close();
// --- KONIEC POPRAWIONEGO PHP ---
?>


</div>
</div>

<div class="main_frame_bot"></div>
<div class="foot">made by <a href="mailto:przemyslaw.swierczynski@o2.pl" class="odnosnik">Przemyslaw Świerczyński</div>
</div>

</div>



</body>
</html>
