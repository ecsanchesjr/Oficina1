<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>SACI - Área de usuários</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link href="datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
		<link href="datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/common.css" />
		<link rel="stylesheet" type="text/css" href="css/home.css" />
		<script src="datatables/jquery.dataTables.min.js"></script>
		<script src="datatables/dataTables.select.min.js"></script>
		<script src="datatables/dataTables.buttons.min.js"></script>
		<link rel="stylesheet" type="text/css" href="datatables/select.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="datatables/buttons.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">

		<script>
			var code;
			$(document).ready(function(){
				$("#TableP").hide();
			});
			$(document).ready(function(){
				$("#txtSearch").on("keydown", function(){
					if(event.keyCode == 13 && $("#txtSearch").val() != ""){
						$.post("../controller/BuscarController.php",
					{
						txtSearch: $("#txtSearch").val()
					},
				function(data, status){
					document.getElementById("TabelaSearch").innerHTML = data;
					$("#txtSearch").val("");
					$("#ModalSearch").modal();
				})
					}
				});
			});
		</script>
		<script>
			$(document).ready(function(){
				$("#btnRelatory").click(function(){
					$("#ModalRel").modal();
				});
			});
		</script>
		<script>
			function Relatory(){
				$(document).ready(function(){
					$.post("../controller/RelatoriosController.php",
					{
						code: code
					},
					function(data,status){
						if(tabelaC != null){
							$("#TabelaConsultas").DataTable().clear();
							$("#TabelaConsultas").DataTable().destroy();
							var thead = $("#TabelaConsultas > thead");
							thead.remove();
							var tbody = $("#TabelaConsultas > tbody");
							tbody.remove();
						}
						$("#ModalRel").modal('hide');
						document.getElementById("TabelaConsultas").innerHTML = data;
						startTable();
					});
				});
			}
		</script>
		<script>
			var tabelaC=null;
			var relP;
			function startTable(){
				switch(code){
					case 1:
						relP = "EMPRÉSTIMOS ATIVOS ATUALMENTE";
						break;
					case 2:
						relP = "HISTÓRICO DE DEVOLUÇÕES";
						break;
					case 3:
						relP = "FREQUÊNCIA DE EMPRÉSTIMO POR ITEM";
						break;
					case 4:
						relP = "ITENS FORA DA SALA DE ORIGEM";
						break;
				}
				document.getElementById("tableP").innerHTML = relP;
				$(document).ready(function(){
					tabelaC = $("#TabelaConsultas").DataTable({
						bSort: true,
						retrieve: true,
						ordering: true,
						paginate: true,
						bFilter: true,
						bInfo: true,
						language:{
							search: "",
							//search: "Filtrar: "
							searchPlaceholder: "Filtrar consulta"
						}
					});
					$('div.dataTables_filter input').addClass("form-control inputFilter");
				});
			}
		</script>
	</head>
	<body>
		<div id="divGod" class="godDiv godDivBorder"> <!-- GOD div -->
			<p class="title giant-title titleAlign textCenter">
				Seja Bem-Vindo ao Portal do SACI
			</p>
			<div class="infoGroup parent">
				<div>
					<?php
						include("../model/UserDAO.php");
						$obj = new UserDAO();
						$nick = $_SESSION["usuario"];
						echo '<p class="textInfos textCenter textFontSize textColor">'.$obj->getNameUser($nick).'</p>';
						echo '<p class="textInfos textCenter textFontSize textColor">'.$obj->getReUser($nick).'</p>';
					?>
				</div>
				<div class="btnDiv dropdown"> <!-- Botões -->
					<a id="btnRelatory" class="btn btn-default myBtn" role="button">Gerar Relatório</a>
					<a id="btnControlPanel" class="btn btn-default myBtn" role="button">Painel de Controle</a>
					<button class="btn btn-default myBtn dropdown-toggle" type="button" data-toggle="dropdown">Opções
						<span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a class="dropdown-item" href="Ajuda.html">Ajuda</a></li>
						<li><a class="dropdown-item" href="../index.php">Sair</a></li>
					</ul>
				</div>
			</div>
			<!--- Div de busca -->
			<div id="divSearch" class="form-group has-feedback divSearch">
				<input type="text" id="txtSearch" placeholder="Buscar localização de um item" class="form-control">
					<i class="glyphicon glyphicon-search form-control-feedback"></i>
				</input>
			</div>

			<!--- tabela de relatórios --->
			<div class="tableDiv">
				<h3 id="tableP" class="textInfos textColor" align="center"></h3>
				<table id = "TabelaConsultas" class="display table-bordered centerTable styleBasic cell-border compact"></table>
			</div>
		</div> <!-- GOD div-->

		<div class="modal fade" id="ModalRel" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Conteudo do modal-->
			  <div class="modal-content">
				 <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title modalTitleCenter">Selecionar opções de relatórios</h3>
				 </div>
				 <div id="MensagemModal" class="modal-body">
				 	<div id="padraoRel" class="modalDivRelPadrao">
						<a id="btnEmp" class="btn btn-default modalBtn" onclick="Relatory();code=1" role="button">Empréstimos abertos</a>
						<a id="btnHistDev" class="btn btn-default modalBtn" onclick="Relatory();code=2" role="button">Histórico</a>
						<a id="btnFreq" class="btn btn-default modalBtn" onclick="Relatory();code=3" role="button">Frequência de itens</a>
						<a id="btnFreq" class="btn btn-default modalBtn" onclick="Relatory();code=4" role="button">Itens em salas erradas</a>
					</div>
					<div id="lineHr"><br /></div>
					<div class="clear"></div>
					<br />
					<div>
						<h4 class="modalTitleCenter" style="width: 20.5%">Personalizar Relatório</h4>
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

		<!-- Modal de Resultados da Busca -->
		<div class="modal fade" id="ModalSearch" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">
				 <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title modalTitleCenterSearch">Resultados da busca</h3>
				 </div>
				 <div id="msgModal" class="modal-body">
						<div class="tableDivSearch">
					 	<table id = "TabelaSearch" class="display centerTable styleBasic cell-border tableSearch"></table>
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
