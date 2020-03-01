  

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
  
  <img src="banderole.jpg" alt="Photo de montagne" height="30%" width="100%" ></img>
  
<?php include("connexion.php") ;?>

 <header id="header"> 
        <ul id="nav">
        <li><a href="index.php">Accueil</a></li>
       
        </ul>
        </header>


    
  
    
        <form method="post" action="ResultatRechercheForma.php"  class="form-example"  id="monForm">
       
    
        
    <p>
        
        
        Niveau scolaire: <select name="niveau" >
            <option value="">--Choisissez un niveau --</option>
            <?php 
                $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=niveau_lib&refine.rentree_lib=2017-18&apikey=16e8b45ccecc1e608ca8ba44e75ec93a88bbcee0b5e3266528ad3f4b");
            
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

        Région(*) :
        <select name="Region" required>
            
             <?php 
                 
                $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18&apikey=16e8b45ccecc1e608ca8ba44e75ec93a88bbcee0b5e3266528ad3f4b");
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
                       $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=diplome_lib&refine.rentree_lib=2017-18&apikey=16e8b45ccecc1e608ca8ba44e75ec93a88bbcee0b5e3266528ad3f4b");
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

        Votre discipline(*) :
        <select name="discipline" required>
           
        
            
                   <?php
          
                /* Récupération du contenu du fichier .json */
               
                $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=sect_disciplinaire_lib&refine.rentree_lib=2017-18&apikey=16e8b45ccecc1e608ca8ba44e75ec93a88bbcee0b5e3266528ad3f4b");
                $data = json_decode($json, true);
                $facet_fil = $data["facet_groups"][0]["facets"] ;
                
                 foreach ( $facet_fil  as $value ) {
                     $val = $value["name"] ;
                    
                    
                     echo  "<option value=\"$val\">$val</option> ";

                     }

 ?>
        </select>  ;

      

   </p>
   
   
   <p>
        <input type="submit" value="Envoyer"></input> 
        <input type="reset" name="Renitialiser" value="Rénitialiser"></input> 

 </p>
     

        
        </form>  
       

         <h1> Classement </h1> 

              <div class="imageCentre">
                  <img alt="" src="2.png"  height="100px" width="10%"></img>
                     <img alt="" src="1.png"  height="150px" width="10%"></img>
                  <img alt="" src="3.png"  height="100px" width="10%"></img>
    

                  </div>






 <div>
  <h2> Les sites les plus visités </h2> 


            <?php
                $y=0;
                $reponse = $dbh->prepare('SELECT url , clique FROM `Z_CliqueEtablissement` where url!="" ORDER BY clique DESC LIMIT 4 ');
               $reponse->execute();
                

                while ($donnees = $reponse->fetch()) {
                    $url = $donnees['url'] ;
                    $clique = $donnees['clique'] ;
 

                    if ($y==1) {

                      echo "<div id=\"gauche\"> " ;
                      echo " <div id=\"text-chiffre\">$clique  </div> " ;
                         echo " <div id=\"text-normal\">$url </div> " ;


                      echo " </div> " ; }

                          elseif ($y==0) {
                            # code...
                          
                       echo "<div id=\"centre\"> " ;
                       echo " <div id=\"text-chiffre\">$clique  </div> " ;
                         echo " <div id=\"text-normal\">$url </div> " ;
                      echo " </div> " ; }

                      elseif ( $y==2) {
                        echo "<div id=\"droite\"> " ;
                        echo " <div id=\"text-chiffre\">$clique  </div> " ;
                        echo " <div id=\"text-normal\">$url </div> " ;
                        echo " </div> " ;


                      }

                      $y+=1;


                }


                ?>
              </div>
              

  <div>
    <h2> Les formations les plus visitées </h2> 

            <?php
                $i = 0 ;
                $reponse = $dbh->prepare('SELECT Diplome , libelle ,clique,ecole FROM `Z_CliqueFormation` where libelle!="" ORDER BY clique DESC LIMIT 4 ');
               $reponse->execute();
                while ($donnees = $reponse->fetch()) {
                    $dip = $donnees['Diplome'] ;
                    $clique = $donnees['clique'] ;
                    $lib = $donnees['libelle'] ;
                    $ec = $donnees['ecole'] ;
                    if ($i==1) {
                   
                      echo "<div id=\"gauche\"> " ;
                      echo " <div id=\"text-chiffre\">$clique  </div> " ;
                      echo " <div id=\"text-normal\">$dip $lib $ec </div> " ;
                      echo " </div> " ;
                    }
                 
                   elseif ( $i==0)  {
                    echo "<div id=\"centre\"> " ;
                    echo " <div id=\"text-chiffre\">$clique  </div> " ;
                    echo " <div id=\"text-normal\">$dip $lib $ec </div> " ;
                    echo " </div> " ; }
                 
                  elseif ( $i==2) {
                        echo " <div id=\"droite\"> " ;
                        echo " <div id=\"text-chiffre\">$clique  </div> " ;
                        echo " <div id=\"text-normal\">$dip $lib $ec </div> " ;
                        echo " </div> " ; }
                 
                   $i+=1 ;
                }

                ?>
  </div>



  </body>

</html>
