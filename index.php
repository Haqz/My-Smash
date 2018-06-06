<?php
  include 'configs/information.php';
  include 'func/main.php';
	session_start();
	//error_reporting(0);
  if(isset($_POST['post'])){
    addPost();
  }

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo "$pagename"; ?></title>
  <?php include 'configs/style.php'; ?>
</head>
<body>
  
<nav class="navbar">
        <?php
          if (isset($_SESSION['zalogowany'])){
            if ($_SESSION['admin']){
              echo '<li><a href="acp/index.php"><span class="glyphicon glyphicon-bullhorn"></span> Panel</a></li>';
            }
            echo '
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="profile/profile.php"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
                  <li><a href="func/logout.php"><span class="glyphicon glyphicon-log-in"></span> Wyloguj</a></li>
                </ul>
              </li> ' ;
          } else{
              echo '<li>
                      <a href="func/rejestracja.php"><span class="glyphicon glyphicon-user"></span> Rejestracja</a>
                    </li>' ;
            }
        ?>
</nav>
  <?php
  	if(isset($_SESSION['blad'])){
      echo '<div class="alert alert-danger" role="alert" style="color: white">'.$_SESSION['blad'].'</div>';
    }	

  ?>

  <div class="containerMain">
    <?php
      if (checkLoginState()){
        echo '
          <form method="post" style="margin-bottom: 15px;">
            <input type="hidden" name="nick" value="'.$_SESSION['nick'].'">
            <input type="hidden" name="id" value="'.$_SESSION['id'].'">
            <textarea class="forms" cols="50" rows="5" name="post" placeholder="Type something" onkeypress="if(event && event.keyCode == 13 && !event.shiftKey) { this.parentElement.submit(); }"></textarea>
          </form>';
      }
    ?>
    <div class="contentLeft">
        <?php
          printPosts("posts","id");
        
        ?>
        </div>
      
          
          <div class="sidebar-menu">
              <?php
      if(checkLoginState()==false){
          echo'
    <div class="sidebar-menu-content">
        <h4>Login now!</h4>
        <form role="form" action="func/zaloguj.php" method="post" accept-charset="UTF-8" id="login-nav">
            <div>
                <input type="text" name="login" class="sidebar-input-text" placeholder="Login" required>
            </div>
            <div>
                <input type="password" name="pass" class="sidebar-input-text" placeholder="Password" required>
                <div><a href="">Zapomniałeś hasła?</a></div>
            </div>
            <div class="col-md-12">
                <button class="sidebar-input-submit" type="submit">Zaloguj</button>
            </div>
        </form>
    </div>
    ';
      }
        
?>
</div>
          
          
  </div>
</body>
</html>
