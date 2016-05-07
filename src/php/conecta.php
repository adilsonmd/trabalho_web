	<?php
		//session_start();
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
	?>