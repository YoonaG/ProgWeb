  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>FormaSarch</title>
	<meta charset="utf-8" />
	<meta name="generator" content="Geany 1.29" />
     <link rel="stylesheet" type="text/css" href="Forma.css">
</head>

<body>
	coucou 
<?php include("connexion.php") ;?>

mdr
<?php echo "lol ";?>

    
  
    
        <form method="post" action="ResultatRechercheForma.php"  class="form-example"  id="monForm">
       
    
        
    <p>
        
        
        Niveau scolaire: <select name="niveau" >
            <option value="">--Choisissez un niveau --</option>
            <?php 
                $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=niveau_lib&refine.rentree_lib=2017-18");
            
                $data = json_decode($json, true);
                $facet_fil = $data["facet_groups"][0]["facets"] ;
                
                 foreach ( $facet_fil  as $value ) {
                     $val = $value["name"] ;
                     echo  "<option value=\"$val\">$val</option> ";
                }


            ?>

    </select> 
    
     </p>
     
      <p>

        Région :
        <select name="Region">
            <option value="">--Choisissez une région --</option>
             <?php 
                 
                $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18");
                $data = json_decode($json, true);
                $facet_dep = $data["facet_groups"][0]["facets"] ;
                
                 foreach ( $facet_dep  as $value ) {
                     $val = $value["name"] ;
                     echo  "<option value=\"$val\">$val</option> ";

                     }

            ?>
        </select>

   </p>
   
   
   <p>

        Diplome :
        <select name="diplome">
            <option value="">--Choisissez un diplome --</option>
             <?php 
                $reponse = $dbh->prepare('SELECT DISTINCT(`Regroupement de diplômes`) AS dip FROM `Ecole` ORDER BY `Ecole`.`Regroupement de diplômes` ASC ');
               $reponse->execute();
                while ($donnees = $reponse->fetch()) {
                    $val = $donnees['dip'] ;
                   echo  "<option value=\"$val\">$val</option> ";
                }


            ?>
        </select>

   </p>
   
   
      <p>

<!--
     <select name="Localité" id="Localite-select">
         
            Votre discipline:
-->
        Votre discipline :
        <select name="discipline">
            <option value="">--Choisissez une discipline --</option>
        
            
                   <?php
          
                /* Récupération du contenu du fichier .json */
               
                $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=sect_disciplinaire_lib&refine.rentree_lib=2017-18");
                $data = json_decode($json, true);
                $facet_fil = $data["facet_groups"][0]["facets"] ;
                
                 foreach ( $facet_fil  as $value ) {
                     $val = $value["name"] ;
                    
                    
                     echo  "<option value=\"$val\">$val</option> ";

                     }

 ?>
        </select>

   </p>
   
   
   <p>
        <input type="submit" value="Envoyer"> 
        <INPUT TYPE="reset" NAME="Renitialiser" VALUE="Rénitialiser">

 </p>
     

        
        </form>

<?php
include("./Classe/Etablissement.php") ;
$perso = new Etablissement("coucou","lol");
$perso->getID();
?>


<table >
    <caption>Les établissements les plus visités<caption>
        <tr>
            <thead> 
                <td> Site  </td>
                    <td> Nb </td>
            </thead>
        </tr>
            <?php

                $reponse = $dbh->prepare('SELECT url , clique FROM `Z_CliqueEtablissement`  ORDER BY clique DESC LIMIT 5 ');
               $reponse->execute();
                while ($donnees = $reponse->fetch()) {
                    $url = $donnees['url'] ;
                    $clique = $donnees['clique'] ;
                   echo  "<tr>" ;
                   echo "<td> $url ";
                   echo "<td> $clique ";
                   echo  "</tr>" ;
                }

                ?>
</table>

<table >
    <caption>Les Formations les plus visitées<caption>
        <tr>
            <thead> 
                <td> Diplome  </td>
                <td> discipline </td>
                <td> clique </td>
            </thead>
        </tr>
            <?php

                $reponse = $dbh->prepare('SELECT Diplome , libelle ,clique FROM `Z_CliqueFormation`  ORDER BY clique DESC LIMIT 5 ');
               $reponse->execute();
                while ($donnees = $reponse->fetch()) {
                    $dip = $donnees['Diplome'] ;
                    $clique = $donnees['clique'] ;
                    $lib = $donnees['libelle'] ;
                   echo  "<tr>" ;
                   echo "<td> $dip ";
                   echo "<td> $lib ";
                   echo "<td> $clique ";
                   echo  "</tr>" ;
                }

                ?>
                 </table>







  </body>

</html>

<!--
background: linear-gradient(to top, #ffffcc 0%, #99ffcc 100%);
-->
