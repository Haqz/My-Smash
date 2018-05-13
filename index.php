<?php
  include 'configs/information.php';
	session_start();
	//error_reporting(0);
		include 'func/addPost.php';

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo "$pagename"; ?></title>
  <?php include 'configs/style.php'; ?>
</head>
<body>

  <?php include 'page/menu.php'; 
  	if(isset($_SESSION['blad'])){
      echo '<div class="alert alert-danger" role="alert" style="color: white">'.$_SESSION['blad'].'</div>';
    }	

  ?>

  <div class="container">
    <?php
      if ((isset($_SESSION['zalogowany'])))
                  {
                    echo '
                <form  method="post">
                <input type="hidden" name="nick" value="'.$_SESSION['nick'].'">
                <input type="hidden" name="id" value="'.$_SESSION['id'].'">
                  <input type="textarea" class="form-control" rows="3" id="textArea" name="post"></textarea>
                </form>
                ';
              }
    ?>
    <div class="row">
    <?php
      $db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');

      $sql = "SELECT * FROM posty";
      $result = $db->query($sql);

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
    ?>
    </div>
  </div>
</body>
</html>
