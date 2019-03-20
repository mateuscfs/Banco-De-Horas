<?php
    include_once './Classes/classes.php';

  header("Content-Type: text/html; charset=UTF-8");

 
$banco = new Banco();
$class_mes = new Mes();
//  $mysqli = new mysqli('mysql05-farm60.kinghost.net', 'arbox03', 'valid123', 'arbox03');
  
//    $mysqli = new mysqli('mysql.brasilmg.com.br', 'brasilmg01', 'aspira123', 'brasilmg01');
  
 //$mysqli = new mysqli('localhost', 'root', '', 'arbox');

$mysqli = $banco->con;

  $usuario = filter_input(INPUT_GET, 'usuario');
 
  $ano = filter_input(INPUT_GET, 'ano');
  $sql = "SELECT MAX(id_mes) FROM `banco_horas` WHERE `id_usuario` = '{$usuario}'  and id_ano = '{$ano}'"; //monto a query

  $query = $mysqli->query( $sql ); //executo a query
   $resultado = mysqli_fetch_row($query);
    $mesID = $resultado[0]+1;
  
    $descricaoMes = $class_mes->pesquisaMesID($mesID);
  
    var_dump($descricaoMes, $mesID);
        
  if( $query->num_rows > 0 ) {//se retornar algum resultado
      
    // echo "<span class='glyphicon glyphicon-remove-circle' style='color: red'></span> <b style='color: red'>Horas ja inseridas neste mes!</b>"; //disponivel
      if($mesID != 13){
     echo '<script> document.getElementById("mes").innerHTML = "<option  value='.$mesID.'>'.$descricaoMes.'</option>"; </script>';
      }else{
           echo '<script> document.getElementById("mes").innerHTML = "<option>Todos os meses desse ano já cadastrados </option>"; </script>';
      }
  }else{
      
     
      
    //  echo "<span class='glyphicon glyphicon-remove-circle' style='color: red'></span> <b style='color: red'>CPF já existe!</b>" ; //existente
     //   echo "<script> document.getElementById('cadastrarHoras').disabled = false; </script>";
      
  } 
 

?>