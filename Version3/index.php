  

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
<?php 
                $reponse = $dbh->prepare('SELECT DISTINCT(`Rentrée universitaire`) FROM `Ecole`');
               $reponse->execute();
                while ($donnees = $reponse->fetch()) {
                   echo   $donnees['Rentrée universitaire'] ;
                }


?>
    
  
    
        <form method="post" action="ResultatRechercheForma.php"  class="form-example"  id="monForm">
       
    
        
    <p>
        
        
        Niveau scolaire: <select name="niveau" >
            <option value="">--Choisissez un niveau --</option>
            <?php 
                $reponse = $dbh->prepare('SELECT DISTINCT(`Niveau dans le diplôme`) AS niveau FROM `Ecole`');
               $reponse->execute();
                while ($donnees = $reponse->fetch()) {
                    $val = $donnees['niveau'] ;
                   echo  "<option value=\"$val\">$val</option> ";
                }


            ?>

    </select> 
    
     </p>
     
      <p>

        Domaine d'activité :
        <select name="discipline" id="discipline-select">
            <option value="">--Choisissez un domaine --</option>
             <?php 
                $reponse = $dbh->prepare('SELECT DISTINCT(`Secteur disciplinaire`) AS discipline FROM `Ecole`');
               $reponse->execute();
                while ($donnees = $reponse->fetch()) {
                    $val = $donnees['discipline'] ;
                   echo  "<option value=\"$val\">$val</option> ";
                }


            ?>
        </select>

   </p>
   
   
   <p>

        Diplome :
        <select name="diplome" id="diplome-select">
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
        <input type="submit" value="Envoyer"> 
        <INPUT TYPE="reset" NAME="Renitialiser" VALUE="Rénitialiser">

 </p>
     

        
        </form>




  </body>

</html>

<!--
background: linear-gradient(to top, #ffffcc 0%, #99ffcc 100%);
-->
