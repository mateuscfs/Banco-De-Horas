<?php
	include ("Menu.php");
        
        $usuario = new Usuario();
        $mes = new Mes();
        $ano = new Ano();
        $pesquisaUsuarios = $usuario->pesquisaUsuarios();
        $pesquisaMes = $mes->pesquisaMes();
        $pesquisaAno = $ano->pesquisaAno();
        $banco_horas = new Banco_Horas();
        
       if(isset($_GET["id"])){
        $id_banco = $_GET["id"];
        $_SESSION["id_banco_horas"] = $id_banco;
        @$pesquisaBancoHoras = $banco_horas->pesquisaBancoHora($id_banco);
       }else{
           @$pesquisaBancoHoras = $banco_horas->pesquisaBancoHora($_SESSION["id_banco_horas"]);
       }
        
//        $calculaDiferenca = $banco_horas->diferencaHoras("09:00:00", "08:00:00");
//                  var_dump($calculaDiferenca);
        
       
      
       
        if(isset($_POST["alterar"])){
          
            
            $horas = $_POST["horas"].":00";
          
           
            if( $horas< "31:00" ){
                
             $horaCalculada = $banco_horas->horaCalculo25($horas);
             
         
             
            
            $insereHoras = $banco_horas->alteraHora($_POST["usuario"], $_POST["ano"], $_POST["mes"], $horaCalculada, $_POST["observacao"]);
            
            }else{
                $horaCalculada = $banco_horas->horaCalculo50($horas);
       
                 $insereHoras = $banco_horas->alteraHora($_POST["usuario"], $_POST["ano"], $_POST["mes"], $horaCalculada, $_POST["observacao"]);
                
            }
        
             if($insereHoras){
                 
                 
                      echo "<div class='alert alert-success' style = 'margin-top: 4%'>
                             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong>Sucesso!</strong> Horas alteradas com sucesso!
                                </div>";  
                 
                    $alterarHoraMesProx = $banco_horas->alteraHoraMesProx($_POST["usuario"], $_POST["ano"], $_POST["mes"]);
                 
                    if($alterarHoraMesProx){
                         echo "<div class='alert alert-success' style = 'margin-top: 4%'>
                             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong>Sucesso!</strong> Horas dos proximos messes alteradas com sucesso!
                                </div>";  
                    }else{
                         echo "<div class='alert alert-danger' style = 'margin-top: 4%'>
                             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong>Erro!</strong> Não foi possivel alterar as horas dos proximos messes.
                                </div>";  
                    }
                    
                     
                 }else{
                      echo "<div class='alert alert-danger' style = 'margin-top: 4%'>
                             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong>Erro!</strong> Não foi possivel alterar as horas do mes desejado!
                                </div>";  
                 }
            
              
            }
                

        
        
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Banco De Horas</title>
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
      <link rel="stylesheet" href="CSS/cadastro.css">
           <script type="text/javascript" src="JavaScript/verificaHorasMesExistente.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://pastebin.com/raw/QkBYGVub"></script>
      <script type="text/javascript" src="https://pastebin.com/raw/neg3Zijg" ></script>
      <script type="text/javascript" src="https://pastebin.com/raw/10z8dxLQ"></script>
     <SCRIPT LANGUAGE="JavaScript">
           function valida_horas(edit){

    console.log(edit.value[0]);
    
     
     
     if(edit.value[0] === "-"){
         
         if(edit.value.length===3){

        edit.value+=":";
    
        }
         
         
     }else{
         if(edit.value.length===2  ){

        edit.value+=":";
         }
         
           if(edit.value.length===5  ){

                edit.value+=" ";
         }
         
        
    
        
     }

  
      

}
          
          
       </script>
      
</head>

<body>

    <form action="alterarHoraMes.php" method="post" style="width: 100%;">
  <h2>Cadastro de Horas</h2>
  
  <?php while ($p = mysqli_fetch_array($pesquisaBancoHoras)) {  ?>
		<p>
			<label class="floatLabel">Usuários</label>
                        
                        <select id="usuario" name="usuario" style="margin-top: 2%;" >
                          
				<option value="<?php echo $p["id_usuario"]; ?>"><?php echo $p["nome"]; ?></option>
                                
                          
			</select>
		</p>
                
               
                
                <p>
                        <label class="floatLabel">Ano</label>
                        <select id="ano" name="ano" style="" >
                          
				<option value="<?php echo $p["id_ano"]; ?>"><?php echo $p["Ano"]; ?></option>
                                
                          
                        </select>
		</p>
                
                 <p>
			<label class="floatLabel">Mês</label>
                        
                        <select id="mes" name="mes" style="margin-top: 2%;" >
                           
				<option value="<?php echo $p["id_mes"]; ?>"><?php echo $p["descricao"]; ?></option>
                                
                          
			</select>
                        
                     
                        
                </p>
                
                <p>
                    
                     <div id="resultado"></div>
                </p>
                  
                
		<p>
			<label for="horas" class="floatLabel">Horas</label>
                        <input id="horas" name="horas" type="text" minlength="5" maxlength="6" onkeypress="valida_horas(this)" value="<?php echo substr($p["horas_mes"],0, -3); ?>" >
                        <input id="" name="horasOld" type="text"  value="<?php echo $p["horas_mes"]; ?>" hidden="">
                        <input id="" name="devendo" type="text"  value="<?php echo $p["devendo"]; ?>" hidden="">
		</p>
   
                <p>
                        <label class="floatLabel">Observação</label>
                        <input id="obs" name="observacao" type="text" value="<?php echo $p["observacao"]; ?>">
		</p>
		<p>
                    <input id="" name="id_banco_hora" type="text"  value="<?php echo $p["id_banco_horas"]; ?>" hidden="">
                    <input type="submit" value="alterar" name="alterar" class="btn btn-success btn-lg" id="">
		</p>
                
              <?php } ?>
	</form>
  
</body>
</html>
