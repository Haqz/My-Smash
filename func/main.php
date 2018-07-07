<?php
require_once(file_exists('configs/connect.php') ? 'configs/connect.php' : '../configs/connect.php');
require_once(file_exists('bbcode.php') ? 'bbcode.php' : '../bbcode.php');
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
    	global $db;
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
        $count = $db->prepare("SELECT * FROM posts WHERE user_id=$id");
        $count->execute();
        $cc = $count->rowCount();
        echo'
            <div class="cardP">
                <div class="cardP-block">
                    <h4 class="cardP-title">'.$_SESSION['nick'].'</h4>
                    <img src="../uploads/av.jpg" class="img-circle" width="250" height="250">
                    <p class="cardP-text">  '.$_SESSION['email'].'</p>
                    <p class="cardP-text"> '.$cc.'</p>
                    <p class="cardP-text"> '.$_SESSION['ip'].'</p>
                    <p class="cardP-text"> '.$uis.'</p>
                </div>
            </div>';
    }
    function addPost(){
    	global $db;

		$f1 = $_POST['post'];
		$f2 = $_POST['nick'];
		$f3 = $_POST['id'];
        $f4 = time();
        $f1 = bbcode::tohtml($f1);
		if (!empty($f1)){
            $stmt1 = $db->prepare("UPDATE users SET token = token +1");
            $stmt1->execute();
			$stmt = $db->prepare("INSERT INTO posts(content,creator,user_id,addDate) VALUES(:f1,:f2,:f3,:f4)");
			$stmt->execute(array(':f1' => $f1, ':f2' => $f2, ':f3' => $f3, 'f4'=>$f4));
			$affected_rows = $stmt->rowCount();
			header('Location: index.php');
		}
    }
    function printPosts($where, $order_by){
	global $db;
	foreach($db->query('SELECT * FROM '.$where.' ORDER BY '.$order_by.' DESC') as $row) {
        $addStamp = date("d/m/Y",$row['addDate']);
        	echo'

          <div class="cardP">

          <div class="cardP-block">
            <div class="cardPleft">
            <center><img src="uploads/av.jpg" class="img-circle" height="75" width="75"></center>
                <div class="cardP-profile">'.htmlspecialchars($row['creator'], ENT_QUOTES, 'UTF-8').'</div>
                
            </div>
            <div class="cardP-text"> 
                '.$row['content'].'
            </div>
          </div>
        </div> 
          ';
        }
	}
    function printSessionPosts($limit){
    global $db;
    foreach($db->query('SELECT * FROM posts WHERE user_id='.$_SESSION['id'].' ORDER BY addDate DESC LIMIT '.$limit.' ') as $row) {
            $addStamp = date("d/m/Y",$row['addDate']);
            echo'

          <div class="cardP">
          <div class="cardP-block">
            <div class="cardP-title">'.htmlspecialchars($row['creator'], ENT_QUOTES, 'UTF-8').'</div>
            <p class="cardP-text"> 
                '.$row['content'].'
                <img src="../uploads/av.jpg" class="img-circle" height="50" width="50">
                <div class="cardP-date"> '.$addStamp.'</div>
                
            </p>
          </div>
        </div>
          ';
        }
    }
   function printBestUsers(){
        global $db;
        $stmt = $db->query('SELECT id FROM users');
        $stmt->execute();
        $users = array_column($stmt->fetchAll(), 0);
        
$top = [];
foreach($users as $id) {
    $stmt1 = $db->query("SELECT COUNT(*) FROM posts WHERE user_id=$id");
    $stmt1->execute();
    $posts = array_column($stmt1->fetchAll(), 0);

    $top[$id] = $posts[0];
}
        
arsort($top);

$out = "";

  foreach($top as $id => $posts){
    $stmt = $db->query("SELECT nick FROM users WHERE id=$id");
    $stmt->execute();
    $nick = $stmt->fetchColumn();
      
    $out .= "<div class='sidebar-textbox'>$nick<div class ='sidebar-textbox-right'>$posts</div></div>";
    
}

return $out;
    }
?>