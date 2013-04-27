<?php
// ACTIVE RECORDS CONFIGURATION
class ClientDao extends ADOdb_Active_Record{
	
	private $conexao;
	
	function __construct() {
		
		# SINGLETON DA BD
		$this->conexao = Conexao::getConexao();
		
		# NOME DA TABELA QUE REPRESENTADA A CLASSE NA BD 
		parent::__construct('admin_clientes');
	}
	
	public function getConexao(){
		return $this->conexao;
	}
	
	public function saveDao(){
		return $this->Save();
	}
	
    public function loadId() {
        return $this->Load('id_clientes = ?',$this->id_clientes);
    }
    
    public function findByName($name = '', $page = '') {
    	return $this->Find('nome LIKE ? limit 1 ', $this->nome);
    }

    public function findAll($page = '') {
    	$limit = $numberOfPage = Conexao::getLimit($page);
		return $this->Find('1=1 ORDER BY nome '.$limit);
    }
    
}
# RELACIONAMENTO 1 -> N (Client -> Ordered)
ADODB_Active_Record::ClassHasMany('ClientDao', 'site_pedidos','clientes_id');
?>