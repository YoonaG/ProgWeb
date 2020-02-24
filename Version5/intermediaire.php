<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>SM2H</title>
    <link rel="stylesheet" href="style/style.css">

</head>

<body>
	
				<?php 
                include("connexion.php");
                
                    $id = $_GET['name'];
                    echo " $id ";

                   
                    $reponse = " UPDATE Z_CliqueEtablissement SET clique=clique+1 WHERE url=\"$id\" ";
                    $dbh->exec($reponse);


                     //if ( $id!="") {
                    //}
                   
                   header("Location: $id");
                   exit(); 
             

                ?>


</body>

</html>
