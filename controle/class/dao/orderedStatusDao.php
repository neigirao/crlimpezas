<?php
// ACTIVE RECORDS CONFIGURATION
class OrderedStatusDao extends ADOdb_Active_Record{
	
	private $conexao;
	
	function __construct() {
		
		# SINGLETON DA BD
		$this->conexao = Conexao::getConexao();
		
		# NOME DA TABELA QUE REPRESENTADA A CLASSE NA BD 
		parent::__construct('admin_pedidos_status');
	}
	
	public function getConexao(){
		return $this->conexao;
	}
	
	public function saveDao(){
		return $this->Save();
	}

    public function returnLastStatusById($params = array(), &$smarty_obj){
        $orderedStatusDao = new OrderedStatusDao;
        $orderedStatusDao->Load('pedidos_id = ? ORDER BY id_pedidos_status DESC LIMIT 1',$params['id_pedido']);
        return (empty($orderedStatusDao->status) ? 'NOVO' : $orderedStatusDao->status);
    }

    public function loadLastStatusById(){
        return $this->Load('pedidos_id = ? ORDER BY id_pedidos_status DESC LIMIT 1',$this->pedidos_id);
    }

    public function findInService() {
    	return $this->Find('id_pedidos_status IN (SELECT MAX(id_pedidos_status) FROM admin_pedidos_status WHERE status LIKE ? GROUP BY pedidos_id)','EM SERVICO');
    }

    public function findAllById() {
    	return $this->Find('pedidos_id = ? ORDER BY id_pedidos_status DESC',$this->pedidos_id);
    }
    
}
# RELACIONAMENTO 1 -> 1 (OrderedStatus -> Ordered)
ADODB_Active_Record::ClassBelongsTo('OrderedStatusDao','site_pedidos','pedidos_id','id');
?>