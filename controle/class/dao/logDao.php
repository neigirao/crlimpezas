<?php
// ACTIVE RECORDS CONFIGURATION
class LogDao extends ADOdb_Active_Record{
	
	private $conexao;
	
	function __construct() {
		
		# SINGLETON DA BD
		$this->conexao = Conexao::getConexao();
		
		# NOME DA TABELA QUE REPRESENTADA A CLASSE NA BD 
		parent::__construct('logger');
	}
	
	/**
	 * OBTÉM A CONEXÃO EM USO
	 * 
	 * @return ADOdb_Active_Record
	 */
	public function getConexao(){
		return $this->conexao;
	}
	
//	function exception($menu, &$e){
//		$this->menu = $menu;
//		$this->acao = 'EXCECAO';
//		$this->descricao = $e->getFile().' '.($e->getLine()).' : '.$e->getMessage();
//		$this->autor = $_SESSION['usuario'];
//		$this->Save();
//		
//		return ('<li>'.$this->descricao);
//	}
	
	function update($menu, $detalhe, $id){
		$this->menu = $menu;
		$this->acao = 'ATUALIZADO';
		$this->descricao = $detalhe;
		$this->origem_id = $id;
		$this->autor = $_SESSION['usuario'];
		$this->Save();
	}
	
	function add($menu, $detalhe, $id){
		$this->menu = $menu;
		$this->acao = 'ADICIONADO';
		$this->descricao = $detalhe;
		$this->origem_id = $id;
		$this->autor = $_SESSION['usuario'];
		$this->Save();
	}
	
	function remove($menu, $detalhe, $id){
		$this->menu = $menu;
		$this->acao = 'REMOVIDO';
		$this->descricao = $detalhe;
		$this->origem_id = $id;
		$this->autor = $_SESSION['usuario'];
		$this->Save();
	}
	
//	function errorSql($menu, $comando, &$obj){
//		$this->menu = $menu;
//		$this->acao = 'SQL:'.$comando;
//		$this->descricao = $obj->ErrorNo().':'.$obj->ErrorMsg();
//		$this->autor = $_SESSION['usuario'];
//		$this->Save();
//
//		if(substr_count($this->descricao,'1062')){
//			return 'Duplicidade';
//		}else{
//			return $this->descricao;
//		}
//	}
	
	function down($menu, $detalhe, $id){
		$this->menu = $menu;
		$this->acao = 'DOWNLOAD';
		$this->descricao = $detalhe;
		$this->origem_id = $id;
		$this->autor = $_SESSION['usuario'];
		$this->Save();
		return $detalhe;
	}

	function other($menu, $action, $detalhe, $id){
		$this->menu = $menu;
		$this->acao = $action;
		$this->descricao = $detalhe;
		$this->origem_id = $id;
		$this->autor = $_SESSION['usuario'];
		$this->Save();
		return $detalhe;
	}
}
	
$log =& new LogDao;
?>