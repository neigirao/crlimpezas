<?php
require(CLASS_DIR . 'exception/ADOException.php');
require(CLASS_DIR . 'service/orderedService.php');
require(CLASS_DIR . 'dao/conexao.php');
require(CLASS_DIR . 'dao/orderedDao.php');
require(CLASS_DIR . 'dao/orderedStatusDao.php');
require(CLASS_DIR . 'dao/clientDao.php');
require(CLASS_DIR . 'model/util.php');
require(CLASS_DIR . 'model/logModel.php');
require(SMARTY_DIR  . 'Smarty.class.php');

// SMARTY CONFIGURATION 
// STATUS = {NOVO, ASSOCIADO, AGUARDANDO, EM SERVICO, PAGO, CANCELADO}
class OrderedModel extends Smarty { 
	function __construct() {
		parent::__construct();
	}

	function originToForm(){
		$array = array();
		$array[''] = 'Selecione ...';
		$array['ONLINE'] = 'Internet';
		$array['TELEFONE'] = 'Telefone';
		$array['OUTROS'] = 'Outro';
		return $array;
	}

	function statusToForm(){
		$array = array();
		$array[''] = 'Selecione ...';
		$array['AGUARDANDO RESPOSTA'] = 'Aguardando Resposta';
		$array['EM SERVICO'] = 'Em Serviço';
		$array['CANCELADO'] = 'Cancelado';
		return $array;
	}

	function findAllClientsToForm(){
		$clientDao =& new ClientDao;
		$list = $clientDao->findAll();
		$array = array();
		$array[0] = 'Selecione ...';
		foreach ($list as $obj) {
			$array[$obj->id_clientes] = $obj->nome;
		}
		return $array;
	}
}

$ordered =& new OrderedService;
?>