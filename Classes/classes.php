<?php
include 'Conexao.php';
    
Class Login extends Banco
{
    
    public $ultimoID;
    public function __construct()
    {
        parent::__construct();
    }
    
    
   
    
    public function InsereLogin($email, $senha)
    {
        $sql = "INSERT INTO login VALUES(null,'$email', '$senha',null, null)";
        $query = mysqli_query($this->con,$sql);
        //list($resultado) = mysqli_fetch_array($query,$this->con);
	//return $resultado[0]; 
        $this->ultimoID = mysqli_insert_id($this->con);
        return $query;
    }   
    
    
   
    
    public function AlterarDadosLogin($email, $senha, $id)
    {
        $sql = "UPDATE login SET email = '$email', senha = '$senha' WHERE id_login = '$id'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    public function AlteraSenhaeEmailLogin($email,$senha, $login_id)
    {
        $sql = "UPDATE login SET senha = '$senha', email = '$email' WHERE id_login = '$login_id'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    public function AlteraSenhaLogin($senha, $login_id)
    {
         $sql = "UPDATE login SET senha = '$senha' WHERE id_login = '$login_id'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    
     public function excluirLogin($login_id)
    {
         $sql = "DELETE FROM login WHERE id_login = '$login_id'";
    
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    
    public function PesquisaUltimoID()
    {
        $sql = "SELECT max(id_login) FROM login";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        list($resultado) = mysqli_fetch_row($query);
	return $resultado; 
//        $id_login = $this->ultimoID;
//        return $id_login;
    }
    
    public function pesquisaDataUltLogin($id_login)
    {
        $sql = "SELECT data_ultimo_login FROM login WHERE id_login = '$id_login'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        list($resultado) = mysqli_fetch_row($query);
	return $resultado;
    }
    
    public function pesquisaHoraUltLogin($id_login)
    {
        $sql = "SELECT hora_ultimo_login FROM login WHERE id_login = '$id_login'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        list($resultado) = mysqli_fetch_row($query);
	return $resultado;
    }
}



Class Usuario extends Banco
{
    
    
    public function __construct()
    {
        parent::__construct();
       
    }

     public function verificaLogin($email, $senha)
    {
         
         $senha = hash('sha256', $senha);
         
        $sql = "SELECT id_usuario FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $query  = mysqli_query($this->con,$sql) or die(mysqli_error());
        $resultado = mysqli_fetch_row($query);
         return $resultado[0];
    }
    
    
     public function pesquisaNome($id_usuario)
    {
        $sql = "SELECT nome FROM usuario WHERE id_usuario = '$id_usuario'";
        $query  = mysqli_query($this->con,$sql) or die(mysqli_error());
        $resultado = mysqli_fetch_row($query);
         return $resultado[0];
    }
    
     public function ultimoLoginDataHora($id_usuario)
    {
         date_default_timezone_set('America/Sao_Paulo');
        $data_ultimo_login  =  date ("Y-m-d");
        $hora_ultimo_login = date ("H:i");
        
        $sql = "UPDATE usuario SET data_ultimo_login = '$data_ultimo_login', hora_ultimo_login = '$hora_ultimo_login' WHERE id_usuario = '$id_usuario'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    
      public function verificaAdmin($id_usuario)
    {
         date_default_timezone_set('America/Sao_Paulo');
        $data_ultimo_login  =  date ("Y-m-d");
        $hora_ultimo_login = date ("H:i");
        
        $sql = "UPDATE usuario SET data_ultimo_login = '$data_ultimo_login', hora_ultimo_login = '$hora_ultimo_login' WHERE id_usuario = '$id_usuario'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    
    public function insereUsuario($empresa, $email, $cpf, $nome, $data_admissao){
        $sql = "INSERT INTO usuario(id_usuario, email, senha, cpf, nome, data_admissao, empresa_id)VALUES(null, '$email', '54b4b82acae316adc3f4d19bd7077bcedd66aeff3c61fd13d719e6f535550678', '$cpf', '$nome', '$data_admissao', '$empresa')";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    
    
     public function insereTotalHoras($id_usuario, $hora){
        $sql = "UPDATE usuario SET total_horas = '$hora' WHERE id_usuario = '$id_usuario'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    
     public function pesquisaUsuarios(){
        $sql = "SELECT id_usuario, nome FROM usuario ORDER BY nome";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    
     public function pesquisaTotalHoras($id_usuario)
    {
        $sql = "SELECT total_horas FROM usuario WHERE id_usuario = '$id_usuario'";
        $query  = mysqli_query($this->con,$sql) or die(mysqli_error());
        $resultado = mysqli_fetch_row($query);
         return $resultado[0];
    }
}

Class Ano extends Banco {

    public function __construct() {
        parent::__construct();
    }
      public function pesquisaAno(){
        $sql = "SELECT * FROM ano ORDER BY id_ano";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
      }
      
      public function pesquisaAnoID($id){
        $sql = "SELECT descricao FROM ano WHERE id_ano = '$id'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        $resultado = mysqli_fetch_row($query);
         return $resultado[0];
         }
}

Class Mes extends Banco {

    public function __construct() {
        parent::__construct();
    }
    
     public function pesquisaMes(){
        $sql = "SELECT * FROM mes ORDER BY id_mes";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
        return $query;
    }
    
     public function pesquisaMesID($id){
        $sql = "SELECT descricao FROM mes WHERE id_mes = '$id'";
        $query = mysqli_query($this->con,$sql) or die(mysqli_error());
         $resultado = mysqli_fetch_row($query);
         return $resultado[0];
    }
    
}



Class Banco_Horas extends Banco {

    public function __construct() {
        parent::__construct();
    }

    public function somarHoras($hora1, $hora2) {


        if ($hora1 != null && $hora2 != null) {

            $horas = array($hora1, $hora2);

            $seconds = 0;

            foreach ($horas as $hora) {
                list( $g, $i, $s ) = explode(':', $hora);
                if ($g < 0) {
                    $i *= -1;
                    $s *= -1;
                }
                $seconds += $g * 3600;
                $seconds += $i * 60;
                $seconds += $s;
            }

            $hours = floor($seconds / 3600);
            $seconds -= $hours * 3600;
            $minutes = floor($seconds / 60);
            $seconds -= $minutes * 60;
            $negativo = false;

            if ($hours < 0 || $hora1[0] == "-") {
                $hours = -($hours);
                $negativo = true;
            }

            $horas2 = $hours . ':' . $minutes . ':' . $seconds;
            var_dump($horas2);
           // $dateTimeOne = new DateTime($horas2);

            if ($negativo) {
                //$resp = date_format($dateTimeOne, '-H:i:s');
                $resp = "-".$horas2;
                return $resp;
            }
            //$resp = date_format($dateTimeOne, 'H:i:s');
            $resp = $horas2;
            return $resp;
        } else {
            return "";
        }
    }
    
    public function calcula($h2, $h1){
    $datatime1 = new DateTime($h1);
    $datatime2 = new DateTime($h2);

    $data1  = $datatime1->format('H:i:s');
    $data2  = $datatime2->format('H:i:s');

    $diff = $datatime1->diff($datatime2);
    $horas = $diff->h + ($diff->days * 24);
    return $horas;
    }
    
    function diferencaHoras($hora1,$hora2){
            
            $hora1 = strtotime($hora1);
            $hora2 = strtotime($hora2);
            $diferenca = $hora2 - $hora1;
            $hora = floor($diferenca / 3600);
            $minutos = floor(($diferenca / 60) % 60);
            $segundos = floor($diferenca % 60);
            $resultado = "{$hora}:{$minutos}:{$segundos}";
            
            return $resultado;
        }
    
    public function horaCalculo25($hora){
        
           
           
          $horas = array($hora);
        
          $seconds = 0;

            foreach ($horas as $hora) {
              
                list( $g, $i, $s ) = explode(':', $hora);
                if ($g < 0) {
                    $i *= -1;
                    $s *= -1;
                }
                $seconds += $g * 3600;
                $seconds += $i * 60;
                $seconds += $s;
            }
            
            
            

            $hours = floor($seconds / 3600);
            $seconds -= $hours * 3600;
            $minutes = floor($seconds / 60);
            $seconds -= $minutes * 60;
            $negativo = false;
            
            

            if ($hours < 0 || $hora[0] == "-") {
                $hours = -($hours);
                $negativo = true;
                return $hora;
            }else{
              
                
               
                
                
                $horasEmMinutos = $hours * 60;
                
                $totalEmMin = $horasEmMinutos + $minutes;
               // $minutosTotal = $hours * 60 + $minutes;
                $totalMinutosComAcrescimo = $totalEmMin * 0.25 + $totalEmMin;
               // $seg = ($totalMinutosComAcrescimo - floor($totalMinutosComAcrescimo)) * 100;
                
              // $seg1 = $totalMinutosComAcrescimo;
                
                $seg = $totalMinutosComAcrescimo * 60;
                
                 $hours = floor($seg / 3600);
            $seg -= $hours * 3600;
            $minutes = floor($seg / 60);
            $seg -= $minutes * 60;
                
            
             $horas2 = $hours . ':' . $minutes . ':' . $seg;
                
            
                
                
            //  $dateTimeOne = new DateTime($horas2);
           //   return  $resp = date_format($dateTimeOne, 'H:i:s');
               return $horas2;
                
                
                
            }
            
            
    }
    
    public function horaCalculo50($hora){
        
          
            var_dump($hora);
          $horas = array($hora);
        
          $seconds = 0;

            foreach ($horas as $hora) {
                list( $g, $i, $s ) = explode(':', $hora);
                if ($g < 0) {
                    $i *= -1;
                    $s *= -1;
                }
                $seconds += $g * 3600;
                $seconds += $i * 60;
                $seconds += $s;
            }

            $hours = floor($seconds / 3600);
            $seconds -= $hours * 3600;
            $minutes = floor($seconds / 60);
            $seconds -= $minutes * 60;
            $negativo = false;

            if ($hours < 0 || $hora[0] == "-") {
                $hours = -($hours);
                $negativo = true;
                return $hora;
            }else{
              
                
               
                
                
                $horasEmMinutos = $hours * 60;
                
                $totalEmMin = $horasEmMinutos + $minutes;
               // $minutosTotal = $hours * 60 + $minutes;
                $totalMinutosComAcrescimo = $totalEmMin * 0.5 + $totalEmMin;
               // $seg = ($totalMinutosComAcrescimo - floor($totalMinutosComAcrescimo)) * 100;
                
              // $seg1 = $totalMinutosComAcrescimo;
                
                $seg = $totalMinutosComAcrescimo * 60;
                
                 $hours = floor($seg / 3600);
            $seg -= $hours * 3600;
            $minutes = floor($seg / 60);
            $seg -= $minutes * 60;
                
            
             $horas2 = $hours . ':' . $minutes . ':' . $seg;
                
            
                
                
           //   $dateTimeOne = new DateTime($horas2);
             // return  $resp = date_format($dateTimeOne, 'H:i:s');
             return $horas2;  
                
                
                
            }
            
            
    }
    
    
    public function insereHora($id_usuario, $id_ano, $id_mes, $horas_mes, $observacao){
        
            $usuario = new Usuario();
            $totalHoras = $usuario->pesquisaTotalHoras($id_usuario);
            var_dump($totalHoras);
            
           
            
            var_dump($horas_mes);
            
            $teste = str_replace("-","", $horas_mes);
            
            if($this->verificaHoraNegativa($horas_mes) && $teste > $totalHoras){
                 $horas_mes = str_replace("-","",$horas_mes);
               $somaHoras = $this->diferencaHoras($totalHoras,$horas_mes);
               var_dump($somaHoras);
             //  $somaHoras = new DateTime($somaHoras);
              //   $somaHoras = date_format($somaHoras, '-H:i:s');
               //  $horas_mes = new DateTime($horas_mes);
              // $horas_mes = date_format($horas_mes, '-H:i:s');
                $somaHoras = "-".$somaHoras;
                $horas_mes = "-".$horas_mes;
               
               
            }else if($horas_mes[0] == "-"){
                $horas_mes = str_replace("-","",$horas_mes);
               $somaHoras = $this->diferencaHoras($horas_mes, $totalHoras);
               $horas_mes = "-".$horas_mes;
            }else{
                  $somaHoras = $this->somarHoras($horas_mes, $totalHoras);
            }
            
           // $somaHoras = $this->somarHoras($horas_mes, $totalHoras);
            var_dump($somaHoras);
            $verificaHoraNegativa = $this->verificaHoraNegativa($somaHoras);
            
            if($verificaHoraNegativa === true){
                
                 $insereTotalHoras = $usuario->insereTotalHoras($id_usuario, '00:00:00');
                 $horasDevendo = $somaHoras;
                 $totalFinalMes = '00:00:00';
                
            }else{
                //insere no campo total horas do usuario
                $insereTotalHoras = $usuario->insereTotalHoras($id_usuario, $somaHoras);
                $horasDevendo = '00:00:00';
                $totalFinalMes = $somaHoras;
            }
        
        
          $sql = "INSERT INTO banco_horas VALUES(null, '$horas_mes', '$id_usuario', '$id_mes', '$id_ano', '$observacao', '$horasDevendo', '$totalFinalMes')";
        
          $resultado = mysqli_query($this->con,$sql);
          return $resultado;
        
        
    }
    
     public function alteraHora($id_usuario, $id_ano, $id_mes, $horas_mes, $observacao){
        
            $usuario = new Usuario();
            $totalHoras = $this->pesquisaTotalHoraPorUsuarioMesAnt($id_ano, $id_usuario, $id_mes);
            var_dump($totalHoras);
            
           
            
           $teste = str_replace("-","", $horas_mes);
            
            if($this->verificaHoraNegativa($horas_mes) && $teste > $totalHoras){
                 $horas_mes = str_replace("-","",$horas_mes);
               $somaHoras = $this->diferencaHoras($totalHoras,$horas_mes);
               var_dump($somaHoras);
             //  $somaHoras = new DateTime($somaHoras);
              //   $somaHoras = date_format($somaHoras, '-H:i:s');
               //  $horas_mes = new DateTime($horas_mes);
              // $horas_mes = date_format($horas_mes, '-H:i:s');
                $somaHoras = "-".$somaHoras;
                $horas_mes = "-".$horas_mes;
               
               
            }else if($horas_mes[0] == "-"){
                $horas_mes = str_replace("-","",$horas_mes);
               $somaHoras = $this->diferencaHoras($horas_mes, $totalHoras);
               $horas_mes = "-".$horas_mes;
            }else{
                  $somaHoras = $this->somarHoras($horas_mes, $totalHoras);
            }
            
           // $somaHoras = $this->somarHoras($horas_mes, $totalHoras);
            var_dump($somaHoras);
            $verificaHoraNegativa = $this->verificaHoraNegativa($somaHoras);
            
            if($verificaHoraNegativa === true){
                
                 $insereTotalHoras = $usuario->insereTotalHoras($id_usuario, '00:00:00');
                 $horasDevendo = $somaHoras;
                 $totalFinalMes = '00:00:00';
                
            }else{
                //insere no campo total horas do usuario
                $insereTotalHoras = $usuario->insereTotalHoras($id_usuario, $somaHoras);
                $horasDevendo = '00:00:00';
                $totalFinalMes = $somaHoras;
            }
        
        
          $sql = "UPDATE banco_horas SET horas_mes = '$horas_mes', devendo = '$horasDevendo', observacao = '$observacao', total_final_mes = '$totalFinalMes' WHERE "
                  . "id_usuario = '$id_usuario' AND id_mes = '$id_mes' AND id_ano = '$id_ano'";
   
          $resultado = mysqli_query($this->con,$sql);
          return $resultado;
        
        
    }
    
    public function alteraHoraMesProx($id_usuario, $id_ano, $id_mes){
        
            $usuario = new Usuario();
            
              $i = $id_mes;
            
            for($i +=1; ; $i++){
            
            
                
            $totalHoras = $this->pesquisaTotalHoraPorUsuarioMesAnt($id_ano, $id_usuario, $i);
            
            if($i == 13){
                $i = 1;
                $id_ano += 1;
            }
            
            $horas_mes = $this->pesquisaHoraMesAtual($id_ano, $i, $id_usuario);
            if($horas_mes == ""){
                break;
            }
            $observacao = $this->pesquisaObservacaoMesAtual($id_ano, $i, $id_usuario);
            var_dump($totalHoras);
            
           
            
           $teste = str_replace("-","", $horas_mes);
            
            if($this->verificaHoraNegativa($horas_mes) && $teste > $totalHoras){
                 $horas_mes = str_replace("-","",$horas_mes);
               $somaHoras = $this->diferencaHoras($totalHoras,$horas_mes);
               var_dump($somaHoras);
             //  $somaHoras = new DateTime($somaHoras);
              //   $somaHoras = date_format($somaHoras, '-H:i:s');
               //  $horas_mes = new DateTime($horas_mes);
              // $horas_mes = date_format($horas_mes, '-H:i:s');
                $somaHoras = "-".$somaHoras;
                $horas_mes = "-".$horas_mes;
               
               
            }else if($horas_mes[0] == "-"){
                $horas_mes = str_replace("-","",$horas_mes);
               $somaHoras = $this->diferencaHoras($horas_mes, $totalHoras);
               $horas_mes = "-".$horas_mes;
            }else{
                  $somaHoras = $this->somarHoras($horas_mes, $totalHoras);
            }
            
           // $somaHoras = $this->somarHoras($horas_mes, $totalHoras);
            var_dump($somaHoras);
            $verificaHoraNegativa = $this->verificaHoraNegativa($somaHoras);
            
            if($verificaHoraNegativa === true){
                
                 $insereTotalHoras = $usuario->insereTotalHoras($id_usuario, '00:00:00');
                 $horasDevendo = $somaHoras;
                 $totalFinalMes = '00:00:00';
                
            }else{
                //insere no campo total horas do usuario
                $insereTotalHoras = $usuario->insereTotalHoras($id_usuario, $somaHoras);
                $horasDevendo = '00:00:00';
                $totalFinalMes = $somaHoras;
            }
        
            var_dump($totalFinalMes);
           
        
          $sql = "UPDATE banco_horas SET total_final_mes = '$totalFinalMes', horas_mes = '$horas_mes', devendo = '$horasDevendo', observacao = '$observacao' WHERE "
                  . "id_usuario = '$id_usuario' AND id_mes = '$i' AND id_ano = '$id_ano'";
        
          print_r($sql);
          $resultado = mysqli_query($this->con,$sql);
          
            }
          return $resultado;
        
        
    }
    
    
    public function verificaHoraNegativa($hora){
        
          $horas = array($hora);
        
          $seconds = 0;
          
          var_dump($hora);
          
          if($hora[0] == '-'){
              return true;
          }
          
            foreach ($horas as $hora) {
                list( $g, $i, $s ) = explode(':', $hora);
                if ($g < 0) {
                    $i *= -1;
                    $s *= -1;
                }
                $seconds += $g * 3600;
                $seconds += $i * 60;
                $seconds += $s;
            }

            $hours = floor($seconds / 3600);
            $seconds -= $hours * 3600;
            $minutes = floor($seconds / 60);
            $seconds -= $minutes * 60;
            $negativo = false;

            if ($hours < 0) {
                $hours = -($hours);
                return true;
                
            }else{
                return false;
            }
            
    }
    
    
    public function addTime($hora1, $hora2){
     
        
         $sql = "SELECT ADDTIME('$hora1','$hora2')";
                $query = mysqli_query($this->con,$sql);
               $resultado = mysqli_fetch_row($query);
               return $resultado[0];
        
    }
    
    
    
    public function contarHorasAteMes($id_ano, $id_mes, $id_usuario){
        
        
          $total = "00:00:00";
        
        $mes = $id_mes;
        $ano = $id_ano;
        
        $valor2 = "00:00:00";
        $valor  = "00:00:00";
        
        
         for($i = 1; $i <= $ano; $i++){
            
              if($i == $ano){
               $sql = "Select time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( horas_mes ) ) ),'%H:%i:%s') FROM banco_horas WHERE id_usuario = '$id_usuario' AND id_ano = '$i' AND id_mes BETWEEN 1 AND '$id_mes'";
               print_r($sql);
               $query = mysqli_query($this->con,$sql);
               $resultado2 = mysqli_fetch_row($query);
               $valor2 = $resultado2[0];
               break;
            }
            
          $sql ="Select time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( horas_mes ) ) ),'%H:%i:%s') FROM banco_horas WHERE id_usuario = '$id_usuario' AND id_ano = '$i' AND id_mes BETWEEN 1 AND 12";
          print_r($sql);
          $query = mysqli_query($this->con,$sql);
             $resultado = mysqli_fetch_row($query);
             $valor = $resultado[0];
             
             
             
             $total = $this->addTime($total,$valor);
           
        }
        
        $total = $this->addTime($total, $valor2);
        
        return $total;
        
    }
    
    public function pesquisaHoraMes($id_ano, $id_mes){
        
        
               
                $sql = "SELECT usu.nome, bh.horas_mes, bh.observacao, usu.id_usuario, bh.id_ano, bh.id_mes
                  FROM banco_horas bh JOIN usuario usu JOIN mes m JOIN ano a
                  ON bh.id_usuario = usu.id_usuario AND bh.id_ano = a.id_ano AND bh.id_mes = m.id_mes
                  WHERE m.id_mes = '$id_mes' AND a.id_ano = '$id_ano'";
               
               print_r($sql); 
          
          $resultado = mysqli_query($this->con,$sql);
          return $resultado;
        
        
    }
    
     public function pesquisaTodasHorasAnoUsuario($id_ano, $id_usuario){
        
          $sql = "SELECT m.descricao,bh.horas_mes, bh.observacao, bh.devendo, bh.id_banco_horas, bh.total_final_mes
                  FROM banco_horas bh JOIN mes m JOIN usuario usu JOIN ano a
                  ON bh.id_usuario = usu.id_usuario AND bh.id_ano = a.id_ano AND bh.id_mes = m.id_mes
                  WHERE usu.id_usuario = '$id_usuario' AND a.id_ano = '$id_ano'";
        
          $resultado = mysqli_query($this->con,$sql);
          return $resultado;
        
        
    }
    
    public function pesquisaTotalHoraPorUsuario($id_ano, $id_usuario){
        
          $sql = "Select TIME_FORMAT(SUM(horas_mes), '%H:%i:%s') as 'Total' FROM banco_horas WHERE id_usuario = '$id_usuario' AND id_ano = '$id_ano' ";
            $query = mysqli_query($this->con,$sql);
           $resultado = mysqli_fetch_row($query);
         return $resultado[0];
        
    }
    
    public function pesquisaHoraMesAtual($id_ano, $id_mes, $id_usuario){
         $sql = "Select horas_mes FROM banco_horas WHERE id_usuario = '$id_usuario' AND id_ano = '$id_ano' AND id_mes = '$id_mes' ";
            $query = mysqli_query($this->con,$sql);
           $resultado = mysqli_fetch_row($query);
         return $resultado[0];
    }
    
    
     public function pesquisaObservacaoMesAtual($id_ano, $id_mes, $id_usuario){
         $sql = "Select observacao FROM banco_horas WHERE id_usuario = '$id_usuario' AND id_ano = '$id_ano' AND id_mes = '$id_mes' ";
            $query = mysqli_query($this->con,$sql);
           $resultado = mysqli_fetch_row($query);
         return $resultado[0];
    }
    
    public function pesquisaTotalHoraPorUsuarioMesAnt($id_ano, $id_usuario, $id_mes){
        
          if($id_ano == 1 && $id_mes == 1 ){
              return "00:00:00";
          }else{
            $mes = $id_mes-1;
            
            if($mes == 0){
                $mes = 12;
                $id_ano -= 1;
            }
            
          $sql = "Select total_final_mes FROM banco_horas WHERE id_usuario = '$id_usuario' AND id_ano = '$id_ano' AND id_mes = '$mes'";
            $query = mysqli_query($this->con,$sql);
           $resultado = mysqli_fetch_row($query);
         return $resultado[0];
          }
    }
    
    public function pesquisaBancoHora($id_banco_hora){
          $sql = "SELECT bh.*, ano.descricao AS 'Ano', mes.descricao, usu.nome, bh.devendo
                  FROM banco_horas bh JOIN usuario usu JOIN ano ano JOIN mes mes
                  ON bh.id_usuario = usu.id_usuario AND bh.id_mes = mes.id_mes AND bh.id_ano = ano.id_ano
                  WHERE bh.id_banco_horas = '$id_banco_hora'";
        
          $resultado = mysqli_query($this->con,$sql);
          return $resultado;
    }
    
    

}

Class Log extends Banco
{
    
    
    public function __construct()
    {
        parent::__construct();
       
    }
    
    
    public function LogCadastro($autor, $msg, $objeto, $objeto2)
    {
     
       
        date_default_timezone_set('America/Sao_Paulo');
        $data = date ("Y-m-d");
        $hora = date('H:i:s');
      
        $sql = "INSERT INTO logs(id, data, hora, autor, acao, mensagem,objeto,objeto2) VALUES(NULL, '$data', '$hora', '$autor', 'cadastrar', '$msg', '$objeto', '$objeto2')";
        $resultado = mysqli_query($this->con,$sql);
	return $resultado;
       
    }
    
    public function LogAlteracao($autor, $msg, $objeto, $objeto_id)
    {
     
       
        date_default_timezone_set('America/Sao_Paulo');
        $data = date ("Y-m-d");
        $hora = date('H:i:s');
      
        $sql = "INSERT INTO logs(id, data, hora, autor, acao, mensagem,objeto,objeto2) VALUES(NULL, '$data', '$hora', '$autor', 'alteracao', '$msg', '$objeto', $objeto_id)";
        $resultado = mysqli_query($this->con,$sql);
	return $resultado;
       
    }
    
    public function LogExclusao($autor, $msg, $objeto, $objeto_id)
    {
     
       
        date_default_timezone_set('America/Sao_Paulo');
        $data = date ("Y-m-d");
        $hora = date('H:i:s');
      
        $sql = "INSERT INTO logs(id, data, hora, autor, acao, mensagem,objeto,objeto2) VALUES(NULL, '$data', '$hora', '$autor', 'exclusao', '$msg', '$objeto', '$objeto_id')";
        $resultado = mysqli_query($this->con,$sql);
	return $resultado;
       
    }
    
     public function LogLogin($autor, $msg, $objeto)
    {
        
       
        date_default_timezone_set('America/Sao_Paulo');
        $data = date ("Y-m-d");
        $hora = date('H:i:s');
        
        
        $sql = "INSERT INTO log(id_log, data, hora, ip, acao, mensagem, objeto, autor) VALUES(NULL, '$data', '$hora', '".getenv("REMOTE_ADDR")."', 'Login', '$msg', '$objeto', '$autor')";
        print_r($sql);
        $resultado = mysqli_query($this->con,$sql) or die(mysqli_error());
       
	return $resultado;
       
    }
}



?>