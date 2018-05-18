<?php
<<<<<<< HEAD
<<<<<<< HEAD
require_once(file_exists('configs/connect.php') ? 'configs/connect.php' : '../configs/connect.php');
=======
$db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
>>>>>>> parent of 90ea3e5... minor manor
=======
require_once '../configs/connect.php';
>>>>>>> parent of 51ed7c7... 0.6.3b
	function checkLoginState(){
		if($_SESSION['zalogowany']){
			return true;
		}else{
			return false;
		}
	}
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
    function printProfile(){
    	$uis = "";
    	switch ($_SESSION['perm']) {
        	case 1:
            	$uis = "Admin";
            	break;
        default:
            $uis = "User";
            break;
    	}

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
    }
    function addPost(){
<<<<<<< HEAD
    	global $db;
<<<<<<< HEAD
=======
    	$db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
>>>>>>> parent of 90ea3e5... minor manor
=======
    	$db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
>>>>>>> parent of 51ed7c7... 0.6.3b

		$sql = "SELECT * FROM posty";
		$result = $db->query($sql);
		$f1 = $_POST['post'];
		$f2 = $_POST['nick'];
		$f3 = $_POST['id'];
		if ($f1 == true){
			$stmt = $db->prepare("INSERT INTO posty(content,creator,user_id) VALUES(:f1,:f2,:f3)");
			$stmt->execute(array(':f1' => $f1, ':f2' => $f2, ':f3' => $f3));
			$affected_rows = $stmt->rowCount();
			header('Location: index.php');
		}
    }
    function printPosts(){
	$db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
	foreach($db->query('SELECT * FROM `posty` ORDER BY `posty`.`id` DESC') as $row) {
        	echo'

          <div class="cardP">
          <div class="cardP-block">
            <h4 class="cardP-title">'.$row['creator'].'</h4>
            <p class="cardP-text"> >> '.$row['content'].'</br>
            <img src="uploads/av.jpg" class="img-circle" height="50" width="50"></p>
          </div>
        </div>
          ';
        }
	}
?>