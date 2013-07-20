<?php
/**
 * @author Thiago Pio
 */
class ReportService {

    public $sql = null; # DATABASE 
    public $tpl = null; # SMART TEMPLATE  
    public $service = null; 
    private $folder = '';

    function __construct() {
        $this->sql->ordered =& new OrderedDao;
        $this->sql->status =& new OrderedStatusDao;
        $this->tpl =& new ReportModel;
        $this->service = $this;
	    $this->util =& new util;
    }

    function redirectOrderForm($id) {
        header('Location: ordered.php?action=form&id='.$id);
        exit();
    }

    function removeOrder($id) {
        $this->sql->ordered->id = $id;
        $this->sql->ordered->loadId();
        if($this->sql->ordered->status == 'NOVO'){
            $this->sql->ordered->foi_negado = 1;
            $this->sql->ordered->status = 'REMOVIDO';
            $this->sql->ordered->data_atualizacao = date('Y-m-d H:i:s');
            if($this->sql->ordered->saveDao()){
                $_SESSION['success'] = $this->util->getMensagemRetorno('SALVO');
            }else{
                $_SESSION['error'] = 'Problema ao remover orçamento.';
            }
        }else{
            $_SESSION['alert'] = 'Orçamento não pode ser removido por causa do seu status.';
        }
        $this->service->showNoResponse();
    }

    function showToday() {
        $list = $this->sql->ordered->findToday();
        $this->tpl->assign('post', $list);
        $this->tpl->display('report/report_today.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showNoResponse() {
        $list = $this->sql->ordered->findNoResponse();
        $list = $this->sql->ordered->findNoResponse();
        $this->tpl->assign('post', $list);
        $this->tpl->display('report/report_noresponse.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showPaid() {
        $this->tpl->display('report/report_paid.html'); 
        $this->util->clearCookies();
        exit();
    }

}

?>