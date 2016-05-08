<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <meta charset="UTF-8" />
		<title>Login - RH</title>
        <link type="text/css" rel="stylesheet" href="css/estilo.css" />
	</head>

	<body>
    	<?php
		//session_start();
        function logar(){
            $user = $_POST['txtLogin'];
            $pass = $_POST['txtSenha'];

            $azureServer = "br-cdbr-azure-south-b.cloudapp.net";
            $azureUser = "be848e08403198";
            $azurePass = "59847d85";
            
            $conecta = mysql_connect($azureServer, $azureUser, $azurePass) or die ('Não foi possível conectar: ' . mysql_error());

            if($conecta) {
                $banco = mysql_select_db("bd_rh", $conecta) or die ('Não foi possível selecionar o banco: ' . mysql_error());;

                $txt = "SELECT nm_func, senha_func FROM tb_emp WHERE nm_func = '$user' AND senha_func = '$pass';";

                $query = mysql_query ($txt, $conecta) or die ('Não foi possivel realizar query: '. mysql_error());

                if(mysql_num_rows($query) <= 0){
                    echo "Nao foi possivel logar<br>";
                    echo "<a href='login.php'>Tentar novamente</a>";
                }

                mysql_free_result($query);
            }

            mysql_close($conecta);
        };
	?>
    
	<div align="center">
        <h1>Entrar com um funcionário</h1>
		<form method="POST" action="home.php" onsubmit="<?php logar(); ?>">
			<input type="text" name="txtLogin" placeholder="Nome de usuário" /> <br>

			<input type="password" name="txtSenha" placeholder="Senha" /> <br>

			<input type="submit" value="Entrar" />
			<br>
		</form>
	</div>

	</body>
</html>