<?php
	include ("Menu.php");
        
        $usuario = new Usuario();
        $mes = new Mes();
        $ano = new Ano();
        $pesquisaUsuarios = $usuario->pesquisaUsuarios();
        $pesquisaMes = $mes->pesquisaMes();
        $pesquisaAno = $ano->pesquisaAno();
        $banco_horas = new Banco_Horas();
        
    
        
       
        
        if(isset($_POST["Cadastrar"])){
            
            
            
            $horas = $_POST["horas"].":00";
          
           var_dump($horas);
            if($horas< "31:00" ){
                
             $horaCalculada = $banco_horas->horaCalculo25($horas);
             
           
             
            
            $insereHoras = $banco_horas->insereHora($_POST["usuario"], $_POST["ano"], $_POST["mes"], $horaCalculada, $_POST["observacao"]);
            
            }else{
                $horaCalculada = $banco_horas->horaCalculo50($horas);
              
                 $insereHoras = $banco_horas->insereHora($_POST["usuario"], $_POST["ano"], $_POST["mes"], $horaCalculada, $_POST["observacao"]);
                
            }
        
             if($insereHoras){
                       echo "<div class='alert alert-success' style = 'margin-top: 4%'>
                             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong>Sucesso!</strong> Horas cadastradas
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
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.3/inputmask/jquery.inputmask.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.3/inputmask/inputmask.js"></script>
    
      <script type="text/javascript" src="https://pastebin.com/raw/QkBYGVub"></script>
      <script type="text/javascript" src="https://pastebin.com/raw/neg3Zijg" ></script>
      <script type="text/javascript" src="https://pastebin.com/raw/10z8dxLQ"></script>
 
      
</head>

<body>

    <form action="CadastroHoras.php" method="post" style="width: 100%;">
  <h2>Cadastro de Horas</h2>
		<p>
			<label class="floatLabel">Usuários</label>
                        
			<select id="usuario" name="usuario" style="margin-top: 2%;">
                            <?php while ($usu = mysqli_fetch_array($pesquisaUsuarios)) { ?>
				<option value="<?php echo $usu["id_usuario"]; ?>"><?php echo $usu["nome"]; ?></option>
                                
                            <?php } ?>
			</select>
		</p>
                
               
                
                <p>
                        <label class="floatLabel">Ano</label>
                        <select id="ano" name="ano" style="">
                            <option value="0">Selecione o ano</option>
                            <?php while ($ano = mysqli_fetch_array($pesquisaAno)) { ?>
				<option value="<?php echo $ano["id_ano"]; ?>"><?php echo $ano["descricao"]; ?></option>
                                
                            <?php } ?>
                        </select>
		</p>
                
                 <p>
			<label class="floatLabel">Mês</label>
                        
			<select id="mes" name="mes" style="margin-top: 2%;">
                            <?php //while ($mes = mysqli_fetch_array($pesquisaMes)) { ?>
<!--				<option value="<?php //echo $mes["id_mes"]; ?>"><?php //echo $mes["descricao"]; ?></option>-->
                                
                            <?php //} ?>
			</select>
                        
                     
                        
                </p>
                
                <p>
                    
                     <div id="resultado"></div>
                </p>
                  
                
		<p>
			<label for="horas" class="floatLabel">Horas</label>
                        <input id="horas" name="horas" type="text" minlength="5" maxlength="6" onkeypress="valida_horas(this)" >
		</p>
   
                <p>
                        <label class="floatLabel">Observação</label>
                       <input id="obs" name="observacao" type="text">
		</p>
		<p>
                    <input type="submit" value="Cadastrar" name="Cadastrar" class="btn btn-success btn-lg" id="cadastrarHoras">
		</p>
	</form>
  
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

  
  document.getElementById('cadastrarHoras').disabled = true;


 
	</SCRIPT>
</body>
</html>
