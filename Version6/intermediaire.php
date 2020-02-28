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
                    $etab = $_GET['etab'];
                     $diplome = $_GET['dip'];
                     $dis = $_GET['sec'];
                   
                    $reponse = " UPDATE Z_CliqueEtablissement SET clique=clique+1 WHERE url=\"$id\" ";
                    $dbh->exec($reponse);
                    
                    
                     $requete = $dbh->prepare( " SELECT count(libelle) AS nb ,diplome from Z_CliqueFormation where libelle=\"$dis\" AND diplome=\"$diplome\" AND ecole=\"$etab\" ") ;

       

       	$requete->execute();
       	$compter=0;
       	 while ($donnees = $requete->fetch()) {
					$compter = $donnees['nb'] ; }
       	

       	echo "loool = $compter";
       	if ( $compter==0 ) {
       		$action = " INSERT INTO Z_CliqueFormation(Diplome, Libelle, ecole, Clique) VALUES (\"$diplome\",\"$dis\",\"$etab\",1) ";
       			$dbh->exec($action); 
       			//echo "$action";
       	}  else {
       		$action = " UPDATE Z_CliqueFormation SET clique=clique+1 WHERE libelle=\"$dis\" AND diplome=diplome+\"$diplome\" AND ecole=\"$etab\" ";
            $dbh->exec($action);
       	}


                     //if ( $id!="") {
                    //}
                   
                   header("Location: $id");
                   exit(); 
             

                ?>


</body>

</html>
