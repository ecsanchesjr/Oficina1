<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>SACI - Área de usuários</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/common.css" />
		<link rel="stylesheet" type="text/css" href="css/home.css" />
		<script>
			$(document).ready(function(){
				$("#txtSearch").on("keydown", function(){
					if(event.keyCode == 13 && $("#txtSearch").val() != ""){
						$.post("../controller/BuscarController.php",
					{
						txtSearch: $("#txtSearch").val()
					},
				function(data, status){
				})
					}
				});
			});
		</script>
		<script>
			$(document).ready(function(){
				$("#btnRelatory").click(function(){
					$("#Modal").modal();
				});
			});
		</script>
		<script>
			function Relatory1(){
				$(document).ready(function(){
					$.post("../controller/RelatoriosController.php",
					{
						code: 1
					},
					function(data,status){
					});
				});
			}
			function Relatory2(){
				$(document).ready(function(){
					$.post("../controller/RelatoriosController.php",
					{
						code: 2
					},
					function(data,status){
					});
				});
			}
			function Relatory3(){
				$(document).ready(function(){
					$.post("../controller/RelatoriosController.php",
					{
						code: 3
					},
					function(data,status){
					});
				});
			}
			function Relatory4(){
				$(document).ready(function(){
					$.post("../controller/RelatoriosController.php",
					{
						code: 4
					},
					function(data,status){
					});
				});
			}
		</script>
	</head>
	<body>
		<div class="godDiv godDivBorder"> <!-- GOD div -->
			<p class="title giant-title titleAlign textCenter">
				Seja Bem-Vindo ao Portal do SACI
			</p>
			<div class="infoGroup parent">
				<div>
					<?php
						session_start();
						include("../model/UserDAO.php");
						$obj = new UserDAO();
						$nick = $_SESSION["usuario"];
						echo '<p class="textInfos textCenter textFontSize textColor">'.$obj->getNameUser($nick).'</p>';
						echo '<p class="textInfos textCenter textFontSize textColor">'.$obj->getReUser($nick).'</p>';
					?>
				</div>
				<div class="btnDiv"> <!-- Botões -->
					<a id="btnRelatory" class="btn btn-default myBtn" role="button">Gerar Relatório</a>
					<a id="btnControlPanel" class="btn btn-default myBtn" role="button">Painel de Controle</a>
					<a class="btn btn-default myBtn" href="../index.php" role="button">Sair do Sistema</a>
				</div>
			</div>
			<!--- Div de busca -->
			<div id="divSearch" class="form-group has-feedback divSearch">
				<input type="text" id="txtSearch" placeholder="Buscar localização de um item" class="form-control">
				<i id="btnSearch" class="glyphicon glyphicon-search form-control-feedback"></i>
			</div>
		</div> <!-- GOD div-->

		<div class="modal fade" id="Modal" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Conteudo do modal-->
			  <div class="modal-content">
				 <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Selecionar opções de relatórios</h4>
				 </div>
				 <div id="MensagemModal" class="modal-body">
				 	<div id="padraoRel">
						<a id="btnEmp" class="btn btn-default" onclick="Relatory1()" role="button">Itens emprestados atualmente</a>
						<a id="btnHistDev" class="btn btn-default" onclick="Relatory2()" role="button">Histórico de devoluções</a>
						<a id="btnHistGeral" class="btn btn-default" onclick="Relatory3()" role="button">Histórico geral</a>
						<a id="btnFreq" class="btn btn-default" onclick="Relatory4()" role="button">Frequência de Empréstimo</a>
					</div>
					<div id="lineHr"><br /></div>
					<div class="clear"></div>
					<br />
					<div>
						<h4>Personalizar Relatório</h4>
					</div>
					<div id="personRel">
						<label class="text"><input id="checkRel" type="checkbox">Nome do item</label>
					</div>

				 </div>
				 <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				 </div>
			  </div>
			</div>
		</div>
	</body>
</html>
