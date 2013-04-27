<?php
// ACTIVE RECORDS CONFIGURATION
class PaymentDao extends ADOdb_Active_Record{
	
	private $conexao;
	
	function __construct() {
		
		# SINGLETON DA BD
		$this->conexao = Conexao::getConexao();
		
		# NOME DA TABELA QUE REPRESENTADA A CLASSE NA BD 
		parent::__construct('admin_pagamentos');
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

    public function findAll() {
    	return $this->Find('pedidos_id IN (SELECT MAX(pedidos_id) FROM admin_pedidos_status WHERE status LIKE ? GROUP BY pedidos_id)','PAGO');
    }
    
}
# RELACIONAMENTO 1 -> 1 (Payment -> Ordered)
ADODB_Active_Record::ClassBelongsTo('PaymentDao','site_pedidos','pedidos_id','id');
?>