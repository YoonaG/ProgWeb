<html>
	<head>
	<title>Projet PHP </title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.29" />
    <link rel="stylesheet" type="text/css" href="ResultatStyle.css"> 
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
    </head>

	
    <body>
		
		
		
        <header id="header"> 
        <ul id="nav">
        <li><a href="test2.php">Accueil</a></li>
        <li><a href="#">À propos</a></li>
        </ul>
        </header>



   
    <div id="gauche"> 

                   <div id="macarte"></div>
            <script>
				var carte = L.map('macarte').setView([46.3630104, 2.9846608], 6);
				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
				}).addTo(carte); 





 </script>
-->

</div>
            

        

        

        
       
    <div id="droite"> 
      <h2> La formation  </h2>
  <?php 
        include("connexion.php");
                
            $id = $_GET['name'];
                    $etab = $_GET['etab'];
                    $diplome = $_GET['dip'];
                    $dis = $_GET['sec'];
                    $identifiant = $_GET['uai'];
                    
                    $requete = $dbh->prepare( " SELECT count(libelle) AS nb ,diplome from Z_CliqueFormation where libelle=\"$dis\" AND diplome=\"$diplome\" ") ;

       

       //~	$requete->execute();
       //~	$compter=0;
       //~ while ($donnees = $requete->fetch()) {
				//~	$compter = $donnees['nb'] ; }
       	

      //~ 	if ( $compter==0 ) {
       //~		$action = " INSERT INTO Z_CliqueFormation(Diplome, Libelle, Clique) VALUES (\"$diplome\",\"$dis\",1) ";
       	//~		$dbh->exec($action); 
       			//echo "$action";
      //~ 	}  else {
       //~		$action = " UPDATE Z_CliqueFormation SET clique=clique+1 WHERE libelle=\"$dis\" AND diplome=diplome+\"$diplome\"   ";
      //~      $dbh->exec($action);
     //~  	}

         $requete->execute();
         $compter=0;
          while ($donnees = $requete->fetch()) {
           $compter = $donnees['nb'] ; }
        

         echo "loool = $compter";
         if ( $compter==0 ) {
           $action = " INSERT INTO Z_CliqueFormation(Diplome, Libelle, ecole, Clique) VALUES (\"$diplome\",\"$dis\",\"$etab\",1) ";
             $dbh->exec($action); 
             echo "$action";
         }  else {
          $action = " UPDATE Z_CliqueFormation SET clique=clique+1 WHERE libelle=\"$dis\" AND diplome=\"$diplome\" AND ecole=\"$etab\" ";
             $dbh->exec($action);
         }



                    
        $s="https://data.enseignementsup-recherche.gouv.fr";
        $lien =  "$s/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=10&sort=-rentree_lib&facet=diplome_lib&facet=niveau_lib&facet=sect_disciplinaire_lib&facet=etablissement&refine.rentree_lib=2017-18&refine.diplome_lib=$diplome&refine.sect_disciplinaire_lib=$dis&refine.etablissement=$identifiant";
        $json  = file_get_contents("$lien");
        $data = json_decode($json, true);
        $i = 0 ;
        $facet_fil = $data["records"][0]["fields"] ;
        
        //~ $nb = count($data["records"]) ;
    
        $value4 = $data["records"][0]["fields"]["dep_etab_lib"] ;

        $value2 = $data["records"][0]["fields"]["effectif_total"] ;
        $value3 = $data["records"][0]["fields"]["etablissement_lib"] ;
        $value0 = $data["records"][0]["fields"]["sect_disciplinaire_lib"] ;
        $value5 = $data["records"][0]["fields"]["discipline_lib"] ;
                
        
        echo " $value4  $value2 $value3 $value0 $value5 ";
        
        $lien2= "$s/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&sort=uo_lib&facet=uai&refine.uai=$identifiant";
        $json2  = file_get_contents("$lien2");
        $data2 = json_decode($json2, true);
        $nb2 = count($data2["records"]);
				
        echo $nb2 ;
				
        if ( $nb2 >=1) {
            $site = $data2["records"][0]["fields"]["url"]  ;
            $facet_fil2 = $data2["records"][0]["fields"]["coordonnees"]  ;
            echo "<script>" ;
			
            echo "L.marker([$facet_fil2[0], $facet_fil2[1]]).addTo(carte).bindPopup(' $value3 ').openPopup();";
				
            echo " </script>  ";
        } else { $site ="";}
              
        $type = $data2["records"][0]["fields"]["type_d_etablissement"] ;
        $ville = $data2["records"][0]["fields"]["com_nom"] ;
   


                    $requete = $dbh->prepare( " SELECT count(libelle) AS nb ,diplome from Z_CliqueFormation where libelle=\"$dis\" AND diplome=\"$diplome\" ") ;
             
                     
          

        echo" <table> 
                <tr id=\"lignePair\" > 
                    <td>diplome</td>
                    <td>$diplome</td>
                </tr>
                <tr id=\"ligneImpair\"> 
                    <td>Secteur</td>
                    <td>$dis</td>
                </tr>
                
                <tr id=\"lignePair\"> 
                    <td>Secteur plus détaillé</td>
                    <td>$value5</td>
                </tr>
                <tr id=\"ligneImpair\"> 
                    <td>Ecole </td>
                    <td>$etab</td>
                </tr>
                <tr id=\"lignePair\"> 
                    <td>Ville</td>
                    <td>$ville</td>
                </tr>
               
   
                <tr id=\"ligneImpair\"> 
                    <td>effectifs</td>
                    <td>$value2</td>
                </tr>
                <tr id=\"lignePair\">  
                 <form action=\"intermediaire.php\" method=\"get\">;
                    <td>Site</td>
                    <td> <input name=\"name\" id=\"coucou\" type=\"submit\" value=\"$site\"></td>; 
                    </form>
                </tr>
                <tr id=\"ligneImpair\"> 
                    <td>Type d'etablissement</td>
                    <td>$type</td>
                </tr>
                
                
                
        
        </table>" ;

        
                     
                      //~ echo " $id $etab $diplome $dis  ";s
                   
                    //~ $reponse = " UPDATE Z_CliqueEtablissement SET clique=clique+1 WHERE url=\"$id\" ";
                     //~$dbh->exec($reponse);
                    
                    


              
                     $reponse = $dbh->prepare( " SELECT clique AS nb  from Z_CliqueFormation where libelle=\"$dis\" AND diplome=\"$diplome\" AND ecole=\"$etab\" ") ;
                     $reponse->execute();

                while ($donnees = $reponse->fetch()) {
                  
                     $memory = $donnees['nb'] ;
                     
                    echo "   <h1> Nombre de vus de la formation  : $memory </h1> " ; }

       
   

       	//~ $requete->execute();
       	//~ $compter=0;
       	 //~ while ($donnees = $requete->fetch()) {
					//~ $compter = $donnees['nb'] ; }
       	

       	//~ echo "loool = $compter";
       	//~ if ( $compter==0 ) {
       		//~ $action = " INSERT INTO Z_CliqueFormation(Diplome, Libelle, ecole, Clique) VALUES (\"$diplome\",\"$dis\",\"$etab\",1) ";
       			//~ $dbh->exec($action); 
       			//~ //echo "$action";
       	//~ }  else {
       		//~ $action = " UPDATE Z_CliqueFormation SET clique=clique+1 WHERE libelle=\"$dis\" AND diplome=diplome+\"$diplome\" AND ecole=\"$etab\" ";
            //~ $dbh->exec($action);
       	//~ }


                     //if ( $id!="") {
                    //}
                   
                   //~ header("Location: $id");
                  
             

                ?>
                  
        


	</div>









    </body>
</html>