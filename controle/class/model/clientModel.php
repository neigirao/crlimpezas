<?php
require(CLASS_DIR . 'exception/ADOException.php');
require(CLASS_DIR . 'service/clientService.php');
require(CLASS_DIR . 'dao/conexao.php');
require(CLASS_DIR . 'dao/clientDao.php');
require(CLASS_DIR . 'model/util.php');
require(CLASS_DIR . 'model/logModel.php');
require(SMARTY_DIR  . 'Smarty.class.php');

// SMARTY CONFIGURATION 
class ClientModel extends Smarty { 
	function __construct() {
		parent::__construct();
	}
}

$client =& new ClientService;
?>