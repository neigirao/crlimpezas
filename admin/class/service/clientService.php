<?php
/**
 * @author Thiago Pio
 */
class ClientService {

    public $sql = null; # DATABASE 
    public $tpl = null; # SMART TEMPLATE  
    public $service = null; 
    private $folder = '';

    function __construct() {
        $this->sql =& new ClientDao;
        $this->tpl =& new ClientModel;
        $this->service = $this;
	    $this->util =& new util;
    }

    function save() {
        # VALIDATE
        if(!$this->service->validateForm()){
            $this->service->showForm();
        }else{
            # IS UPDATE
            if($this->sql->id_clientes > 0){
                $this->sql->_saved = true;
            }else{
                $this->sql->data_cadastro = date('Y-m-d H:i:s');
            }
            # SAVE
            if($return = $this->sql->saveDao()){
                $_SESSION['success'] = $this->util->getMensagemRetorno('SALVO');
                Conexao::terminarTransacao(true);
            }else{
                throw new ADOException($this,$this->util->getMensagemRetorno('ERRO_BD'));
            }
        }
    }

    function showList($list) {
        $this->tpl->assign('post', $list);
        $this->tpl->display('client/client_list.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showForm() {
        if ($this->sql->id_clientes > 0){
            $this->sql->loadId();
        }
        $this->tpl->assign('post', $this->sql);
        $this->tpl->display('client/client_form.html'); 
        $this->util->clearCookies();
        exit();
    }

    function validateForm() {
        if(strlen($this->sql->nome) == 0) {
            $_SESSION['alert'] = $this->util->getValidateMsg('Nome', 'TEXT');
            return false; 
        }
        return true;
    }

    function redirect($search) {
        $search = !empty($search) ? base64_decode($search) : '';
        header('Location: client.php' . '?' . $search);
        exit();
    }

    function setSearch($post, $get){
        $fields_search = array('search_nome','page');
        $request = array_merge($post,$get);
        foreach ($request as $campo => $valor){
            if(in_array($campo, $fields_search) && !empty($valor))
                $search[$campo] = $valor;
        }
        $search['page'] = (isset($search['page']) ? $search['page'] : 1);
        return (empty($search) ? array() : $search);
    }
}

?>