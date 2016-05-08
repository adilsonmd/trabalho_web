<html>
    <head>
        <meta charset="UTF-8" />
        <title>Excluir funcionários - RH</title>
    </head>
    <body>
        <form method="POST" onsubmit="<?php
           
            $azureServer = "br-cdbr-azure-south-b.cloudapp.net";
            $azureUser = "be848e08403198";
            $azurePass = "59847d85";
        
		    $conecta = mysql_connect($azureServer, $azureUser, $azurePass) or die ('Não foi possível conectar: '. mysql_error());      
        
            if($conecta) {
                $banco = mysql_select_db("bd_rh", $conecta) or die ('Não foi possível selecionar o banco: '. mysql_error());  
            
                $cmd = "DELETE FROM tb_emp WHERE cd_func = ". $cod;
                $del = mysql_query($cmd, $conecta) or die ('Erro na query excluir: '. mysql_error());
                debug_to_console($del);  //para encontrar erros escondidos  
            }
        ?>">
        
        <input type="submit" value="Excluir"
        </form>
    </body>
</html>