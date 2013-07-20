<?php
/**
 * Declaraзгo da classe para tratamento de erros
 * A classe deve ser extendida da classe Exception do PHP
 */
 class ADOException extends Exception {
      //Faзo a declaraзгo das variбvis que vou utilizar no corpo da classe
      private $class = '';
      public $cod = 0;
      public $msg = '';
      public $erromsg = '';
    
      // Esse mйtodo recebe os seguintes parametros: 
      // $class - Representa a classe do erro
      // $cod - Cуdigo de erro
      // $msg - Uma mensagem de erro personalizada
      // $erromsg - Uma mensagem de erro padrгo
      public function __construct(&$class, $msg = "") {
          $this->class = get_class($class);
          $this->cod = $class->sql->ErrorNo();
          $this->erromsg = $class->sql->ErrorMsg();
          $this->msg = $msg;
          
          # TRATAMENTO PARA REGISTRO DUPLICADO / UNIQUE
          if($this->cod == 1062){
            $campos = $class->sql->GetAttributeNames();
            $posicaoCampo = trim(substr($this->erromsg, strrpos($this->erromsg, ' ')));
            $this->msg = 'Campo '.$campos[$posicaoCampo-1].' jб existe';
            $this->erromsg = str_replace($posicaoCampo, $campos[$posicaoCampo-1], $this->erromsg);

            $class->alert = utf8_encode($this->msg);
            $_SESSION['alert'] = $class->alert;
          }
          
          //Aqui eu chamo o construtor da classe pai para garantir o funcionamento correto da minha classe        
          parent::__construct( $this->erromsg , $this->cod );
          $this->WriteLog();
      }
      
      /**
       * Mйtodo grava num log o erro gerado
       */
      private function WriteLog() {
          if(!is_dir('logs')){
            mkdir('logs', 0777);
          }
      	  $path = 'logs/exception_' . date('Ymd') . '.txt';
      	  $msg = '';
          if( $file = fopen( $path , 'a+' ) ) {
       
            $msg .= date('H:i:s') . ' ' .
                    __CLASS__ . "[ {$this->cod} ]: linha ( {$this->line} ) " .
            		    " em # $this->file # " . 
                    "{$this->msg} " .
                    "({$this->erromsg})" .
                    '-------------------------------------------------------------------';
           
            fwrite( $file , $msg.chr(13).chr(10) );
            fclose( $file );
         }
      }
      
       /**
       * Metodo seta o erro na classe atual do smarty
       */
      public function setMesagemRetornoSmarty(&$objeto) {
        if(empty($objeto->alert)){
      		  $_SESSION['error'] = utf8_encode((empty($this->msg)?$this->erromsg:$this->msg));
        }
      }
      
 }
?>