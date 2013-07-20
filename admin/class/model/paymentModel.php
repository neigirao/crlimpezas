<?php
require(CLASS_DIR . 'exception/ADOException.php');
require(CLASS_DIR . 'service/paymentService.php');
require(CLASS_DIR . 'dao/conexao.php');
require(CLASS_DIR . 'dao/paymentDao.php');
require(CLASS_DIR . 'dao/orderedDao.php');
require(CLASS_DIR . 'dao/orderedStatusDao.php');
require(CLASS_DIR . 'model/util.php');
require(CLASS_DIR . 'model/logModel.php');
require(SMARTY_DIR  . 'Smarty.class.php');

// SMARTY CONFIGURATION 
class PaymentModel extends Smarty { 
	function __construct() {
		parent::__construct();
	}

	function findOrderedInServiceToForm(){
		$orderedStatusDao =& new orderedStatusDao;
		$list = $orderedStatusDao->findInService();
		$array = array();
		$array[0] = 'Selecione ...';
		foreach ($list as $obj) {
			$array[$obj->pedidos_id] = sprintf('%1$04d', $obj->pedidos_id) . ' - ' . $obj->site_pedidos->admin_clientes->nome;
		}
		return $array;
	}
}

$payment =& new PaymentService;
?>