<?php
    session_start();
    $nick = $_SESSION['nick'];
    error_reporting(0);
    set_time_limit(0);

    if ($_SESSION['admin']==false)
    {
        header('Location: ../index.php');
        exit();
}

?>
<?php include '../configs/information.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo "$pagename"; ?></title>
    <?php include '../configs/style.php';?>
</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Strona Głowna</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-footer">
                            <a href="#">Zobacz Skrzynkę</a>
                        </li>
                    </ul>
                </li>
                    <!-- KONIEC 1 START 2 -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Włącz <span class="label label-default"> Posty</span></a>
                        </li>
                        <li>
                            <a href="#">Włącz <span class="label label-primary"> Rejestrację</span></a>
                        </li>
                        <li>
                            <a href="#">Włącz <span class="label label-success"> Stronę</span></a>
                        </li>
                                                <li class="divider"></li>
                        <li>
                            <a href="#">Zatrzymaj <span class="label label-info"> Posty</span></a>
                        </li>
                        <li>
                            <a href="#">Zatrzymaj <span class="label label-warning"> Rejestrację</span></a>
                        </li>
                        <li>
                            <a href="#">Zatrzymaj <span class="label label-danger"> Stronę</span></a>
                        </li>
                    </ul>
                </li>
                    <!-- KONIEC 2 START 3 -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php $_SESSION['login']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Maile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Ustawienia</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off" ></i> Wyloguj</a>
                        </li>
                    </ul>
                </li>
            </ul>
                <!-- KONIEC 3 -->
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> Jesteś zalogowany jako: <strong><?php echo $nick;?></strong>. Masz nowych wiadomości :<strong> 0 </strong> zobacz je <a href="acp/messeage.php" class="alert-link">Tutaj</a>
                        </div>
                    </div>
                </div>
                        <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                                $db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
                                                $result2 = mysqli_query('SELECT COUNT(id) FROM posty');
                                                foreach($db->query('SELECT COUNT(id) as c FROM posty') as $row){
                                                    echo $row['c']."<br>";}
                                            ?>
                                        </div>
                                        <div>Nowe Posty</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Zobacz Posty</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                                $db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
                                                $result = mysqli_query('SELECT COUNT(id) FROM uzytkownicy');
                                                foreach($db->query('SELECT COUNT(id) as c FROM uzytkownicy') as $row){
                                                    echo $row['c'];
                                                }
                                            ?>    
                                        </div>
                                        <div>Nowi Uzytkownicy</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Zobacz Listę</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>Posty do Ackeptacji!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Zobacz Listę</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">13</div>
                                        <div>Zgłoszeni Uzytkownicy</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Zobacz Listę</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                        <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>
    </div>
</body>

</html>
