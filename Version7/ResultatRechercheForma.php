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
        
                <header id="header"> 
        <ul id="nav">
        <li><a href="test2.php">Accueil</a></li>
        <li><a href="#">À propos</a></li>
        </ul>
        </header>




       <div id="macarte"></div>
            <script>
				var carte = L.map('macarte').setView([46.3630104, 2.9846608], 6);
				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(carte); 





 </script>
    

<h1>Les Formations </h1>

<?php
        
        $region = $_POST["Region"] ;
        $niveau = $_POST["niveau"] ;
       $dis = $_POST["discipline"] ;
       $diplome = $_POST["diplome"] ;

 

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
                //~ echo " <form action=\"intermediaire.php\" method=\"get\">";
                 echo " <form action=\"fiche2.php\" method=\"get\">";
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
                 echo "<td><input name=\"uai\"  id=\"coucou\" value=\"$test\" readonly></td>";
                echo "<td><input name=\"sec\"  id=\"coucou\" value=\"$value0\" readonly></td>";
                echo "<td><input name=\"dip\"  id=\"coucou\" value=\"$value1\" readonly></td>";
                echo "<td><input name=\"region\"  id=\"coucou\" value=\"$value2\"readonly></td>";;
                echo "<td><input name=\"etab\"  id=\"coucou\" value=\"$value3\" readonly></td>"; 
                echo "<td>$value4";
				
                //~ if ( $site!="") {
                    echo " <div class=\"form-style-2\">";
                echo "<td> <input name=\"name\" id=\"coucou\" type=\"submit\" value=\"voir plus\"></td>"; 
                echo "</div>" ;
                //~ }
                //~ else { echo "<td>aucun site disponible"; }
             
             
				echo "</tr>";
			
		   
                echo " </form>" ;
                
               
                
                
                
                
                

	   }
       

 
  ?>  
  
  </table>

<h2>>Nombre de résultat(s) : <?php echo  $nb ; ?></h2
<!--
//~ echo "<td>$value4";
	</table>
-->
</html>

  
