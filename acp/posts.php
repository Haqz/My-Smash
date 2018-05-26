<?php
    session_start();
    include '../configs/connect.php';

    if((!isset($_SESSION['admin'])))
    {
      header('Location: ../index.php');
    }

?>
<?php include '../configs/information.php' ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="stylesheet" type="text/css" href="../assests/css/mainstyle.css">
  <title><?php echo "$pagename"; ?></title>
  <?php include '../configs/style.php';?>
</head>
<body>

  <?php include '../page/menu.php';?>
  <a href="index.php">wróć</a>
  <?php
      if(isset($_SESSION['blad']))    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['blad'].'</div>';
  ?>
  <div class="container">

    <div class="row">
      <?php
        global $db;
        foreach($db->query('SELECT * FROM `posts` ORDER BY `id`') as $row) {
          echo'
            <div class="cardP">
          <div class="cardP-block">
            <h4 class="cardP-title">'.$row['creator'].'</h4>
            <p class="cardP-text"> >> '.$row['id'].'</br>
            <form method="post" class="blog-post-bottom pull-right">
                      <input type="hidden" name="id" value="'.$row['id'].'">
                      <input  type="submit" name="deletePost" class="btn icon-btn btn-danger" value="Eldo" >
                    </form></p>
          </div>
        </div>';
        }
      ?>
    </div>
  </div>
</body>
</html>
