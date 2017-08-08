<?php
  $db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
  $sql = 'SELECT * FROM `posty`';
  $q = $db->prepare($sql);
  $q-> execute();


  $result = $q->fetchAll(PDO::FETCH_OBJ);
  $myJSON = json_encode($result);


  echo $myJSON;
?>