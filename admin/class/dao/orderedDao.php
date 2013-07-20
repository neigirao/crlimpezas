<?php
// ACTIVE RECORDS CONFIGURATION
class OrderedDao extends ADOdb_Active_Record{
	
	private $conexao;
	
	function __construct() {
		
		# SINGLETON DA BD
		$this->conexao = Conexao::getConexao();
		
		# NOME DA TABELA QUE REPRESENTADA A CLASSE NA BD 
		parent::__construct('site_pedidos');
	}
	
	public function getConexao(){
		return $this->conexao;
	}
	
	public function saveDao(){
		return $this->Save();
	}
	
    public function loadId() {
        return $this->Load('id = ?',$this->id);
    }

    public function findAttachedById($id) {
    	return $this->Find('clientes_id IS NOT NULL AND foi_negado = 0 AND id NOT IN (SELECT pedidos_id FROM admin_pedidos_status WHERE status LIKE ?) AND id = ? ORDER BY data_atualizacao DESC, id DESC',array('PAGO',$id));
    }

    public function findAttachedAll() {
    	return $this->Find('clientes_id IS NOT NULL AND foi_negado = 0 AND id NOT IN (SELECT pedidos_id FROM admin_pedidos_status WHERE status LIKE ?) ORDER BY data_atualizacao DESC, id DESC','PAGO');
    }

    public function findAttached($page = '') {
    	$limit = $numberOfPage = Conexao::getLimit($page);
    	return $this->Find('clientes_id IS NOT NULL AND foi_negado = 0 AND id NOT IN (SELECT pedidos_id FROM admin_pedidos_status WHERE status LIKE ?) ORDER BY data_atualizacao DESC, id DESC '.$limit,'PAGO');
    }

    public function findNoResponse() {
    	return $this->Find('clientes_id IS NULL AND foi_negado = 0 ORDER BY id DESC');
    }

    public function findToday() {
    	return $this->Find('data_envio >= ? ORDER BY id DESC', date('Y-m-d'));
    }
    
}
# RELACIONAMENTO 1 -> 1 (Ordered -> Client)
ADODB_Active_Record::ClassBelongsTo('OrderedDao','admin_clientes','clientes_id','id_clientes');
# RELACIONAMENTO 1 -> N (Ordered -> Payment)
ADODB_Active_Record::ClassHasMany('OrderedDao', 'admin_pagamentos','pedidos_id');
# RELACIONAMENTO 1 -> N (Ordered -> Status)
ADODB_Active_Record::ClassHasMany('OrderedDao', 'admin_pedidos_status','pedidos_id');
?>