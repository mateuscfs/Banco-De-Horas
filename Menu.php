<?php
include ("Classes/Classes.php");
session_set_cookie_params(time()+60*60*24*30);

session_start();



if (!isset($_SESSION["id_usuario"])) {
    header("location:login.php");
}



?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/ico" href="uploads/sistema/favicon.ico" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Banco-Horas" />

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- Jquery -->

         <script  src="JavaScript/jquery-3.2.1.min.js"></script>
         
        <!-- BOOTSTRAP -->

        <script  src="CSS/bootstrap/js/bootstrap.min.js"></script>
         <link href="CSS/bootstrap/css/bootstrap.min.css" rel="stylesheet">

         <link rel='stylesheet' href='CSS/estilos.css' />

         

         <!-- DATE PICKER -->
        <script src="CSS/DatePicker/js/bootstrap-datepicker.min.js"></script>
        <link rel='stylesheet' href='CSS/DatePicker/css/bootstrap-datepicker3.min.css' />

        <script src="CSS/DatePicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>

      

        <!-- DATA TABLE -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.16/sorting/date-uk.js"></script>
        <script  type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script  type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>
        <script  type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.0/js/responsive.bootstrap.min.js"></script>



        <script async type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script async type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script async  type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script async  type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script async type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script async  type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script async  type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <link  async rel='stylesheet' type="text/css" href='https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css' />
        <link  async rel='stylesheet' type="text/css" href='https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css' />
        <link  async rel='stylesheet' type="text/css" href='https://cdn.datatables.net/responsive/2.2.0/css/responsive.bootstrap.min.css' />

         
   
        
    </head>

   
         
       
<div class="navbar navbar-default " role="navigation" style="">
    <div class="container"> 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a target="_blank" href="#" class="navbar-brand"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

             </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle dp" data-toggle="dropdown" style="">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong><?php echo $_SESSION["nome_logado"] ?></strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
<!--                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-5">
                                       
                                            <div class="useravatar"><img src=""></div>
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        
                                        <p class="text-left"> <?php ?> <a href="" class="btn btn-primary btn-block btn-sm">Meu Perfil</a> </p>
                                        <p class="text-left"> <a href="alterarMinhaConta" class="btn btn-success btn-block btn-sm">Minha Conta</a></p>
                                    </div>
                                </div>
                            </div>
                        </li>-->
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <p>
                                            <a href="logout" class="btn btn-danger btn-block">Sair</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
    
<div class="nav-side-menu" style="">
    <div class="brand"><img class="preload-me" src="" ></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="home">
                  <i class="fa fa-dashboard fa-fw"></i> Painel
                  </a>
                </li>

                
    
                
                
                <li data-toggle="collapse" data-target="#banco" class="collapsed"><a href="#"><i class="fa fa-handshake-o fa-fw"></i> Banco de Horas <span class="arrow"></span></a></li>
                    <ul class="sub-menu collapse" id="banco">
                       <li><a href="CadastroUsuario">Cadastrar Usuário</a></li>
                       <li><a href="CadastroHoras">Cadastrar Horas</a></li>
                         <li><a href="VisualizarMes">Visualizar Horas Por Mês</a></li>
                       <li><a href="VisualizarHorasUsuario">Visualizar Horas Por Usuário</a></li>
                             
                     </ul>
                
             
                     
                     
               
            </ul>
     </div>
</div>
      
   

    
</html>
<script src="https://use.fontawesome.com/64d1370222.js"></script>
