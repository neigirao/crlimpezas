<?php
// ACTIVE RECORDS CONFIGURATION
class UserDao extends ADOdb_Active_Record{
	
	private $conexao;
	
	function __construct() {
		
		# SINGLETON DA BD
		$this->conexao = Conexao::getConexao();
		
		# NOME DA TABELA QUE REPRESENTADA A CLASSE NA BD 
		parent::__construct('admin_usuarios');
	}
	
	public function getConexao(){
		return $this->conexao;
	}
	
	public function saveDao(){
		return $this->Save();
	}
	
    public function loadId() {
        return $this->Load('id_usuarios = ?',$this->id_usuarios);
    }

    public function loadUser() {
        return $this->Load('usuario = ?',$this->usuario);
    }
    
    public function findByUser() {
    	return $this->Find('usuario LIKE ? limit 1 ', $this->usuario);
    }
    
}
?>