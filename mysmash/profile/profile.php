<?php
    session_start();
    include 'menu.php';

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        $_SESSION['ip'] = $ipaddress;
    }


    if((!isset($_SESSION['zalogowany']))){
    	header('Location: index.php');
    }

    $db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');


    $uis = "";

    if ($_SESSION['perm'] == 1) {
    	$uis = "Admin";
    }else{
    	$uis = "User";
    }


    get_client_ip();

?>
<!DOCTYPE html>
<html>
<head>
	<title>MySmash</title>
	<?php include '../configs/style.php';?>
	<link  type="text/css" href="mainstyle.css" rel="stylesheet">
</head>
<body>
    <?php 
        $id = $_SESSION['id'];
        foreach($db->query("SELECT Count(user_id) AS id FROM posty WHERE user_id=$id") as $row) {
        	echo'
            <div class="cardP">
                <div class="cardP-block">
                    <h4 class="cardP-title">'.$_SESSION['nick'].'</h4>
                    <img src="../uploads/av.jpg" class="img-circle" width="250" height="250">
                    <p class="cardP-text">  '.$_SESSION['email'].'</p>
                    <p class="cardP-text"> '.$row['id'].'</p>
                    <p class="cardP-text"> '.$_SESSION['ip'].'</p>
                    <p class="cardP-text"> '.$uis.'</p>
                </div>
            </div>';
        }
    ?>
</body>
</html>