<?php
 include"conectar.php";
 ini_set('default_charset','UTF-8');
 ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
      <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- CSS da página --><link rel="stylesheet" href="css/pesquisarimovel.css">
    <!-- CSS do footer.php --><link rel="stylesheet" href="css/footer.css">
    <!-- CSS do navbar-top.php --><link rel="stylesheet" href="css/navbar-top.css">
    <title>Radar dos Imóveis - Resultado da Pesquisa</title>
    <link rel="icon" href="img/logo.png">
  </head>
  <body>

    <!-- navbar-top.php e navbar-top.css no head -->
    <?php include('navbar-top.php');?>
    <!-- FIM navbar-top.php e navbar-top.css no head -->

    <!-- BOTÃO PIXADO WHATSAPP -->
    <a href="https://api.whatsapp.com/send?phone=5551995513505" target="_blank" class="btn-fixado section-hide"><button type="button" class="btn btn-success btn-circle btn-lg"><img src="img/whats.png" class="right-block wpp"></button></a>
    <!-- BOTÃO PIXADO WHATSAPP -->

    <div class="container">
      <br>
      <br>
      <br>
      <div class="row">
        <div class="col-xs-12 col-sm-2 section-show">
          <div class="row"  id="row-pesquisa">
            <div class="col-xs-12 col-sm-12">
                <h3><legend class="font-laranja-click">Você quer Comprar?</legend></h3>
                <fieldset>
                  <form class="pesquisa texto-laranja" name="pesquisa" method="POST" action="pesquisarimovel2.php">
                    <div class="row">
                      <div class="col-xs-12">
                        <label for="Valor">Código:</label>
                        <input type="text" name="codigo" maxlength="5" size="10" placeholder="Informe Cód.">
                      </div>
                      <div class="col-xs-12 campo-texto">
                        <label for="tipo">Imóvel:</label>
                        <select name="tipo" class="form-control " id="tipo">
                          <?php
                            $sql = "select DISTINCT tipoimo  from imovel";
                            $resultado = mysql_query($sql,$conexao);
                            echo"<option value = ''>Selecione</option>";
                            while($dados = mysql_fetch_array($resultado)){
                            $nome = $dados['tipoimo'];
                            echo"<option value = '$nome'>$nome</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <tr>
                      <div class="col-xs-12 campo-texto">
                        <label  for="cidade">Cidade:</label>
                        <select name="cidade"  class="form-control " id="cidade">
                          <?php
                            $sql = "select DISTINCT cidade  from imovel";
                            $resultado1 = mysql_query($sql,$conexao);
                            echo"<option value = ''>Selecione</option>";
                            while($dados = mysql_fetch_array($resultado1)){
                              $nome = $dados['cidade'];
                              echo"<option value = '$nome'>$nome</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <tr>
                      <div class="col-xs-12 campo-texto">
                        <label for="Bairro">Bairro:</label>
                          <select  name="bairro"  class="form-control " id="cidade">
                            <?php
                              $sql = "select DISTINCT bairro  from imovel ";
                              $resultado2 = mysql_query($sql,$conexao);
                              echo"<option value = ''>Selecione</option>";
                              while($dados = mysql_fetch_array($resultado2)){
                              $nome = $dados['bairro'];
                                echo"<option value = '$nome'>$nome</option>";
                              }
                            ?>
                          </select>
                      </div>
                      <tr>
                      <div class="col-xs-12 campo-texto">
                        <label for="Valor">Valores:</label>
                        <select name="valores" class="form-control " id="valores">
                          <option value = ">=0">Selecione</option>";
                          <option value = "<50000.00">Abaixo de 50 mil</option>";
                          <option value = "50000.00 and 100000.00">entre 50 mil e 100 mil </option>";
                          <option value = "101000.00 and 200000.00">entre 101 mil e 200 mil </option>";
                          <option value = "201000.00 and 400000.00">entre 201 mil e 400 mil </option>";
                          <option value = "400000.01 and 60000000.01">Acima de 400 mil </option>";
                        </select><br>
                      </div>
                      <div class="col-xs-12 col-sm-12">
                        <input class="btn btn-warning btn-block" type="submit" value="Pesquisar" />
                      </div>
                    </div>
                  </form><br>
                </fieldset>
              </div>
              <div class="col-xs-12 col-sm-12">
                    <h3><legend class="font-laranja-click">Você quer Vender?</legend></h3>
                      <form  method="POST" action="formulariovenda.php" class="texto-laranja">
                      <br>
                      <label for="">Cidade:</label>
                        <input type="hidden" name="cod" id="cod" value="<?php echo $id ?>" />
                        <select name="corr" class="form-control" id="corr">

                          <?php
                            $sql = "select * from usuario where (funcao = 'Corretor' or funcao = 'Avaliador' or funcao = 'Franqueado')";
                            $resultado1 = mysql_query($sql,$conexao);
                            echo"<option value = ''>Selecione</option>";
                            while($dados = mysql_fetch_array($resultado1)){
                            $id=$dados['idusu'];
                            $nome = $dados['cidade'];
                            echo"<option value = '$id'>$nome</option>";
                            }
                          ?>
                        </select>
                        <br>
                        <input class="btn btn-warning btn-block" type="submit" value="Vender" />
                      </form>
                    </div>
                </div>
              </div>
          <div class="container">
            <h1 class="texto-laranja text-center">Resultado da sua pesquisa!</h1>
            <div class="col-xs-12 col-sm-10">
            <div class="row">

               <?php  //inicio do codigo novo
            $codigo = $_POST["codigo"];
            $tipo = $_POST["tipo"];
            $cidade = $_POST["cidade"];
            $bairro = $_POST["bairro"];
            $valor = $_POST["valores"];
            /*if($codigo !="" && $tipo !="" && $cidade!="" && $bairro!="" && $valor!=""){
              $sql = "SELECT * FROM imovel WHERE tipo like '%$tipo' or cidade like '%$cidade' or bairro like '%$bairro' or valorvendaimo between $valor";
            }else if ($codigo!=""){
              $sql = "select * from imovel where idimo = '$codigo'";
            }else if($tipo!=""){
              $sql = "SELECT * FROM imovel WHERE tipoimo like '%$tipo'";
            }else if($cidade != ""){
              $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade'";
            }else if($bairro!=""){
              $sql = "SELECT * FROM imovel WHERE bairro like '%$bairro'";
            }else if($valor!=""){
              if($valor == '<50000.00'){
                $sql = "SELECT * FROM imovel WHERE  valorvendaimo $valor ORDER BY valorvendaimo ASC";

                }else if($valor == '50000.00 and 100000.00'){
                $sql = "SELECT * FROM imovel WHERE  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                }else if($valor =='101000.00 and 200000.00'){
                  $sql = "SELECT * FROM imovel WHERE valorvendaimo between $valor ORDER BY valorvendaimo ASC";
              //var_dump($sql);
                }else if($valor =='201000.00 and 400000.00'){
                $sql = "SELECT * FROM imovel WHERE valorvendaimo between $valor ORDER BY valorvendaimo ASC";

                }else if($valor =='>400000.00'){
                  $sql = "SELECT * FROM imovel WHERE  valorvendaimo $valor ORDER BY valorvendaimo ASC";

              }else{
                $sql = "SELECT * FROM imovel";

                }
            }*/
		     if($codigo!=""){
            if($tipo!=""){
              $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and idimo like '$codigo' and tipoimo like '$tipo'";
              if($cidade !=""){
                $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade'";
                if($bairro !=""){
                  $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro'";
                  if($valor!=""){
                    if($valor == '<50000.00'){
                      $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo $valor ORDER BY valorvendaimo ASC";
                    }else if($valor == '50000.00 and 100000.00'){
                      $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='101000.00 and 200000.00'){
                      $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='201000.00 and 400000.00'){
                      $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='400000.01 and 60000000.01'){
                      $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }
                  }else{
                    $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro'";
                  }
                }else{
                  $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo' and cidade like '%$cidade'";
                }
              }else{
                $sql = "SELECT * FROM imovel WHERE idimo like '$codigo' and tipoimo like '$tipo'";
              }
            }else{
              $sql= "SELECT * FROM imovel WHERE idimo like '$codigo'";
            }
            }else if($tipo!=""){
              $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo'";
              if($cidade !=""){
                $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade'";
                if($bairro !=""){
                  $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro'";
                  if($valor!=""){
                    if($valor == '<50000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo $valor ORDER BY valorvendaimo ASC";

                    }else if($valor == '50000.00 and 100000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='101000.00 and 200000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='201000.00 and 400000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='400000.01 and 60000000.01'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }
                  }else{
                    $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and bairro like '$bairro'";
                  }
                }else{
                  if($valor!=""){
                    if($valor == '<50000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and  valorvendaimo $valor ORDER BY valorvendaimo ASC";

                    }else if($valor == '50000.00 and 100000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='101000.00 and 200000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='201000.00 and 400000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='400000.01 and 60000000.01'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }
                  }else{
                    $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and cidade like '%$cidade'";
                  }
                }
            	}else{
            		if($bairro !=""){
                  $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and bairro like '$bairro'";
                  if($valor!=""){
                    if($valor == '<50000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and bairro like '$bairro' and  valorvendaimo $valor ORDER BY valorvendaimo ASC";

                    }else if($valor == '50000.00 and 100000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='101000.00 and 200000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='201000.00 and 400000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='400000.01 and 60000000.01'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and bairro like '$bairro' and valorvendaimo between $valor ORDER BY valorvendaimo ASC";

                    }
                  }else{
                    $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and bairro like '$bairro'";
                  }
                }else{
                	if($valor!=""){
                    if($valor == '<50000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and  valorvendaimo $valor ORDER BY valorvendaimo ASC";

                    }else if($valor == '50000.00 and 100000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='101000.00 and 200000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='201000.00 and 400000.00'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='400000.01 and 60000000.01'){
                      $sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo' and valorvendaimo between $valor ORDER BY valorvendaimo ASC";

                    }
                  }else{
                   	$sql = "SELECT * FROM imovel WHERE tipoimo like '$tipo'";
                  }
                }
              }
            }else if($cidade !=""){
              $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade'";
                if($bairro!=""){
                  $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and bairro like '$bairro'";
                  if($valor!=""){
                    if($valor == '<50000.00'){
                      $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo $valor ORDER BY valorvendaimo ASC";
                    }else if($valor == '50000.00 and 100000.00'){
                      $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='101000.00 and 200000.00'){
                      $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='201000.00 and 400000.00'){
                      $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }else if($valor =='400000.01 and 60000000.01'){
                      $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                    }
                  }
                  }else{
                    if($valor!=""){
                      if($valor == '<50000.00'){
                        $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and  valorvendaimo $valor ORDER BY valorvendaimo ASC";
                      }else if($valor == '50000.00 and 100000.00'){
                        $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                      }else if($valor =='101000.00 and 200000.00'){
                        $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                      }else if($valor =='201000.00 and 400000.00'){
                        $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                      }else if($valor =='400000.01 and 60000000.01'){
                        $sql = "SELECT * FROM imovel WHERE cidade like '%$cidade' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                      }
                    }else{
                   	$sql = "SELECT * FROM imovel WHERE cidade like '%$cidade'";
                    }
                  }
              }else if($bairro!=""){
                $sql = "SELECT * FROM imovel WHERE bairro like '$bairro'";
                if($valor!=""){
                  if($valor == '<50000.00'){
                    $sql = "SELECT * FROM imovel WHERE bairro like '$bairro' and  valorvendaimo $valor ORDER BY valorvendaimo ASC";
                  }else if($valor == '50000.00 and 100000.00'){
                    $sql = "SELECT * FROM imovel WHERE bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                  }else if($valor =='101000.00 and 200000.00'){
                    $sql = "SELECT * FROM imovel WHERE bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                  }else if($valor =='201000.00 and 400000.00'){
                    $sql = "SELECT * FROM imovel WHERE bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                  }else if($valor =='400000.01 and 60000000.01'){
                    $sql = "SELECT * FROM imovel WHERE bairro like '$bairro' and  valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                  }
                }else{
                  $sql = "SELECT * FROM imovel WHERE bairro like '$bairro'";
                }
              }else if($valor!=""){
                if($valor == '<50000.00'){
                  $sql = "SELECT * FROM imovel WHERE valorvendaimo $valor ORDER BY valorvendaimo ASC";
                }else if($valor == '50000.00 and 100000.00'){
                  $sql = "SELECT * FROM imovel WHERE valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                }else if($valor =='101000.00 and 200000.00'){
                  $sql = "SELECT * FROM imovel WHERE valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                }else if($valor =='201000.00 and 400000.00'){
                  $sql = "SELECT * FROM imovel WHERE valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                }else if($valor =='400000.01 and 60000000.01'){
                  $sql = "SELECT * FROM imovel WHERE valorvendaimo between $valor ORDER BY valorvendaimo ASC";
                }else{
                	$sql="SELECT * FROM imovel order by idimo";
                }
              }


            $res = mysql_query($sql,$conexao);
            $linha = mysql_num_rows($res);


          if($linha>0){
            while($dados = @mysql_fetch_object($res)){
              if($dados->ativo != 0){    //codigo novo

                echo "<div class='col-xs-12 col-sm-6 col-md-4'>
                <div class='thumbnail cor-fundo'>
                  <img src=' ".$dados->foto1."'  class='img-imovel-pesquisa'>
                  <div class='caption'>
                    <div class='row'>
                      <div class='col-xs-12'>";
                       if($dados->empreendimento == 1){
                        echo "<h4 class='ipoimovel-pesquisa text-center empreend'>".$dados->nomeempreendimento."
                        </h4>
                        <div class='row'>
                          <div class='col-xs-12 text-center'>
                             <h4 class=''>".$dados->tipoimo."</h4>
                          </div>
                        </div>
                        <div class='col-xs-12 col-sm-12 col-md-12 text-left'>
                          <h4 class='valor'>R$ ".number_format($dados->valorvendaimo, 2,',','.')."
                        </div>

                        <div class='col-xs-12'>
                        </h4>
                          <h4 class='cod-texto'>"
                            .$dados->cidade."  - Bairro ".$dados->bairro.
                          "</h4>
                        </div>
                        <div class='col-xs-6 col-sm-6 col-md-6'>
                            <h4 class='texto-laranja cod-texto'>Código: ".$dados->idimo."</h4>
                        </div>
                        <div class='col-xs-6'>
                          <a href='pesquisarimovel3.php?id=".$dados->idimo."' class='btn btn-warning btn-md btn-block'>Ver mais</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>";
               }else{
                echo "<div class='row'>
                          <div class='col-xs-12 text-center'>
                             <h4 class=''>".$dados->tipoimo."</h4>
                          </div>
                        </div>
                        <div class='col-xs-12 col-sm-12 col-md-12 text-left'>
                          <h4 class='valor'>R$ ".number_format($dados->valorvendaimo, 2,',','.')."
                        </div>

                        <div class='col-xs-12'>
                        </h4>
                          <h4 class='cod-texto'>"
                            .$dados->cidade."  - Bairro ".$dados->bairro.
                          "</h4>
                        </div>
                        <div class='col-xs-6 col-sm-6 col-md-6'>
                            <h4 class='texto-laranja cod-texto'>Código: ".$dados->idimo."</h4>
                        </div>
                        <div class='col-xs-6'>
                          <a href='pesquisarimovel3.php?id=".$dados->idimo."' class='btn btn-warning btn-md btn-block'>Ver mais</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>";
              }
              }
             }
            }?>

            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <!--<div class="container">
      <nav class="text-center" aria-label="Page navigation">
        <ul class="pagination">
          <li class="disabled">
            <a href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="active"><a class="texto-laranja" href="#">1</a></li>
          <li><a class="texto-laranja" href="#">2</a></li>
          <li><a class="texto-laranja" href="#">3</a></li>
          <li><a class="texto-laranja" href="#">4</a></li>
          <li><a class="texto-laranja" href="#">5</a></li>
          <li>
            <a href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>-->


      <!-- footer.php e footer.css no head -->
        <?php include('footer.php'); ?>
      <!-- FIM footer.php e footer.css no head -->

  </body>
</html>
