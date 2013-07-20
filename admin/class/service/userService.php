<?php
/**
 * @author Thiago Pio
 */
class UserService {

    public $sql = null; # DATABASE 
    public $tpl = null; # SMART TEMPLATE  
    public $service = null; 
    private $folder = '';

    function __construct() {
        $this->sql =& new UserDao;
        $this->tpl =& new UserModel;
        $this->service = $this;
	    $this->util =& new util;
    }

    function validatePassword($pwd = '') {
        return (crypt($pwd,$this->sql->senha) == $this->sql->senha ? true : false);
    }

    function securityCharacters(){
        $this->sql->usuario = htmlspecialchars($this->sql->usuario, ENT_QUOTES);
        $this->sql->senha = htmlspecialchars($this->sql->senha, ENT_QUOTES);
    }

    function addAccess(){
        $this->sql->data_acesso = date('Y-m-d H:i:s');
        $this->sql->save();
    }
    
    function verifyLogin() {
        $this->securityCharacters();
        $passwordForm = $this->sql->senha;
        if($this->sql->loadUser()){
            if($this->validatePassword($passwordForm)){
                return 'AUTHENTICATED';
            }else{
                return 'PASSWORD_INVALID';
            }
        }
        return 'NOT_FOUND';
    }

    function showPage() {
        $this->tpl->display('index.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showChangePassword($dados = array()) {
        $this->tpl->display('user/change_pwd.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showHelp() {
        $this->tpl->display('help.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showNavigatorMessage() {
        $this->tpl->display('error/navigator.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showAccessDeniedMessage() {
        $this->tpl->display('error/access.html'); 
        $this->util->clearCookies();
        exit();
    }

    function showDeniedMessage() {
        $this->tpl->display('error/denied.html'); 
        $this->util->clearCookies();
        exit();
    }

    function redirect() {
        header('Location: index.php');
        exit();
    }

    function createSession() {
        $_SESSION['logged'] = true;
        $_SESSION['id_usuario'] = $this->sql->id_acesso;
        $_SESSION['usuario'] = $this->sql->usuario;
        $_SESSION['nome'] = $this->sql->nome;
        session_cache_limiter ('private, must-revalidate'); 
        session_cache_expire(30);
    }
    
    function validateForm() {
        if(strlen($this->sql->usuario) == 0) {
            return 'Usu&aacute;rio n&atilde;o pode ser vazio.';
        }
        if(empty($this->sql->senha)) {
            return 'Senha n&atilde;o pode ser vazia.';
        }
        return true;
    }
    
    function validateChangeForm($pwdAtual, $pwdNova1, $pwdNova2) {
        if(empty($pwdAtual)) {
            $_SESSION['alert'] = $this->util->getValidateMsg('Senha', 'TEXT');
            return false;
        }
        if(empty($pwdNova1)) {
            $_SESSION['alert'] = $this->util->getValidateMsg('Nova Senha', 'TEXT');
            return false;
        }
        if(empty($pwdNova2)) {
            $_SESSION['alert'] = $this->util->getValidateMsg('Repetir Nova Senha', 'TEXT');
            return false;
        }
        return true;
    }
}

?>