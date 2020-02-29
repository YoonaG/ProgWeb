<?php include("connexion.php") ;?>
<html>
	<head>
	<title>FormaSearch</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.29" />
    <link rel="stylesheet" type="text/css" href="Forma.css"> 
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
    </head>

	
    <body>




       <div id="macarte"></div>
            <script>
				var carte = L.map('macarte').setView([46.3630104, 2.9846608], 6);
				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(carte); 





 </script>
    


<?php
        
        $region = $_POST["Region"] ;
        $niveau = $_POST["niveau"] ;
       $dis = $_POST["discipline"] ;
       $diplome = $_POST["diplome"] ;

 $requete = $dbh->prepare( " SELECT count(libelle) AS nb ,diplome from Z_CliqueFormation where libelle=\"$dis\" AND diplome=\"$diplome\" ") ;

       

       	$requete->execute();
       	$compter=0;
       	 while ($donnees = $requete->fetch()) {
					$compter = $donnees['nb'] ; }
       	

       	echo "loool = $compter";
       	if ( $compter==0 ) {
       		$action = " INSERT INTO Z_CliqueFormation(Diplome, Libelle, Clique) VALUES (\"$diplome\",\"$dis\",1) ";
       			$dbh->exec($action); 
       			//echo "$action";
       	}  else {
       		$action = " UPDATE Z_CliqueFormation SET clique=clique+1 WHERE libelle=\"$dis\" AND diplome=diplome+\"$diplome\"  ";
            $dbh->exec($action);
       	}

        echo " $niveau ";
        echo " $dis ";
       echo " $diplome ";
        echo " coucou $region ";
       
       
         $s="https://data.enseignementsup-recherche.gouv.fr";

        $lien =  "$s/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=10&sort=-rentree_lib&facet=diplome_lib&facet=niveau_lib&facet=sect_disciplinaire_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18&refine.diplome_lib=$diplome&refine.niveau_lib=$niveau&refine.sect_disciplinaire_lib=$dis&refine.reg_etab_lib=$region";
               
        $json  = file_get_contents("$lien");
        
          //~ $json = file_get_contents("./base.json");
        $data = json_decode($json, true);
        $i = 0 ;
        //~ $facet_fil = $data["records"][3]["fields"]["dep_etab"] ;
        $facet_fil = $data["records"][0]["fields"] ;
        
        $nb = count($data["records"]) ;
        
        //~ echo "Le tableau contient ".$nb."éléments";
        //~ echo " $facet_fil ";
      
      echo" <table >";
			echo "<caption>Les formations<caption>";
			echo" <tr> ";
              echo "<thead> " ;
				echo "	<td> Secteur </td> " ;
				echo "	<td> Diplôme </td> " ;
				echo "	<td> effectifs </td> " ;
				echo "	<td> établissement </td> " ;
				echo "	<td> Département </td> " ;
				echo "	<td> Site </td> " ;	
                echo "	<td> + d'info </td> " ;
                echo "</thead> " ;	
			echo " </tr> " ;
       
			for($y = 0; $y <$nb  ; ++$y) {
                echo " <form action=\"intermediaire.php\" method=\"get\">";
				$test = $data["records"][$y]["fields"]["etablissement"] ;
				$value4 = $data["records"][$y]["fields"]["dep_etab_lib"] ;
				$value1 = $data["records"][$y]["fields"]["diplome_lib"] ;
				$value2 = $data["records"][$y]["fields"]["effectif_total"] ;
				$value3 = $data["records"][$y]["fields"]["etablissement_lib"] ;
				$value0 = $data["records"][$y]["fields"]["sect_disciplinaire_lib"] ;
			
			
			
				$lien2= "$s/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&sort=uo_lib&facet=uai&refine.uai=$test";
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
               
                if ( $y%2==0 ) { 
					echo "<tr id=\"lignePair\" >  "; }
                else { 
					echo "<tr id=\"ligneImPair\" > "; }
				echo "<td>$value0";
				echo "<td>$value1";
				echo "<td>$value2";
				echo "<td>$value3";
				echo "<td>$value4";
                echo "<td>$site";
                echo "<td> <input name=\"name\" id=\"$site\" type=\"submit\" value=\"$site\">coucpi </td>";
             
				echo "</tr>";
			
		   
                echo " </form>" ;
	   }
       

 
  ?>  
  
  </table>

Nombre de résultat(s) : <?php echo  $nb ; ?>
<!--
	</table>
-->
</html>

  
