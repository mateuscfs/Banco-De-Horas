<?php
include("Menu.php");

$usuario = new Usuario();
$mes = new Mes();
$ano = new Ano();
$banco_horas = new Banco_Horas();
$pesquisaAno = $ano->pesquisaAno();
$pesquisaUsuarios = $usuario->pesquisaUsuarios();
$pesquisaHoras = null;
if(isset($_POST["Pesquisar"]))
{
   $pesquisaHoras = $banco_horas->pesquisaTodasHorasAnoUsuario($_POST["ano"], $_POST["usuario"]);
  // $totalHoraUsuario = $usuario->pesquisaTotalHoras($_POST["usuario"]);
   $descricaoAno = $ano->pesquisaAnoID($_POST["ano"]);
   $nomeUsuario = $usuario->pesquisaNome($_POST["usuario"]);
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Banco De Horas</title>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
	<link href="CSS/bancoUsuario.css" rel="stylesheet">
<script>
      
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    
      $('#VisualizarUsuario').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
    
    
    $('#VisualizarUsuario tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
    } );
     
    var table = $('#VisualizarUsuario').DataTable({
        "scrollX": true,
        "lengthMenu":  [12] ,
        ordering: false,
        dom: 'Bfrt',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
   
} );
       
         </script>
         <style>
/*          div.dataTables_wrapper div.dataTables_filter {
    margin-right: 4%;
}

div.dataTables_wrapper div.dataTables_paginate {
    
    margin-left: 50%;
}*/
         </style>
</head>
	<body>
		<div class="container-fluid" >
			<center>
                            <form action="VisualizarHorasUsuario.php" method="post">
                                <select class="selectpicker" name="usuario" required="">
                            <?php while ($usu = mysqli_fetch_array($pesquisaUsuarios)) { ?>
				<option value="<?php echo $usu["id_usuario"]; ?>"><?php echo $usu["nome"]; ?></option>
                                
                            <?php } ?>
                        </select>
                          <select id="ano" name="ano" style="" required="">
                            <?php while ($ano = mysqli_fetch_array($pesquisaAno)) { ?>
				<option value="<?php echo $ano["id_ano"]; ?>"><?php echo $ano["descricao"]; ?></option>
                                
                            <?php } ?>
			</select>
                            
                          <input type="submit" value="Pesquisar" name="Pesquisar" id="submit">
                            </form>
                             <?php if($pesquisaHoras != null){ ?>
			<table id="VisualizarUsuario" class="table table-bordered table-hover table-striped" style="margin-top: 5%; " cellspacing="0" width="75%" >
				<thead>
					<tr>
                                            
						<th class="titulo" colspan="3"><?php echo $nomeUsuario;?></th>
						
                                               
						<th class="titulo2" colspan="2"><?php echo $descricaoAno;?></th>
                                                
					</tr>
					<tr>
                                            <th></th>
						 <th>Mês</th>
						 <th>Horas</th>
                                                  <th>Horas Devendo</th>
						 <th class="obs">Observações</th>
                                             
					</tr>
				</thead>
				<tbody>
					<?php while ($p = mysqli_fetch_array($pesquisaHoras)) {  ?>
						<tr>
                                                    <td><a href="alterarHoraMes.php?id=<?php echo $p["id_banco_horas"]; ?>"<i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                                    <td class="nome"> <?php echo $p["descricao"];?></td>
                                                  <?php if($p["horas_mes"][0] == "-"){ ?>
                                                    <td style="color: red !important;"><?php echo $p["horas_mes"]?></td>
                                                  <?php }else{ ?>
                                                        <td class=""><?php echo $p["horas_mes"]?></td>
                                                  <?php } ?>
                                                  <?php if($p["devendo"][0] == "-"){ ?>
                                                        <td style="color: red !important;"><?php echo $p["devendo"]?></td>
                                                  <?php }else { ?>
                                                        <td class=""><?php echo $p["devendo"]?></td>
                                                  <?php } ?>
							<td class="nome"><?php echo $p["observacao"]?></td>  
						</tr>
                                               
                                                
					<?php $totalHoraUsuario = $p["total_final_mes"];} ?>
				</tbody>
                                <tfoot>
                                    <tr>
                                     
                                          <td colspan="3" style="font-size: x-large;"> Total</td>
                                       
                                         <td colspan="2" style="font-size: x-large;"><?php echo @$totalHoraUsuario ?></td>
                                    </tr>
                                </tfoot>
			</table>
                             <?php } ?>
			</center>
		</div>
	</body>
</html>