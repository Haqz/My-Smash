<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['pass'])))
	{
		header('Location: ../index.php');
		exit();
	}

	require_once "../configs/connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['pass'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE nick='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_nickow = $rezultat->num_rows;
			if($ilu_nickow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (password_verify($haslo, $wiersz['pass']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['nick'] = $wiersz['nick'];
					$_SESSION['email'] = $wiersz['email'];
					$_SESSION['perm'] = $wiersz['perm'];
					
					unset($_SESSION['error']);
					$rezultat->free_result();
					header('Location: gra.php');
				}
				else 
				{
					$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: ../index.php');
				}
				
			} else {
				
				$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: ../index.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>