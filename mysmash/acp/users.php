<?php
    session_start();

    error_reporting(0);

    if ((isset($_SESSION['zalogowany'])))
    {
        include '../page/i2.php';
    }
    if((!isset($_SESSION['admin'])))
    {
      header('Location: ../index.php');
    }

?>
<?php include 'configs/information.php' ?>
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
  <?php include 'configs/style.php';?>
</head>
<body>

  <?php include 'page/menu.php';?>
  <a href="index.php">wróć</a>
  <?php
      if(isset($_SESSION['blad']))    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['blad'].'</div>';
  ?>
  <div class="container">

    <div class="row">
      <?php
        $db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
        $sql = "SELECT * FROM posty";
        $result = $db->query($sql);

        foreach($db->query('SELECT * FROM `uzytkownicy` ORDER BY `id`') as $row) {
          echo'
            <div class="col-md-8" style="position:relative;">
              <blockquote class="quote-box">
                <p class="quote-text">'.$row['nick'].'</p>
                <hr>
                <div class="blog-post-actions">
                  <p class="blog-post-bottom pull-left">'.$row['email'].'</p>
                  <p class="blog-post-bottom pull-right">'.$row['id'].'</p>
                  <p class="blog-post-bottom pull-right">
                    <form method="post" action="delete.php" class="blog-post-bottom pull-right">
                      <input type="hidden" name="id" value="'.$row['id'].'">
                      <input  type="submit" class="btn icon-btn btn-danger" value="Eldo" >
                    </form> 
                  </p>
                </div>
              </blockquote>
            </div>';
        }
      ?>
    </div>
  </div>
</body>
</html>
