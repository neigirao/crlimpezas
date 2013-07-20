<?php
/**
 * @author Thiago Pio
 */
class PaymentService {

    public $sql = null; # DATABASE 
    public $tpl = null; # SMART TEMPLATE  
    public $service = null; 
    private $folder = '';

    function __construct() {
        $this->sql->payment =& new PaymentDao;
        $this->sql->ordered =& new OrderedDao;
        $this->sql->status =& new OrderedStatusDao;
        $this->tpl =& new PaymentModel;
        $this->service = $this;
	    $this->util =& new util;
    }

    function save() {
        # VALIDATE
        if(!$this->service->validateForm()){
            $this->service->showForm();
        }else{
            $this->sql->payment->data_pagamento = date('Y-m-d H:i:s');
            # SAVE
            if($this->sql->payment->saveDao()){
                $this->sql->ordered->id = $this->sql->payment->pedidos_id;
                $this->sql->ordered->loadId();

                $this->sql->status->pedidos_id = $this->sql->ordered->id;
                $this->sql->status->status = 'PAGO';
                $this->sql->status->data_atualizacao = date('Y-m-d H:i:s');
                $this->sql->status->saveDao();
                
                if($this->sql->ordered->saveDao()){
                    $_SESSION['success'] = $this->util->getMensagemRetorno('SALVO');
                    Conexao::terminarTransacao(true);
                }else{
                    throw new ADOException($this,$this->util->getMensagemRetorno('ERRO_BD'));
                }
            }else{
                throw new ADOException($this,$this->util->getMensagemRetorno('ERRO_BD'));
            }
        }
    }

    function showForm() {
        $this->tpl->assign('orderedList',$this->tpl->findOrderedInServiceToForm());
        $this->tpl->display('payment/payment_form.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showList() {
        $list = $this->sql->payment->findAll();
        $this->tpl->assign('post', $list);
        $this->tpl->display('payment/payment_list.html'); 
        $this->util->clearCookies();
        exit();
    }

    function validateForm() {
        if(empty($this->sql->payment->pedidos_id)) {
            $_SESSION['alert'] = $this->util->getValidateMsg('Pedido', 'SELECT');
            return false; 
        }

        if(empty($this->sql->payment->valor)) {
            $_SESSION['alert'] = $this->util->getValidateMsg('Valor', 'TEXT');
            return false; 
        }
        return true;
    }

}

?>