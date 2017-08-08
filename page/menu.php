

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



                if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
                {
                  //Jezeli uzytkownik jest zalogowany to widzi TO:

                      if ($_SESSION['admin']==true) {
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
                } else
               {
                 //Jezeli uzytkownik nie jest zalogowany to widzi TO:
                              echo '<li><a href="func/rejestracja.php"><span class="glyphicon glyphicon-user"></span> Rejestracja</a></li>

                              <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Logowanie<span class="caret"></span></a>
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
                                             <input type="password" name="haslo" class="form-control" id="exampleInputPassword2" placeholder="Hasło" required>

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
