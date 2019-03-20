<?php
include("Menu.php");

 $mes = new Mes();
 $ano = new Ano();
 $pesquisaMes = $mes->pesquisaMes();
 $pesquisaAno = $ano->pesquisaAno();
 $banco_horas = new Banco_Horas();
$pesquisaHorasMes = null;
if(isset($_POST["Pesquisar"]))
{
   $pesquisaHorasMes = $banco_horas->pesquisaHoraMes($_POST["ano"], $_POST["mes"]);
   $descricaoMes = $mes->pesquisaMesID($_POST["mes"]);
   $descricaoAno = $ano->pesquisaAnoID($_POST["ano"]);
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Banco De Horas</title>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
	<link href="CSS/bancoMes.css" rel="stylesheet">
<script>
      
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    
      $('#VisualizarMes').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
    
    
    $('#VisualizarMes tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
    } );
     
    var table = $('#VisualizarMes').DataTable({
        "scrollX": true,
        "lengthMenu": [ 20 ],
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
		<div class="container-fluid">
		<center>
                     <form action="VisualizarMes.php" method="post">
                         <select id="mes" name="mes" style="" required="">
                            <?php while ($mes = mysqli_fetch_array($pesquisaMes)) { ?>
				<option value="<?php echo $mes["id_mes"]; ?>"><?php echo $mes["descricao"]; ?></option>
                                
                            <?php } ?>
			</select>
                         <select id="ano" name="ano" style="" required="">
                            <?php while ($ano = mysqli_fetch_array($pesquisaAno)) { ?>
				<option value="<?php echo $ano["id_ano"]; ?>"><?php echo $ano["descricao"]; ?></option>
                                
                            <?php } ?>
			</select>
                   
                      <input type="submit" value="Pesquisar" name="Pesquisar" id="submit">
                    </form>
                    <?php if($pesquisaHorasMes != null){ ?>
			<table id="VisualizarMes" class="table table-bordered table-hover table-striped" cellspacing="0" width="75%" >
				<thead>
					<tr>
						<th class="titulo"><?php echo $descricaoMes;?></th>
						<th class="titulo"></th>
                                                <th class="titulo"></th>
						<th class="titulo2"><?php echo $descricaoAno;?></th>
					</tr>
					<tr>
						 <th>Usuário</th>
						 <th>Horas do Mês</th>
						 <th>Total até final do Mês</th>
                                                 <th>Observação</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($p = mysqli_fetch_array($pesquisaHorasMes)) { ?>
						<tr>
							<td class="nome"><?php echo $p["nome"];?></td>
                                                        <?php if($p["horas_mes"] < 0){?>
							<td class="negativo" id="hora"><?php echo $p["horas_mes"];?></td>
                                                        <?php }else{ ?>
                                                        <td id="hora"><?php echo $p["horas_mes"];?></td>
                                                        <?php } ?>
                                                        <?php 
                                                        
                                                        $total = $banco_horas->contarHorasAteMes($p["id_ano"], $p["id_mes"], $p["id_usuario"]);
                                                            
                                                        
                                                        if($total[0] == "-"){   
                                                            
                                                                
                                                            
                                                            ?>
                                                        
                                                        <td class="negativo" id="hora"><?php echo $total;?></td>
                                                        <?php }else{ ?>
                                                        <td class="" id="hora"><?php echo $total;?></td>
                                                        <?php } ?>
                                                        <td class="hora" id="hora"><?php echo $p["observacao"];?></td>  
						</tr>
                                                
					<?php } ?>
				</tbody>
			</table>
                    <?php } ?>
			</center>
		</div>
		<script language="JavaScript" type="text/javascript">
			MakeNegative();
		</script>
	</body>
</html>