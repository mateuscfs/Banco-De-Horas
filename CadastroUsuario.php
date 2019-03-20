<?php
include ("Menu.php");

$usuario = new Usuario();

if(isset($_POST["Cadastrar"])){
    
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $data_admissao = $_POST["data_admissao"];
    $id_empresa = $_POST["empresa"];
    
    $cadastrarUsu = $usuario->insereUsuario($id_empresa, $email, $cpf, $nome, $data_admissao);
    
    if($cadastrarUsu){
        echo "Usuario cadastrado com sucesso";
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

</head>

<body>

    <form action="CadastroUsuario.php" method="post">
  <h2>Cadastro de Usuário</h2>
		<p>
			<label for="nome" class="floatLabel">Usuário</label>
			<input id="nome" name="nome" type="text">
		</p>
                <p>
			<label for="email" class="floatLabel">Email</label>
                        <input id="email" name="email" type="email">
		</p>
                
                 <p>
			<label for="cpf" class="floatLabel">CPF</label>
                        <input id="cpf" name="cpf" type="text">
		</p>
                  <p>
			<label for="data_admissao" class="floatLabel">Admissão</label>
                        <input id="data_admissao" name="data_admissao" type="date">
		</p>
		<p>
			<label class="floatLabel">Empresa</label>
			<select id="empresa" name="empresa">
				<option value="1">
					BRASID
				</option>
			</select>
		</p>
		<p>
                    <input type="submit" value="Cadastrar" name="Cadastrar" class="btn btn-success btn-lg" id="submit">
		</p>
	</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

</body>
</html>
