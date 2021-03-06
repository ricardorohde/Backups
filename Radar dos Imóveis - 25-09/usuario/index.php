﻿<?php
require '../conexao.php';
@session_start();
      if((!isset ($_SESSION['login_usuario']) == true) and (!isset ($_SESSION['senha_usuario']) == true)) {   
        unset($_SESSION['login_usuario']); 
        unset($_SESSION['senha_usuario']); 
        echo"<script type='text/javascript'> alert('Necessario fazer o Login!!'); </script>";
        echo"<meta http-equiv='refresh' content='0; url=../login.php' />";
           //header('location: index.php'); 
      }else{
        @session_start();
        $logado = $_SESSION['nomecompleto_usuario'];
        $imgusu = $_SESSION['img_usuario'];
      }
// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):
	$conexao = conexao::getInstance();
	$sql = 'SELECT * FROM usuario';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);
else:
	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT * FROM usuario';
	$termo1 = (isset($_GET['combo'])) ? $_GET['combo'] : '';
	if($termo1 == 1 ){
			$sql .= ' WHERE nome LIKE :nome order by idusu';
		    $stm = $conexao->prepare($sql);
	        $stm->bindValue(':nome', $termo.'%');
    }else if($termo1 == 2 ){
			$sql .= ' WHERE email LIKE :email order by idusu';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':email', $termo.'%');
	}else if($termo1 == 3 ){
			$sql .= ' WHERE fonecel LIKE :fonecel order by idusu';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':fonecel', $termo.'%');
	}else if($termo1 == 4 ){
			$sql .= ' WHERE funcao LIKE :funcao order by idusu';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':funcao', $termo.'%');
	}else if($termo1 == 5){
		$sql .= ' WHERE cidade LIKE :cidade order by idusu';
		    $stm = $conexao->prepare($sql);
	        $stm->bindValue(':cidade', $termo.'%');
		
	}

	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="Radar dos Imóveis" content="">
	<title>Listagem de Usuários</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<!-- CSS do footer.php --><link rel="stylesheet" href="../css/footer.css">
    <!-- CSS do navbar-top.php --><link rel="stylesheet" href="../css/navbar-top.css">
</head>
<body>
	<!-- navbar-top.php e navbar-top.css no head -->
    <?php include('../navbar-log.php');?>
    <!-- FIM navbar-top.php e navbar-top.css no head -->
	<div class='container cabe'>
		<h1 class="text-center text-laranja">Usuários</h1>
		<fieldset>
			<!-- Cabeçalho da Listagem -->
			<legend><a href='../are.php' class="btn btn-voltar btn-success pull-right">Retornar</a><br><br></legend>

			<!-- Formulário de Pesquisa -->
			<form action="" method="get" id='form-contato' class="form-horizontal">
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-1 col-lg-1 text-center ">
						<label class="control-label text-laranja" for="termo" style="font-size: 14pt;">Pesquisar</label>
					</div>
					<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
				    	<input type="text" class="form-control text-laranja" id="termo" name="termo" placeholder="Infome o Nome, E-mail, Celular, Função ou Cidade"><br>
					</div>
					<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3 div-mar'>
						<select size="1" name="combo" class="form-control text-laranja">
							<option selected value="1">Selecione!</option>
							<option value="1">Nome</option>
							<option value="2">E-mail</option>
							<option value="3">Celular</option>
							<option value="4">Função</option>
							<option value="5">Cidade</option>	
						</select>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-left div-mar">
					    <button type="submit" class="btn show btn-md btn-primary">Pesquisar</button>
					    <a href='index.php' class="btn show btn-md btn-primary">Ver Todos</a>

					    <button type="submit" class="btn hide btn-md btn-block btn-primary">Pesquisar</button>
					    <a href='index.php' class="btn hide btn-md btn-block  btn-primary">Ver Todos</a>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-right">
						<a href='cadastro.php' class="btn show btn-md btn-success">Cadastrar Usuário</a>
						<a href='cadastro.php' class="btn hide btn-md btn-block btn-success">Cadastrar Usuário</a>
					</div>
				   </div>
			</form>
			<!-- Link para página de cadastro -->
		</fieldset>
	</div>
	<div class="container show2 ">
		<?php if(!empty($clientes)):?>
				<!-- Tabela de Clientes -->
				<table class="table table-striped">
					<tr class='active'>
						<th>Foto</th>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Celular</th>
						<th>Função</th>
						<th>Cidade</th>
						<th>Ação</th>
					</tr>
					<?php foreach($clientes as $cliente):?>
						<tr>
							<td><img src='fotos/<?=$cliente->foto?>' height='40' width='40'></td>
							<td><?=$cliente->nome?></td>
							<td><?=$cliente->email?></td>
							<td><?=$cliente->fonecel?></td>
							<td><?=$cliente->funcao?></td>
							<td><?=$cliente->cidade?></td>
							<td>
								<a href='editar.php?idusu=<?=$cliente->idusu?>' class="hide btn btn-xs  btn-warning btn-block ">Editar</a>
								<a href='javascript:void(0)' class="hide btn btn-xs btn-danger btn-block link_exclusao" rel="<?=$cliente->idusu?>">Excluir</a>
								<a href='editar.php?idusu=<?=$cliente->idusu?>' class="show btn btn-sm show btn-warning">Editar</a>
								<a href='javascript:void(0)' class="show btn btn-sm btn-danger link_exclusao" rel="<?=$cliente->idusu?>">Excluir</a>
							</td>
						</tr>	
					<?php endforeach;?>
				</table>
			<?php else: ?>
				<!-- Mensagem caso não exista clientes ou não encontrado  -->
				<h3 class="text-center text-primary">Não existem Usuários cadastrados!</h3>
			<?php endif; ?>
		</div>
		<div class="hide">
			<?php if(!empty($clientes)):?>
				<!-- Tabela de Clientes -->
				<table class="table table-striped">
					<tr class='active'>
						<th>Nome</th>
						<th>Função</th>
						<th>Cidade</th>
						<th>Ação</th>
					</tr>
					<?php foreach($clientes as $cliente):?>
						<tr>
							<td><?=$cliente->nome?></td>
							<td><?=$cliente->funcao?></td>
							<td><?=$cliente->cidade?></td>
							<td>
								<a href='editar.php?idusu=<?=$cliente->idusu?>' class="hide btn btn-xs  btn-warning btn-block ">Editar</a>
								<a href='javascript:void(0)' class="hide btn btn-xs btn-danger btn-block link_exclusao" rel="<?=$cliente->idusu?>">Excluir</a>
								<a href='editar.php?idusu=<?=$cliente->idusu?>' class="show btn btn-md show btn-warning">Editar</a>
								<a href='javascript:void(0)' class="show btn btn-md btn-danger link_exclusao" rel="<?=$cliente->idusu?>">Excluir</a>
							</td>
						</tr>	
					<?php endforeach;?>
				</table>
			<?php else: ?>
				<!-- Mensagem caso não exista clientes ou não encontrado  -->
				<h3 class="text-center text-primary">Não existem Usuários cadastrados!</h3>
			<?php endif; ?>
		</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>