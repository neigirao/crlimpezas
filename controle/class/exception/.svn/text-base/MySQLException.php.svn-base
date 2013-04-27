<?php
 class MySQLException extends Exception {
 	
 	private $erroNumero; 
 	private $erroMensagem;
 	
 	public function __construct($numero, $msg) {
 		$this->erroNumero = $numero;
 		$this->erroMensagem = $msg;
 		$this->gerarLog();
 		header('Location: ./?db&m='.$this->getMensagemErro());
 	}
 	
 	public function getMensagemErro(){
 		switch ($this->erroNumero){
 			case 1044:
 				$this->erroMensagem = 'Erro com o usuсrio na autъnticaчуo';
 				break;
 			case 1045:
 				$this->erroMensagem = 'Erro com a senha na autъnticaчуo';
 				break;
 			case 1049:
 				$this->erroMensagem = 'Base de Dados nуo foi encontrada';
 				break;
 			case 2005:
 				$this->erroMensagem = 'Problema ao conectar no Banco de Dados';
 				break;
 		}
 		return base64_encode($this->erroMensagem);
 	}
 	
    /**
     * Mщtodo grava num log o erro gerado
     */
    private function gerarLog() {

    	$txt = 'log/log_conexao_' . date('dmY') . '.txt';
         
      	$msg = '';
      	 
        if( $file = fopen( $txt , 'a+' ) ) {
       
           $msg .=  'hora: '.date('H:i') . ' ' .
                    "Erro [ {$this->erroNumero} ] " .
                    "{$this->erroMensagem} " .
                    '------------------------------------------------------------------- ';
           
           fwrite( $file , $msg.chr(13).chr(10) );
           fclose( $file );
        }
     }
 	
 }
?>