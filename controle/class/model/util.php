<?php
/**
 * @author Thiago Pio
 */
class util{
	
	/**
	 * Formatar data HTML (dd/mm/yyyy) para data BD (yyyy-mm-dd) 
	 */
	public function dateHTMLToBD($data = '', $hora = false){
		if(empty($data) && !$hora){
			$data = date('Y-m-d');
		}else if(!empty($data) && !$hora){
			$arrayDate = explode('/',$data);
			$data = $arrayDate[2].'-'.$arrayDate[1].'-'.$arrayDate[0];
		}else if(empty($data) && $hora){
			$data = date('Y-m-d H:i:s');
		}else{
			$array = explode(' ',$data);
			if(sizeof($array) == 1 && $hora){
				$array[] = '00:00';
			}
			$arrayDate = explode('/',$array[0]);
			$data = $arrayDate[2].'-'.$arrayDate[1].'-'.$arrayDate[0].' '.$array[1];
		}
		return $data;
	}

	public function getValidateMsg($field, $type){
		switch (strtoupper($type)) {
			case 'TEXT':
				return 'Campo ' . $field . ' n&atilde;o pode ser vazio';
			
			case 'SELECT':
				return $field . ' n&atilde;o foi selecionado';

			case 'OTHER':
				return $field;
			
			default:
				return 'Campo ' . $field . ' é obrigatorio';
		}
	}
	
	function dateDiff($params = array(), &$smarty_obj){
		$result = 'erro';		
		
		if(!empty($params)){
			$dateEvent = strtotime($params['params']);
			$dateNow = strtotime(date('m/d/Y'));
			$result = round(ceil($dateEvent - $dateNow)/86400);
		}
		
		if($result > 30)
			$result = "<span style='color:black'>[em $result dias]</span>";
		else if($result <= 30 && $result > 1)
			$result = "<span style='color:blue'>[em $result dias]</span>";
		else if($result == 1)
			$result = "<span style='color:red;'>[será amanhã]</span>";
		else if($result == 0)
			$result = "<span style='color:red;font-weight:bolder;'>[É HOJE!]</span>";
		else if($result < 0)
			$result = "<span style='color:gray'>[passou]</span>";
			
		return $result;
	}
	
	/**
	 * Injeta o formulário na classe ($modelo) por referência,
	 * para isso os campos do formulário (HTML) terão que ser IGUAIS as 
	 * colunas da tabela indicada no próprio construtor da classe do parametro.
	 * 
	 * @param &$modelo
	 * @param $formulario
	 * @param $retorno = false
	 */
	public function setFormulario(&$modelo, $post, $get = null, $debug = false){
		$formulario = array_merge($post,$get);
		if($debug)
			var_dump($modelo->getAttributeNames());
		foreach ($formulario as $campo => $valor){
			foreach ($modelo->getAttributeNames() as $atributo_tabela){
				if($campo == $atributo_tabela){
					if(is_array($valor)){
						if($debug)
							echo "<br />",$campo," = ",implode(';',$valor);
					}else{
						$valor = trim($valor);
						if($debug)
							echo "<br />",$campo," = ",$valor;
					}
					
					# VERIFICA SE TIPO EH DATA S/ HORA
					if(strlen($valor) == 10 && substr_count($valor,'/') == 2){
						$modelo->$campo = $this->dateHTMLToBD($valor, true);
					}else{
						$modelo->$campo = $valor;
					}
				}// if($campo == $atributo_tabela)
			}// foreach ($this->getAttributeNames() as $atributo_tabela)
		}// foreach ($formulario as $campo => $valor)
		
		# PARA DEBUGAR - ESPACAMENTO ENTRE TABELAS
		if($debug)
			echo '<br />';
	}
	
	/**
	 * Padroniza mensagens de retorno para o HTML
	 * 
	 * @param $palavra
	 * @param $opcional
	 */
	public function getMensagemRetorno($palavra, $opcional = ''){
		switch (strtoupper($palavra)){
			case 'SALVO':
				$palavra = 'Operacao concluida com sucesso.';
				break;
			case 'NAO_ENCONTRADO':
				$palavra = 'Informacao nao encontrada.';
				break;
			case 'ERRO_ID':
				$palavra = 'Informacao nao foi encontrada.';
				break;
			case 'ERRO_BD':
				$palavra = 'Erro ao concluir a operacao.';
				break;
			default:
				$palavra = 'Problema ao completar a operacao. Entre em contato com o administrador.';
				break;
		}
		return utf8_encode($palavra);
	}
	
	public function verificaNumeroErroParaRetornoFormulario($numeroException,&$class){
		Conexao::terminarTransacao();
		switch($numeroException){
			case 1062:
				$class->service->showForm($class->sql);
				break;
			default:
				return false;
				break;
		}
	}
	
	public function getStatus(){
		$array[1] = 'Ativado';
		$array[0] = 'Desativado';
		return $array;
	}
	
	public function getGender(){
		$array[''] = 'Selecione...';
		$array['M'] = 'Masculino';
		$array['F'] = 'Feminino';
		return $array;
	}
	
	
	public function decode($params = array(), &$smarty_obj){
		return (!empty($params['data']) ? base64_decode($params['data']) : '');
	}

	public function profile($params = array(), &$smarty_obj){
		if(isset($params['verify'])){
			if(!isset($_SESSION['logged']))
				return false;
			else
				return (strtoupper($params['verify']) == strtoupper($_SESSION['perfil']));
		}else{
			$user = $params['user'];
			if($user->is_adm){
				$profile = 'ADM';
			}else if($user->membro->graduacao < 0){
				$profile = 'SENSEI';
			}else{
				$profile = 'USUARIO';
			}
			return $profile;
		}
	}

	public function listToSelect($list, $fields){
		if(sizeof($fields) < 2)
			return false;
		
		$array[-1] = 'Selecione...';
		foreach ($list as $item) {
			$array[$item->$fields[0]] = $item->$fields[1];
		}
		return $array;
	}

	public function createSlug($string){
	   return preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	}
	
	public function numberOfPagination($sizeOfList){
		$morePage = ($sizeOfList % 10) ? 1 : 0;
		return (number_format($sizeOfList % 10, 0) + $morePage);
	}
	
	public function setVariaveis($array = array(), $post, $get){
		$variaveis = array();
		if(!empty($post)){
			foreach($post as $key => $value){
				if (in_array($key, $array, true)) {
					//echo '<br>p:', $key, ' = ', $value;
					$variaveis[$key] = $value;
				}
			}
		}
		if(!empty($get)){
			foreach($get as $key => $value){
				if (in_array($key, $array, true)) {
					//echo '<br>g:', $key, ' = ', $value;
					$variaveis[$key] = $value;
				}
			}
		}
		foreach($array as $key){
			if(!array_key_exists($key, $variaveis)){
				echo '<br>ainda nao criou o ',$key,' =(';
				$variaveis[$key] = '';
			}
		}
		
		return $variaveis;
	}
	
    function clearCookies() {
    	unset($_SESSION['success']);
    	unset($_SESSION['alert']);
    	unset($_SESSION['error']);
    	unset($_SESSION['info']);
    }
}
?>
