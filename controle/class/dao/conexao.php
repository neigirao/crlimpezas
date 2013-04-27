<?php
/**
 * ADOdb_Active_Record is an Object Relation Mapping (ORM)
 */
include_once(ADODB_DIR . 'adodb.inc.php');
include_once(ADODB_DIR . 'adodb-active-record.inc.php');
include_once(CLASS_DIR . 'exception/MySQLException.php');

Class Conexao {
	
	# GUARDA INSTANCIA DA CLASSE
    static private $conexao;
    protected $db;
	
    # CONSTRUTOR
    private function __construct(){
        
        $this->db = NewADOConnection('mysqlt');  
        
		$this->db->debug = 0;

        $this->db->PConnect('localhost', 'root', '', 'crlimpezas');
        #$this->db->PConnect('localhost', 'busines1_cr', 'Admin321', 'busines1_cr');
        #$this->db->PConnect('mysql01.crlimpezas.hospedagemdesites.ws', 'crlimpezas', 'caio_pedido', 'crlimpezas');
		
        if($this->db->ErrorMsg() != ''){
			throw new MySQLException($this->db->ErrorNo(),$this->db->ErrorMsg());
		}
		
		ADOdb_Active_Record::SetDatabaseAdapter($this->db);  
    }
    
    public function isError(){
        return (self::$conexao->db->ErrorMsg() != ''? true : false);
    }
    
    static public function getLimit($page){
    	$lineByPage = 10;
        if(!empty($page) && $page > 0){
    		$pageStart = $page * $lineByPage - $lineByPage;
    		$page = 'limit '.$pageStart.','.$lineByPage;
    	}
    	return $page;
    }
    
    # SINGLETON 
    static public function getConexao(){
    	
        if (!isset(self::$conexao)) {
            $c = __CLASS__;
            self::$conexao = new $c;
        }
        
        return self::$conexao;
    }
    
    /**
     * INICIA UMA TRANSICAO (BEGIN)
     */
    static public function iniciarTransacao(){
    	self::$conexao->db->BeginTrans();
    }
    
    /**
     * FINALIZA UMA TRANSICAO (COMMIT) E POR PADRAO O
     * PARAMETO $concluir EH FALSE, ENTAO SOMENTE NO CASO DE
     * CONCLUSAO ENVIE O PARAMETRO COMO TRUE 
     * 
     * @param $commit = false
     */
    static public function terminarTransacao($commit=false){
    	self::$conexao->db->CommitTrans($commit);
    	return $commit;
    }
    
}
@session_start();
?>