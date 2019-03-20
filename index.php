<?php

session_start();
include("./Classes/classes.php");

$log = new Log();

      

if (isset($_POST["entrar"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $usu = new Usuario();
   

    $verificaLogin = $usu->VerificaLogin($email, $senha);
    $id = $verificaLogin;
    

       

    if ($id > 0) {
        
         @$_SESSION["id_usuario"] = $id;
       
        $nomeLogado = $usu->pesquisaNome($id);
         $_SESSION["nome_logado"] = $nomeLogado;
        $logLoginSucesso = $log->LogLogin($nomeLogado, "Logado com sucesso", "ID login:$id");
        $ultimoLoginData = $usu->ultimoLoginDataHora($id);

        header("location: home.php");
    } else {

        $logLoginErro = $log->LogLogin("desconhecido", "Erro ao fazer login", 'IP:' . getenv("REMOTE_ADDR") . '');

        echo"<script>alert('Email ou Senha incorretos!')</script>";
    }
}
//}
//if (isset($_POST["redefinirSenha"])) {
//    $usuario = new Usuario();
//    $login = new Login();
//
//    $verificaCPF = $usuario->VerificaCNPJ($_POST["cnpj"]);
//
//    $login_id = $verificaCPF;
//
//    $alteraSenhaUsu = $usuario->AlteraSenhaUsu($_POST["cadSenha2"], $login_id);
//    $alteraSenhaLogin = $login->AlteraSenhaLogin($_POST["cadSenha2"], $login_id);
//
//    if ($alteraSenhaLogin && $alteraSenhaUsu) {
//        echo"<script>alert('Senhas Alteradas, Faça Login!')</script>";
//    } else
//        echo"<script>alert('Nenhum usuario encontrado com esse CNPJ!')</script>";
//}

?>

   
   <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
           <link rel="icon" type="image/ico" href="uploads/sistema/favicon.ico" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!--        <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script async  src="CSS/bootstrap/js/bootstrap.min.js"></script>
     
        
       <link rel="stylesheet" type="text/css" href="CSS/estilos.css" />
       
        <title>BANCO-DE-HORAS</title>
    </head>

<body>




    <div class="container-fluid" >
         <fieldset>
       

             <form class="form-horizontal" role="form" method="post" action="index.php" >
            
         <div style="margin-top: 10%; margin-left: 10% ">
              <legend>Entrar</legend>
            <div class="form-group">
                <label class="control-label col-md-2" for="email">Email:</label>
                <div class="col-md-5">
                    <input type="email" class="form-control input-md" name = "email" id="email" placeholder="Informe seu email" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Senha:</label>
                <div class="col-md-5">
                    <input type="password" class="form-control input-md" name = "senha" id="pwd" placeholder="Informe sua senha" required>
                </div>
            </div>
         
<!--            <div class="form-group"> 
                 <label class="control-label col-sm-2" for="pwd"></label>
                 <div class="col-md-5">
             <div class="g-recaptcha" data-sitekey="6LeCSgoUAAAAAPeKPJYUY7THRopPTKpNGvCEHRxO"></div>
            <script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
                 </div>
            </div>-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name = "entrar" class="btn btn-success btn-md">Entrar</button>
<!--                    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#esquecisenha">Esqueci a Senha!</button>-->
                </div>
            </div>
         </div>
        </form>
</fieldset>
        <!-- Modal que aparece ao clicar em esqueceu a senha?-->
        <div class="modal fade" id="esquecisenha" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">X</button>
                        <h4 class="modal-title">Esqueci a Senha</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal posicao" role="form" method="post" action="login.php">
                            <div class="form-group">
                                <label class="control-label col-md-4" for="cpf">Cnpj:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name = "cnpj" id="name" placeholder="Informe seu cnpj">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="pwd">Senha:</label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name = "cadSenha1" id="pwd" placeholder="Informe sua senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="pwd">Senha Novamente:</label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name = "cadSenha2" id="pwd" placeholder="Informe sua senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn btn-info btn-md" name = "redefinirSenha" >Redefinir Senha</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>

                </div>
            </div>

        </div>

        
       
<!--    </div>-->
    </div>
      



</body>
</html>
   <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css"/>