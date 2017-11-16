<?php
  session_start();
  require_once('login/functions.php');

  if(logado()){
    echo '<meta http-equiv="refresh" content="0;URL=http://profglauber.com.br/index.php">';
  }
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <title>Prof. Glauber - Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/login.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><img src="img/logoglauber.png" width="50"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#inst">Institucional</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#voce">Para você</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#empresa">Para empresa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#contato">Contato</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="bloco mx-auto d-block">
        <h1 class="text-center">Acesse</h1>
          <div id="retorno"><?php echo $_SESSION['msgEmail']; ?></div>
          <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" class="form-control" id="login" name="login">
          </div>
          <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-12 col-sm-6 text-left">
                <a href="esqueci-senha.php">Esqueceu sua senha?</a>
              </div>
              <div class="col-12 col-sm-6 text-right">
                <button id="btn-enviar" class="btn btn-warning">Entrar</button>
              </div>
            </div>
          </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>
      $('#btn-enviar').click(function(){
        var login = $('#login').val();
        var senha = $('#senha').val();
          $('#alert').remove();

          if(login != '' && senha != ''){
            $.ajax({
              url: "login/login.php",
              method: "POST",
              data: { login: login, senha: senha },
              dataType: "html",
              beforeSend : function(){
                $('#retorno').append('<img id="load" src="img/load.gif" width="100">');
              }
            }).done(function(html){
              $('#load').remove();
              if(html == "success"){
                location.href = "https://profglauber.com.br/perfil.php";
              }else{
                $('#retorno').append(html);
              }
            }).fail(function(){
              $('#retorno').append('<div class="alert alert-danger" role="alert">Usuário invalido</div>');
            });
          }else{
            $('#retorno').append('<div class="alert alert-danger" role="alert">Preencha todos os campos para entrar.</div>');
          }
      });
    </script>
  </body>
</html>