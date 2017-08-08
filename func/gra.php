<?php

	session_start();

	$_SESSION['admin']=$_SESSION['perm'];

	if ($_SESSION['perm']>=1) {
		$_SESSION['admin']=true;
	}
	else
	{
		$_SESSION['admin']=false;
	}

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: ../index.php');
		exit();
	}
?>
