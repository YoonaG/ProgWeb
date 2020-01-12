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
        
<!--
     <div id="cadre" > </div>
-->
       

       
         
           <?php 
       $region = $_GET["Region"] ;
       //~ echo " coucou $region ";
       $niveau = $_GET["niveau"] ;
       $dis = $_GET["discipline"] ;
       $fil = $_GET["discipline"] ;
       $diplome = $_GET["Filiere"] ;
    //~ echo " coucou $niveau  ";
       
         $s="https://data.enseignementsup-recherche.gouv.fr";

        $lien =  "$s/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=10&sort=-rentree_lib&facet=diplome_lib&facet=niveau_lib&facet=sect_disciplinaire_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18&refine.diplome_lib=$diplome&refine.niveau_lib=$niveau&refine.sect_disciplinaire_lib=$dis&refine.reg_etab_lib=$region";
         //~ echo " $lien " ;
		
    
        $json  = file_get_contents("$lien");
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
				echo "	<td> Secteur </td> " ;
				echo "	<td> Diplôme </td> " ;
				echo "	<td> effectifs </td> " ;
				echo "	<td> établissement </td> " ;
				echo "	<td> Département </td> " ;
				echo "	<td> Site </td> " ;		
			echo " </tr> " ;
       
			for($y = 0; $y < $nb  ; ++$y) {
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
				
			
				if ( $nb2 >=1) {
					$site = $data2["records"][0]["fields"]["url"]  ;
					$facet_fil2 = $data2["records"][0]["fields"]["coordonnees"]  ;
					echo "<script>" ;
			
						echo "L.marker([$facet_fil2[0], $facet_fil2[1]]).addTo(carte).bindPopup(' $value3 ').openPopup();";
				
				echo " </script>  ";
			  } else { $site ="";}
			
				echo "<tr> ";
				echo "<td>$value0</td>";
				echo "<td>$value1</td>";
				echo "<td>$value2</td>";
				echo "<td>$value3</td>";
				echo "<td>$value4</td>";
				echo "<td>$site</td>";
				echo "</tr>";
			
		   
		   
	   }
	   
	   echo "</table>";
          
      
      ?>   
         


	</div>







<!--
    <footer id="footer" role="contentinfo"></footer>
-->
    </body>
</html>
