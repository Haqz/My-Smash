<?php
	
	session_start();
	
	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$nick = $_POST['nick'];
		
		//Sprawdzenie długości nicka
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_ARGON2I);
		
		//Czy zaakceptowano regulamin?
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
		}				

		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		require_once "../configs/connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE nick='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
				}
				
				if ($wszystko_OK==true)
				{
					$f1 = $nick;
					$f2 = $haslo_hash;
					$f3 = $email;
					if ($f1 == true){
						$stmt = $db->prepare("INSERT INTO users(nick,pass,email) VALUES(:f1,:f2,:f3)");
						$stmt->execute(array(':f1' => $f1, ':f2' => $f2, ':f3' => $f3));
						$affected_rows = $stmt->rowCount();
						$_SESSION['udanarejestracja']=true;
						header('Location: ../index.php');
					}
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
	
?>

<?php include '../configs/information.php' ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo "$pagename" ?></title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<?php include '../configs/style.php' ?>
	<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
	<?php include '../page/menu.php'; ?>

	<div class="container">
		<div class="jumbotron">
			<h1>Pamiętaj!</h1>
			<p>Zakładając konto akceptujesz wszelgie regulaminy! :) Lepiej Przeczytaj :P</p>
		</div>
	</div>

	<form method="post" class="form-horizontal">
		<div class="row">
			<div class="col-xs-6 col-md-4"></div>
		  	<div class="col-xs-6 col-md-4 form-group">
			    <label for="inputEmail3" class="col-xs-6 col-md-4 control-label">Login</label>
			    <div class="col-xs-6 col-md-4">
					<input type="text"  class="form-control" id="inputEmail3" placeholder="Login" value="<?php
						if (isset($_SESSION['fr_nick']))
						{
							echo $_SESSION['fr_nick'];
							unset($_SESSION['fr_nick']);
						}
						?>" name="nick" />
			    </div>
		  	</div>
			<div class="col-xs-6 col-md-4"></div>
		</div>

		<div class="row">
			<div class="col-xs-6 col-md-4"></div>
		  	<div class="col-xs-6 col-md-4 form-group">
			    <label for="inputEmail3" class="col-xs-6 col-md-4 control-label">E-Mail</label>
			    <div class="col-xs-6 col-md-4">
					<input type="emailq" placeholder="Email" class="form-control"  value="<?php
						if (isset($_SESSION['fr_email']))
						{
							echo $_SESSION['fr_email'];
							unset($_SESSION['fr_email']);
						}
						?>" name="email" />
			    </div>
		  	</div>
			<div class="col-xs-6 col-md-4"></div>
		</div>

		<div class="row">
			<div class="col-xs-6 col-md-4"></div>
		  	<div class="col-xs-6 col-md-4 form-group">
			    <label for="inputEmail3" class="col-xs-6 col-md-4 control-label">Hasło</label>
			    <div class="col-xs-9 col-md-4">
					<input type="password" class="form-control" placeholder="Hasło" value="<?php
						if (isset($_SESSION['fr_haslo1']))
						{
							echo $_SESSION['fr_haslo1'];
							unset($_SESSION['fr_haslo1']);
						}
						?>" name="haslo1" />
			    </div>
		  	</div>
			<div class="col-xs-6 col-md-4"></div>
		</div>

		<div class="row">
			<div class="col-xs-6 col-md-4"></div>
			<div class="col-xs-6 col-md-4 form-group">
				<label for="inputEmail3" class="col-xs-6 col-md-4 control-label">Powtórz Hasło</label>
				<div class="col-xs-6 col-md-4">
					<input type="password" class="form-control" placeholder="Powtórz Hasło" value="<?php
						if (isset($_SESSION['fr_haslo2']))
						{
							echo $_SESSION['fr_haslo2'];
							unset($_SESSION['fr_haslo2']);
						}
					?>" name="haslo2" />
				</div>
			</div>
			<div class="col-xs-6 col-md-4"></div>
		</div>

		<div class="row">
			<div class="col-xs-6 col-md-4"></div>
			<div class="col-xs-6 col-md-4 form-group">
				<label for="inputEmail3" class="col-xs-6 col-md-4 control-label">Avatar</label>
				<div class="col-xs-6 col-md-4">
					<input type="file" name="fileToUpload" id="fileToUpload">
				</div>
			</div>
			<div class="col-xs-6 col-md-4"></div>
		</div>


			<div class="col-xs-6 col-md-4"></div>
		  	<div class="form-group">
			    <div class="col-xs-6 col-md-4">
			      	<div class="checkbox">
			        	<label>
							<input type="checkbox" name="regulamin" <?php
							if (isset($_SESSION['fr_regulamin']))
							{
								echo "checked";
								unset($_SESSION['fr_regulamin']);
							}
									?>/> Akceptuje regulamin.
			        	</label>
			      </div>

			    </div>
		  	</div>

		<div class="col-xs-6 col-md-4"></div>
		  	<div class="form-group">
			    <div class="col-xs-2 col-md-4">
			      	<button type="submit" class="btn btn-default">Zarejestruj</button>
			    </div>
		  	</div>
		<div class="col-xs-6 col-md-4"></div>
		<div class="col-xs-2 col-md-4"></div>
		<div class="col-xs-2 col-md-4"></div>
	</form>
	<form method="post">
		<?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			} elseif (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			} elseif (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			} elseif (isset($_SESSION['e_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			}
		?>
	<br />
	</form>

</body>
</html>