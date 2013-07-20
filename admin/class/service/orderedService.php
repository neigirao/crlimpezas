<?php
/**
 * @author Thiago Pio
 */
class OrderedService {

    public $sql = null; # DATABASE 
    public $tpl = null; # SMART TEMPLATE  
    public $service = null; 
    private $folder = '';

    function __construct() {
        $this->sql =& new OrderedDao;
        $this->sql->status = new OrderedStatusDao;
        $this->tpl =& new OrderedModel;
        $this->service = $this;
	    $this->util =& new util;
    }

    function saveOrder() {
        # VALIDATE
        if(!$this->service->validateForm()){
            $this->service->showForm();
        }else{
            # IS UPDATE
            if($this->sql->id > 0){
                $clientes_id = $this->sql->clientes_id;
                $origem = $this->sql->origem;
                $this->sql->loadId();
                $this->sql->status->pedidos_id = $this->sql->id;
                $this->sql->status->findAllById();
                # SET STATUS
                if(empty($this->sql->clientes_id)){
                    $this->sql->status->status = 'ASSOCIADO';
                    $this->sql->status->data_atualizacao = date('Y-m-d H:i:s');
                    $this->sql->status->saveDao();
                    
                    $this->sql->clientes_id = $clientes_id;
                    $this->sql->origem = $origem;
                }
            }
            # SAVE
            if($this->sql->saveDao()){
                $_SESSION['success'] = $this->util->getMensagemRetorno('SALVO');
                Conexao::terminarTransacao(true);
            }else{
                throw new ADOException($this,$this->util->getMensagemRetorno('ERRO_BD'));
            }
        }
    }

    function saveStatus() {
        if($this->sql->status->pedidos_id > 0){
            $this->sql->id = $this->sql->status->pedidos_id;
            $this->sql->status->data_atualizacao = date('Y-m-d H:i:s');
        }else{
            $_SESSION['alert'] = $this->util->getMensagemRetorno('NAO_ENCONTRADO');
            $this->service->showList();
        }
        # SAVE
        if($this->sql->status->saveDao()){
            $_SESSION['success'] = $this->util->getMensagemRetorno('SALVO');
            Conexao::terminarTransacao(true);
        }else{
            throw new ADOException($this,$this->util->getMensagemRetorno('ERRO_BD'));
        }
    }

    function showForm() {
        if($this->sql->id > 0){
            $this->sql->loadId();
        }
        $this->tpl->assign('originList', $this->tpl->originToForm());
        $this->tpl->assign('clientsList', $this->tpl->findAllClientsToForm());
        $this->tpl->assign('post', $this->sql);
        $this->tpl->display('ordered/ordered_form_association.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showView() {
        if($this->sql->id > 0){
            $this->sql->loadId();
            $this->sql->status->pedidos_id = $this->sql->id;
            $this->sql->status->loadLastStatusById();
            $this->tpl->assign('statusList', $this->tpl->statusToForm());
            $this->tpl->assign('post', $this->sql);
            $this->tpl->display('ordered/ordered_view.html'); 
            $this->util->clearCookies();
            exit();
        }else{
            $_SESSION['alert'] = 'Pedido não encontrado.';
            $this->service->showList();
        }
    }

    function showList($list) {
        //$list = $this->sql->findAttached();
        $this->tpl->assign('post', $list);
        $this->tpl->display('ordered/ordered_list.html'); 
        $this->util->clearCookies();
        exit();
    }

    function setSearch($post, $get){
        $fields_search = array('search_id','page');
        $request = array_merge($post,$get);
        foreach ($request as $campo => $valor){
            if(in_array($campo, $fields_search) && !empty($valor))
                $search[$campo] = $valor;
        }
        $search['page'] = (isset($search['page']) ? $search['page'] : 1);
        return (empty($search) ? array() : $search);
    }

    function validateForm() {
        if(empty($this->sql->clientes_id)) {
            $_SESSION['alert'] = $this->util->getValidateMsg('Cliente', 'SELECT');
            return false; 
        }
        if(empty($this->sql->origem)) {
            $_SESSION['alert'] = $this->util->getValidateMsg('Origem', 'SELECT');
            return false; 
        }
        return true;
    }

    function redirect($search = '') {
        $search = !empty($search) ? base64_decode($search) : '';
        header('Location: ordered.php' . '?' . $search);
        exit();
    }

}

?>