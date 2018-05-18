<?php
/*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			Include section
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/
	require '../../libs/Slim/Slim.php';
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	require '../../vendor/autoload.php';
/*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			Slim actions section
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\App();

/*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			Login section
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/
	$app->get('/posts[/{arg}]', function(Request $request, Response $response, $args) {
	    $app = \Slim\Slim::getInstance();
	    $arg = $request->getAttribute('arg');
	    try{
	    	if ($arg == true) {
	    		$db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
  				$sql = "SELECT $arg FROM `posty`";
  				$q = $db->prepare($sql);
  				$q-> execute();

  				$result = $q->fetchAll(PDO::FETCH_OBJ);
	    	}else{
	    		$db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
  				$sql = 'SELECT * FROM `posty`';
  				$q = $db->prepare($sql);
  				$q-> execute();

  				$result = $q->fetchAll(PDO::FETCH_OBJ);
			}
	    }
	    	
		catch(Exception $ex){
			echo $ex;
		}
	    $db = null;
  		$myJSON = json_encode($result);
		echo $myJSON;
	});
	$app->post('/hello', function (Request $request, Response $response) {
	    $data = $request->getParsedBody();
	    $ticket_data = [];
	    $p_data['token'] = filter_var($data['token'], FILTER_SANITIZE_STRING);
	    $p_data['content'] = filter_var($data['content'], FILTER_SANITIZE_STRING);
	    try{
	    	$db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
		    $sth = $db->prepare('SELECT name as count FROM uzytkownicy WHERE token=:token');
			$sth->bindParam(':token', $p_data['token'], PDO::PARAM_INT);
	        $sth->execute();
	        $row = $sth->fetch();
	        if($row['count'] = 1){
				$db1 = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
				$sths = $db1->prepare('SELECT * FROM uzytkownicy WHERE token=:token');
				$sths->bindParam(':token', $p_data['token'], PDO::PARAM_INT);
				$sths->execute();
				$row = $sths->fetch();
				$user_id = $row['id'];
				$name = $row['nick'];
				$sth = $db->prepare('INSERT INTO posty (content, creator, user_id) VALUES(:content, :name, :user_id)');
		    	$sth->bindParam(':content', $p_data['content'], PDO::PARAM_INT);
		    	$sth->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		    	$sth->bindParam(':name', $name, PDO::PARAM_INT);
				$sth->execute();
				$output = array(
					'state'=>"201",
					'process'=>"Success"
				);
				echo json_encode($output);
		    	$db = null;
				return;
	    	}else{
	    	echo "eerrr";
	    	}
		}
	    catch(Exception $ex){
				echo $ex;
			}
});

/*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			New Post section
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/
	$app->post('/new_post', function ($request, $response, $args) {

	    $app = \Slim\Slim::getInstance();
		$app->response->setStatus(200);
	    $app->response()->headers->set('Content-Type', 'application/json');
		$data = $request->getParsedBody();
    	$p_data = [];
    	$p_data['content'] = filter_var($data['content'], FILTER_SANITIZE_STRING);
    	$p_data['token'] = filter_var($data['token'], FILTER_SANITIZE_STRING);
	    try{
	        $db = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
	        $sth = $db->prepare('SELECT token as count FROM users WHERE token=:num');
			$sth->bindParam(':num', $p_data['token'], PDO::PARAM_INT);
	        $sth->execute();
	        $row = $sth->fetch();

		    if($row['count']>0){
				$output = array(
		            'state'=>"400",
		            'process'=>"Alerdy on site"
				);
				echo json_encode($output);
	            $db = null;
				return;
			}else if($row['count'] = 0){
				$db1 = new PDO('mysql:host=localhost;dbname=facesmash;charset=utf8mb4', 'root', '');
				$sths = $db1->prepare('SELECT * FROM uzytkownicy WHERE :token');
				$sth->bindParam(':token', $p_data['token'], PDO::PARAM_INT);
				$sths->execute();
				$row = $sths->fetch();
				$user_id = $row['id'];
				$name = $row['nick'];
				$sth = $db->prepare('INSERT INTO posts (content, creator, user_id) VALUES(:content, :name, :user_id)');
	            $sth->bindParam(':content', $p_data['content'], PDO::PARAM_INT);
	            $sth->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	            $sth->bindParam(':name', $name, PDO::PARAM_INT);
				$sth->execute();
				$output = array(
		            'state'=>"201",
		            'process'=>"Success"
				);
				echo json_encode($output);
	            $db = null;
				return;
				}else{
					$output = array(
			            'state'=>"404",
			            'process'=>"Pin not found"
					);
					echo json_encode($output);
				}
		}

		catch(Exception $ex){
			echo $ex;
		}
	});
/*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			function section
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/
	
	$app->run();
?>