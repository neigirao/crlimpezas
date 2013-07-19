<?php
DEFINE('LOCAL_DEBUG', false);
$email = 'comercial@crlimpezas.com.br';
#$emailcopia = 'thiago@businesstarget.com.br;nei@businesstarget.com.br;caiorios4@hotmail.com';
$emailoculto = 'caiorios4@hotmail.com,neigirao@gmail.com';

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PATH_SEPARATOR == ";") $quebra_linha = "\n"; //Se for Windows
else $quebra_linha = "\r\n"; //Se "não for Windows"

if (!empty($_POST['nome']) && !empty($_POST['email'])) {

  // Passando os dados obtidos pelo formulário para as variáveis abaixo
  $nome = ($_POST['nome']);
  $emailvisitante = $_POST['email'];
  $assunto = '[online] Contato ';
  $telefone = $_POST['telefone'];
  $servicos = implode(';', $_POST['servicos']);
  $comentarios = ($_POST['msg']);
  $ga = ($_POST['ga']);
  $formulario = implode('; ', $_POST);
  $data = date('Y-m-d H:i:s');

  // Save mesage BD
  if(!LOCAL_DEBUG){
    $sql = "INSERT INTO site_pedidos (nome_cliente,email_cliente,servicos_cliente,telefone_cliente,formulario,analytics,data_envio) VALUES ('$nome','$emailvisitante','$servicos','$telefone','$comentarios','$ga','$data')";
    #$con = mysql_connect("mysql01.crlimpezas.hospedagemdesites.ws","crlimpezas","caio_pedido");
    $con = mysql_connect("localhost","busines1_crnovo","aBJ=JIhpSzwa");
    $database = 'busines1_cr_limpezas';
  }else{
    $sql = "INSERT INTO site_pedidos (nome_cliente,email_cliente,servicos_cliente,telefone_cliente,formulario,analytics,data_envio)";
    $sql .=  " VALUES ('$nome','$emailvisitante','$servicos','$telefone','$comentarios','$ga','$data')";
    $con = mysql_connect("localhost","root","");
    $database = 'crlimpezas';
  }
  if (!$con){
    header('HTTP/1.1 500 Internal Server Error');
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($database, $con);
  if (!mysql_query($sql,$con)){
    header('HTTP/1.1 500 Internal Server Error');
    die('Error: ' . mysql_error());
  }else{
    $pedido = sprintf('(%1$04d)', mysql_insert_id());
    //$assunto .= sprintf('(%1$04d)', mysql_insert_id());
    if(strtoupper($nome) == 'TESTE'){
      $assunto = '[TESTE] Contato ' . $pedido;
    }else{
      $assunto .= $pedido;
    }
  }
  mysql_close($con);

  /* Montando a mensagem a ser enviada no corpo do e-mail. */
  $mensagemHTML = 'Nome: ' . $nome . '<br /> E-mail: '.$emailvisitante.'<br />
  Assunto: ' . $assunto . '<br />
  Telefone: ' . $telefone . '<br />
  Servicos: ' . $servicos . '<br />
  Mensagem: <br />' . $comentarios . '<br /><br /><br />
  Fonte: ' . $ga . '<br />';
  $mensagemHTML = nl2br(utf8_decode($mensagemHTML));

  $headers = "MIME-Version: 1.1" .$quebra_linha;
  $headers .= "Content-type: text/html; charset=UTF-8" .$quebra_linha;
  $headers .= "From: " . $emailvisitante . $quebra_linha;
  #$headers .= "Cc: " . $emailcopia . $quebra_linha;
  $headers .= "Bcc: " . $emailoculto . $quebra_linha;
  $headers .= "Reply-To: " . $emailvisitante . $quebra_linha;
  // Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

  if(!LOCAL_DEBUG){
    if(!mail($email, $assunto, $mensagemHTML, $headers ,"-r".$email)){ // Se for Postfix
        $headers .= "Return-Path: " . $email . $quebra_linha; // Se "não for Postfix"
        mail($email, $assunto, $mensagemHTML, $headers );
        header('HTTP/1.1 500 Internal Server Error');
        exit();
    }else{
    	/* Mostrando na tela as informações enviadas por e-mail */
    	header('HTTP/1.1 200 OK');

    	#print '<h1>Mensagem enviada com sucesso!!</h1><br>
    	#Mensagem enviada de: '. $emailvisitante.'<br>
    	#Mensagem enviada para: '.  $email.'<br>
      #Conteudo do e-mail enviado: <br>'.$mensagemHTML.' <br><br><br>
    	#Fonte: '.$ga.' <br>';
    }
  }
  print '{"pedido": "'.$pedido.'", "servicos": "'.$servicos.'", "email": "'.$emailvisitante.'"}';
  #print '>> ' . header('Access-Control-Allow-Origin: *');
} else {
  header('HTTP/1.1 500 Internal Server Error');
  exit();
}

?>