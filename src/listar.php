<?php 
//essa função é só pra testes, pra saber quais erros estavam ocorrendo
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
//-----------
include("inc_conn.php");
?>
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
                
        $azureServer = "br-cdbr-azure-south-b.cloudapp.net";
        $azureUser = "be848e08403198";
        $azurePass = "59847d85";
        
		$conecta = mysql_connect($azureServer, $azureUser, $azurePass) or die ('Não foi possível conectar: '. mysql_error());      
        
        if($conecta) {
            $banco = mysql_select_db("bd_rh", $conecta) or die ('Não foi possível selecionar o banco: '. mysql_error());
               
            $txt = "SELECT * FROM tb_emp;";
            $query = mysql_query ($txt, $conecta) or die ('Não foi possivel realizar query: '. mysql_error());
            
            if(mysql_num_rows($query) <= 0){
                echo "<h3>Funcionários não encontrados</h3><br>";
                echo "Ao invés disso, <a href='incluir.php'>Cadastrar funcionário</a>";
            }
            
            else {  
                ?>
                <form method="POST" action="" onsubmit="<?php excluir($row['cd_func'])?>">
                <table>
                    <tr><th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>
                <?php
                while($row = mysql_fetch_assoc($query))
                {
                    
                    echo '<tr><td>' .$row['nm_func']. '</td>';
                    echo '<td>' .$row['email_func']. '</td>';
                    echo '<td>' .$row['tel_func']. '</td>';
                    echo '<td><input type="submit" id="'.$row["cd_func"].'" value="Excluir />';
                        
                    echo '<td></tr>';
                                    
                }
                echo '</table>';
                echo '</form>';
            }
            mysql_free_result($query);
            
            function excluir($cod) {
                $cmd = "DELETE FROM tb_emp WHERE cd_func = ". $cod;
                $del = mysql_query($cmd, $conecta) or die ('Erro na query excluir: '. mysql_error());
                debug_to_console($del);
            }
        }
        mysql_close($conecta);
	   ?>
    
        <p><a href="home.php">Retornar</a></p>
	   </div>

	</body>
</html>