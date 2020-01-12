<html>
	<head>
	<title>Projet PHP </title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.29" />
    <link rel="stylesheet" type="text/css" href="test.css"> 
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



        <div id="gauche" > 
           <p style=" margin-left:2%;"> Affiner Votre Recherche :  </p>
            
             <form action="Resultat.php" method="get" class="form-example"  >
               Diplome :  <br />  <br /> 
        <select name="Filiere" id="Filiere-select">
            <option value="">--Type de diplome--</option>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="hamster">Hamster</option>
            <option value="parrot">Parrot</option>
            <option value="spider">Spider</option>
            <option value="goldfish">Goldfish</option>
        </select>
        
             <br />  <br /> Département  :  <br />  <br /> 
        <select name="Filiere" id="Filiere-select">
            <option value="">--Type de diplome--</option>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="hamster">Hamster</option>
            <option value="parrot">Parrot</option>
            <option value="spider">Spider</option>
            <option value="goldfish">Goldfish</option>
        </select>
        
            </form>
        
            
        </div>
        
        <div id="contenu">
        
            <div id="macarte"></div>
            <script>var carte = L.map('macarte').setView([46.3630104, 2.9846608], 6);
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(carte);  </script>
        
       
   
        
     <div id="cadre" > </div>
         
           <?php 
       $region = $_GET["Region"] ;
       echo " coucou $region ";
       $niveau = $_GET["niveau"] ;
       $dis = $_GET["discipline"] ;
       $fil = $_GET["discipline"] ;
       $diplome = $_GET["Filiere"] ;
    echo " coucou $niveau  ";
       
         $s="https://data.enseignementsup-recherche.gouv.fr";

        $lien =  "$s/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=10&sort=-rentree_lib&facet=diplome_lib&facet=niveau_lib&facet=sect_disciplinaire_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18&refine.diplome_lib=$diplome&refine.niveau_lib=$niveau&refine.sect_disciplinaire_lib=$dis&refine.reg_etab_lib=$region";
         echo " $lien " ;
    
    
        $json  = file_get_contents("$lien");
        $data = json_decode($json, true);
        $i = 0 ;
        //~ $facet_fil = $data["records"][3]["fields"]["dep_etab"] ;
        $facet_fil = $data["records"][0]["fields"] ;
        
        $nb = count($data["records"]) ;
        
        echo "Le tableau contient ".$nb."éléments";
        //~ echo " $facet_fil ";
      
       
      for($y = 0; $y < $nb  ; ++$y) {
		   $value = $data["records"][$y]["fields"]["dep_etab"] ;
		   echo  " $value ";
		   $value2 = $data["records"][$i]["fields"]["typ_diplome"] ;
		   echo  " $value2 ";
		   
		   
	   }
       
        //~ foreach ( $facet_fil  as $value ) {
            //~ if ( i<10 ) {
            //~ $value = $data["records"][$i]["fields"]["dep_etab"] ;
            //~ $value2 = $data["records"][$i]["fields"]["typ_diplome"] ;
            //~ echo  " $value ";
            //~ print" <br>";
            //~ print " $i " ;
            //~ $i += 1; }
            //~ else {
                //~ break ; }
            //~ }     
      
      ?>   
         
<!--
<table>
  <tr>
    <td>Nom</td>
    <td>Prénom</td>
    <td>Age</td>
    <td>Mail</td>
  </tr>
  <tr>
    <td>Giraud</td>
    <td>Pierre</td>
    <td></td>
    <td>pierre.giraud@edhec.com</td>
  </tr>
  <tr>
    <td>Joly</td>
    <td>Pauline</td>
    <td>27</td>
  </tr>
</table>
</div>

     <div id="cadre" > 
<table>
  <tr>
    <td>Nom</td>
    <td>Prénom</td>
    <td>Age</td>
    <td>Mail</td>
  </tr>
  <tr>
    <td>Giraud</td>
    <td>Pierre</td>
    <td></td>
    <td>pierre.giraud@edhec.com</td>
  </tr>
  <tr>
    <td>Joly</td>
    <td>Pauline</td>
    <td>27</td>
  </tr>
</table>
-->


        
        
        
        
        </div>




             <?php 
       $niveau = $_GET["Region"] ;
       echo " coucou $niveau  ";
       
       ?>




    <footer id="footer" role="contentinfo"></footer>
    </body>
</html>
