<?php
    session_start();
    include 'menu.php';
    include '../func/main.php';
    include '../configs/connect.php';


    if(checkLoginState() == false){
    	header('Location: index.php');
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
        printProfile();
    ?>
</body>
</html>