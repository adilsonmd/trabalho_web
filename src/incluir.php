<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <meta charset="UTF-8"/>
		<title>Incluir funcionário - RH</title>
        <link type="text/css" rel="stylesheet" href="css/estilo.css" />
	</head>

	<body>
    <?php
    
        function cadastrar() {
            //session_start();
            $nome = $_POST['txtLogin'];
            $email = $_POST['txtEmail'];
            $tel = $_POST['txtTel'];
            $pass = $_POST['txtSenha'];
            
            $azureServer = "br-cdbr-azure-south-b.cloudapp.net";
            $azureUser = "be848e08403198";
            $azurePass = "59847d85";
            
            $conecta = mysql_connect($azureServer, $azureUser, $azurePass) or die ('Não foi possível conectar: ' . mysql_error());

            if($conecta) {
                $banco = mysql_select_db("bd_rh", $conecta) or die ('Não foi possível selecionar o banco: ' . mysql_error());;
                
                if($nome != "" || $email != "" || $tel != "" || $pass != "") {
                    $txt = "INSERT INTO tb_emp (nm_func, email_func, tel_func, senha_func) ".
                        "VALUES ('$nome', '$email', '$tel', '$pass');";

                    $query = mysql_query ($txt, $conecta) or die ('Não foi possivel realizar query: '. mysql_error());

                    if(mysql_affected_rows > 0){
                        echo "<h3>Cadastro realizado</h3>";
                        echo '$query';
                    }

                    mysql_free_result($query);
                }
            }

            mysql_close($conecta);
        }
	?>
    
	<div align="center">
        <h1>Cadastrar funcionário</h1>
		<form method="POST" action="" onsubmit="<?php cadastrar(); ?>">
			<input type="text" name="txtLogin" placeholder="Nome do funcionário" /> <br>
            <input type="text" name="txtEmail" placeholder="Email do funcionário" /> <br>
            <input type="text" name="txtTel" placeholder="Telefone do funcionário" /> <br>
			<input id="senhaInput" type="password" name="txtSenha" placeholder="Senha do funcionário" /> <br>
            
			<input type="submit" value="Entrar" />
			<br>
		</form>
	</div>
    

	</body>
</html>