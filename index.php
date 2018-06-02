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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo "$pagename"; ?></title>
  <?php include 'configs/style.php'; ?>
</head>
<body>
  
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">MySmash</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
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
                    </li>
                    <li class="dropdown show">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Login<span class="caret"></span></a>
                      <ul id="login-dp" class="dropdown-menu">
                        <li>
                          <div class="row">
                            <div class="col-md-12">
                              <form class="form" role="form" action="func/zaloguj.php" method="post" accept-charset="UTF-8" id="login-nav">
                                <div class="form-group">
                                  <label class="sr-only" for="exampleInputEmail2">Login</label>
                                  <input type="text" name="login" class="form-control" id="exampleInputEmail2" placeholder="Login" required>
                                </div>
                                <div class="form-group">
                                  <label class="sr-only" for="exampleInputPassword2">Hasło</label>
                                  <input type="password" name="pass" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                  <div class="help-block text-right"><a href="">Zapomniałeś hasła?</a></div>
                                </div>
                                <div class="col-md-12">
                                  <button style="float:right;margin-bottom:7%;margin-top:-3%;" type="submit" class="btn btn-success navbar-right">Zaloguj</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </li>' ;
            }
        ?>
      </ul>
    </div>
  </div>
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
     <div class="sidebar-menu-content">
      <span>Login now!</span>
        <ul>
          <li>
            <input type="text" name="nick" placeholder="Login">
          </li>
            <li>
            <input type="text" name="nick" placeholder="Login">
          </li>
        </ul>
     </div>
</div>

  </div>
</body>
</html>
