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
      <?php include("connexion.php") ;?>
        
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
      
         $s="https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=20&sort=-rentree_lib&apikey=b4689f3aa47f8eb3112aeb07ef6e27ebfd3ca4169fc16459e0b205f9";

        if ( $niveau == "" && $diplome=="") {
           $lien =  "$s&facet=diplome_lib&facet=niveau_lib&facet=sect_disciplinaire_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18&refine.sect_disciplinaire_lib=$dis&refine.reg_etab_lib=$region&apikey=b4689f3aa47f8eb3112aeb07ef6e27ebfd3ca4169fc16459e0b205f9";
        }

        elseif ($niveau == "") {
           $lien =  "$s&facet=diplome_lib&facet=niveau_lib&facet=sect_disciplinaire_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18&refine.diplome_lib=$diplome&refine.sect_disciplinaire_lib=$dis&refine.reg_etab_lib=$region&apikey=b4689f3aa47f8eb3112aeb07ef6e27ebfd3ca4169fc16459e0b205f9";     
        }

        elseif ( $diplome== "") {
          $lien =  "$s&facet=diplome_lib&facet=niveau_lib&facet=sect_disciplinaire_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18&refine.niveau_lib=$niveau&refine.sect_disciplinaire_lib=$dis&refine.reg_etab_lib=$region&apikey=b4689f3aa47f8eb3112aeb07ef6e27ebfd3ca4169fc16459e0b205f9"; }
        else {
        $lien =  "$s&facet=diplome_lib&facet=niveau_lib&facet=sect_disciplinaire_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18&refine.diplome_lib=$diplome&refine.niveau_lib=$niveau&refine.sect_disciplinaire_lib=$dis&refine.reg_etab_lib=$region&apikey=b4689f3aa47f8eb3112aeb07ef6e27ebfd3ca4169fc16459e0b205f9"; }
               
        $json  = file_get_contents("$lien");
        $data = json_decode($json, true);
        $i = 0 ;
        $facet_fil = $data["records"][0]["fields"] ;     
        $nb = count($data["records"]) ;

        ?>

         <table>
           <caption>Les formations</caption>
           <tr> 
                <td> code ecole </td>
                <td> Secteur </td> 
                <td> Diplôme </td> 
                <td> effectifs </td> 
                <td> établissement </td> 
                <td> Département </td>
             
                <td> + d'infos </td> 
         
           </tr> 
      
      <?php

      for($y = 0; $y <$nb  ; ++$y) {
          $test = $data["records"][$y]["fields"]["etablissement"] ;
          $value4 = $data["records"][$y]["fields"]["dep_etab_lib"] ;
          $value1 = $data["records"][$y]["fields"]["diplome_lib"] ;
          $value2 = $data["records"][$y]["fields"]["effectif_total"] ;
          $value3 = $data["records"][$y]["fields"]["etablissement_lib"] ;
          $value0 = $data["records"][$y]["fields"]["sect_disciplinaire_lib"] ;      
          $s2="https://data.enseignementsup-recherche.gouv.fr";   
          $lien2= "$s2/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&sort=uo_lib&facet=uai&refine.uai=$test&apikey=b4689f3aa47f8eb3112aeb07ef6e27ebfd3ca4169fc16459e0b205f9";
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

           echo " <form action=fiche2.php method=get>";
               
             if ( $y%2==0 ) { 
                echo "<tr class=lignePair >   "; }
            else { 
               echo "<tr class=ligneImpair>  "; }
          
            echo "<td><input name=\"uai\"  class=\"coucou\" value=\"$test\" readonly></td>";
            echo "<td><input name=\"sec\"  class=\"coucou\" value=\"$value0\" readonly></td>";
            echo "<td><input name=\"dip\"  class=\"coucou\" value=\"$value1\" readonly></td>";
            echo "<td><input name=\"region\"  class=\"coucou\" value=\"$value2\"readonly></td>";
            echo "<td><input name=\"etab\"  class=\"coucou\" value=\"$value3\" readonly></td>"; 
            echo "<td>$value4";
            echo " <div class=\"form-style-2\">";
            echo "<td> <input name=\"name\" class=coucou type=\"submit\" value=\"voir plus\"></td>"; 

          echo "</div>" ;
           
             
             
        echo "</tr>";
      
       
      echo " </form>" ;
                
  
     }
       

 
  ?>  
  
  </table>

<h2>>Nombre de résultat(s) : <?php echo  $nb ; ?></h2

</html>

  