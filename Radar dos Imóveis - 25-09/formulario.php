<html>
<head>       
   <!--IMPORTAÇÕES NECESSÁRIAS-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>         
</head>
<body>
<div id="dialog" title="Seu E-mail foi Enviado com Sucesso!!">
    <p>Ficamos felizes com seu contato! <br> Nossos Corretores Imobiliários já estão rastreando 
      potenciais compradores do seu imóvel.<br> No horário comercial, manteremos contato pessoal
      para detalhar informações.<br><br>Obrigado.<br><br><br>Radar dos Imóveis</p>
</div>
<meta http-equiv='refresh' content='0, url=./index.php'>
<!--<script>
$( "#dialog" ).dialog();
</script> -->
</body>
</html>
<?php
//if (isset($_POST['BTEnvia'])) {
  
  //Variaveis de POST, Alterar somente se necessário 
  //====================================================
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['fone']; 
  $obs1 = $_POST['obs1']; 
  $obs2 = $_POST['obs2']; 
  $obs3 = $_POST['obs3']; 
  $var = $_POST['var'];
  
  //====================================================
  
  //REMETENTE --&gt; ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
  //==================================================== 
  $email_remetente = "dalmo@radardosimoveis.com.br"; // deve ser uma conta de email do seu dominio 
  //====================================================
  
  //Configurações do email, ajustar conforme necessidade
  //==================================================== 
  $email_destinatario = "dalmo@radardosimoveis.com.br,$var"; // pode ser qualquer email que receberá as mensagens
  $email_reply = $email; 
  $email_assunto = "Quero Vender!!!"; // Este será o assunto da mensagem
  //====================================================
  
  //Monta o Corpo da Mensagem
  //====================================================
  $email_conteudo = "Nome = $nome \n"; 
  $email_conteudo .= "Email = $email \n";
  $email_conteudo .= "Telefone = $telefone \n"; 
  $email_conteudo .= "Configuração do imóvel = $obs1 \n"; 
  $email_conteudo .= "Localização do imóvel = $obs2 \n"; 
  $email_conteudo .= "Valores e condições = $obs3 \n"; 
  //====================================================
  
  //Seta os Headers (Alterar somente caso necessario) 
  //==================================================== 
  $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Subject: $email_assunto","Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
  //====================================================
  
  //Enviando o email 
  //==================================================== 
  if (@mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){ 
          //echo "<script> alert('E-Mail enviado com sucesso!');</script>"; 
         // echo "<script> alert('Ficamos felizes com seu contato! \nNossos Corretores Imobiliários já estão rastreando potenciais compradores do seu imóvel.\n No horário comercial, manteremos contato pessoal para detalhar informações.\n\nObrigado.\n\n\nRadar dos Imóveis');</script>";
           echo"<script>setTimeout($( '#dialog' ).dialog(), 3000); </script>";
sleep(10);
          //echo "<meta http-equiv='refresh' content='0, url=./index.php'>";
          } 
      else{ 
          echo "<script> alert('Falha no envio do E-Mail!');</script>" ; 
          echo "<meta http-equiv='refresh' content='0, url=./index.php'>";
        } 
  //====================================================
//} 
?>  
