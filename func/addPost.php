<?php
$db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');

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
?>