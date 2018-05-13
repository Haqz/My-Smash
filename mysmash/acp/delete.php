<?php
    require_once "../configs/connect.php";
    if ($_POST['id'] != NULL && $_POST['id'] != $_SESSION['id']) {
      $id = $_POST['id'];

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    $sql = "DELETE FROM uzytkownicy WHERE id=?";
$statement=$conn->prepare($sql);
$statement->bind_param("i",$id);
    if ($statement->execute()) {
      header('Location: users.php');
    } else {
    echo "Error deleting record: " . $conn->error;
}
    }


?>
