<?php
require(CLASS_DIR . 'exception/ADOException.php');
require(CLASS_DIR . 'service/userService.php');
require(CLASS_DIR . 'dao/conexao.php');
require(CLASS_DIR . 'dao/userDao.php');
require(CLASS_DIR . 'model/util.php');
require(CLASS_DIR . 'model/logModel.php');
require(SMARTY_DIR  . 'Smarty.class.php');

// SMARTY CONFIGURATION 
class UserModel extends Smarty { 
	function __construct() {
		parent::__construct();
	}
}

$user =& new userService;
?>