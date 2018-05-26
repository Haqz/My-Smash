<?php
    require_once "../configs/connect.php";
    function deletePost(){
        global $db;
        if ($_POST['deletePost']) {
            $id = $_POST['id'];

            $sql = "DELETE FROM posts WHERE id=?";
            $statement=$db->prepare($sql);
            $statement->bind_param("i",$id);
            if ($statement->execute()) {
                header('Location: posts.php');
            } else {
                echo "Error deleting record: " . $db->error;
            }
        } else{
            echo "ID is required";
        }
    }
    
    function deleteUser(){
        global $db;
        if ($_POST['deleteUser']) {
            if ($_POST['id'] != $_SESSION['id']) {
                echo "Are you really don't care about yourself?";
                return 0;
            }
            $id = $_POST['id'];

            $sql = "DELETE FROM users WHERE id=?";
            $statement=$db->prepare($sql);
            $statement->bind_param("i",$id);
            if ($statement->execute()) {
                header('Location: users.php');
            } else {
                echo "Error deleting record: " . $db->error;
            }
        } else{
            echo "ID is required";
        }
    }
    


?>
