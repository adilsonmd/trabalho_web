<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <meta charset="UTF-8" />
		<title>Listar funcionários - RH</title>
        <link type="text/css" rel="stylesheet" href="css/estilo.css" />
	</head>

	<body>
    
	<div align="center">
        <h1>Listar funcionários</h1>
        <?php
		//session_start();
        $azureServer = "br-cdbr-azure-south-b.cloudapp.net";
        $azureUser = "be848e08403198";
        $azurePass = "59847d85";
        
		$conecta = mysql_connect($azureServer, $azureUser, $azurePass) or die ('Não foi possível conectar: ' . mysql_error());

		if($conecta) {
			$banco = mysql_select_db("bd_rh", $conecta) or die ('Não foi possível selecionar o banco: ' . mysql_error());;

			$txt = "SELECT cd_func, nm_func, email_func, tel_func FROM tb_emp;";

			$query = mysql_query ($txt, $conecta) or die ('Não foi possivel realizar query: '. mysql_error());

            if(mysql_num_rows($query) <= 0){
                echo "<h3>Funcionários não encontrados</h3><br>";
                echo "Ao invés disso, <a href='incluir.php'>Cadastrar funcionário</a>";
            }
            else {
                function excluir($cod) {
                    $txt = "DELETE FROM tb_emp; where cd_func = $cod";
                    $del = mysql_query($txt, $conecta);
                }
                
                echo '<table><tr><th>Nome</th><th>Email</th><th>Telefone</th></tr>';
                while($row = mysql_fetch_assoc($query))
                {
                    echo '<tr><td>'.$row['nm_func'] . '</td>';
                    echo '<td>'.$row['email_func'].'</td>';
                    echo '<td>'.$row['tel_func'].'</td>'
                    echo '<td><button onclick="excluir('.$row['cd_func'].');">Excluir</button><td></tr>';
                                    
                }
                echo '</table>';
            }

            mysql_free_result($query);
        }

        mysql_close($conecta);
	?>
    <p><a href="home.php">Retornar</a></p>
	</div>

	</body>
</html>