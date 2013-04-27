<?php
require(CLASS_DIR . 'exception/ADOException.php');
require(CLASS_DIR . 'service/reportService.php');
require(CLASS_DIR . 'dao/conexao.php');
require(CLASS_DIR . 'dao/orderedDao.php');
require(CLASS_DIR . 'dao/orderedStatusDao.php');
require(CLASS_DIR . 'model/util.php');
require(CLASS_DIR . 'model/logModel.php');
require(SMARTY_DIR  . 'Smarty.class.php');

// SMARTY CONFIGURATION 
class ReportModel extends Smarty { 
	function __construct() {
		parent::__construct();
	}
}

$report =& new ReportService;
?>