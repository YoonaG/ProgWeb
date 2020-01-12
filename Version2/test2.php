

<html>
	<head>
	<title>Projet PHP </title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.29" />
    <link rel="stylesheet" type="text/css" href="test.css">
</head>

	
  <body>
    <header id="header"> 
    
    <ul id="nav">
	<li><a href="#">Accueil</a></li>
	<li><a href="#">À propos</a></li>

</ul>
    
    
    
    </header>
    
<!--
<div style="padding:2px; width:70%; height:20%x; margin-top: 2%; margin-left: 20%; border:8px solid  #97DFC6; -moz-border-radius:20px;">
<p align="center"><img src="Avenir.png"  width="300" height="150"> 
<p>Trouvez votre formation dans le supérieur avec Avenir Plus ! </p>
</div>
    
-->








<p>
	<div style="padding:5px;width:70%; height:40%; background-color:#DCDCDC; border:2px solid #000010; -moz-border-radius:9px; -khtml-border-radius:9px; -webkit-border-radius:9px; border-radius:9px; margin-left: 20%;">
    <div style="padding: 4px; float: left; width: 10px; margin-right: 5px; height: 20px;margin-left: 30%;">

    <p style=" text-align:left;">
        <form action="Resultat2.php" method="get" class="form-example"  id="monForm">
    
        
<p>
        
        Niveau scolaire:
        <select name="niveau" id="niveau-select">
            <option value="">--Choisissez un niveau --</option>
        
            
                   <?php
          
                /* Récupération du contenu du fichier .json */
               
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
    
    
         Votre Région :
        <select name="Region" id="Regon-select">
            <option value="">--Région--</option>
                   <?php
          
                /* Récupération du contenu du fichier .json */
               
                $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=reg_etab_lib&refine.rentree_lib=2017-18");
                $data = json_decode($json, true);
                $facet_dep = $data["facet_groups"][0]["facets"] ;
                
                 foreach ( $facet_dep  as $value ) {
                     $val = $value["name"] ;
                    
                    
                     echo  "<option value=\"$val\">$val</option> ";

                     }

 ?>
            
            

        </select>    
        
        <p>   
        
        Votre filière :
        <select name="Filiere" id="Filiere-select">
            <option value="">--Choisissez un type de diplome --</option>
        
            
                   <?php
          
                /* Récupération du contenu du fichier .json */
               
                $json  = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=0&sort=-rentree_lib&facet=diplome_lib&refine.rentree_lib=2017-18");
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

<!--
     <select name="Localité" id="Localite-select">
         
            Votre discipline:
-->
        Votre discipline :
        <select name="discipline" id="discipline-select">
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
<!--
<p class="centrer">
  Cette ligne sera centrée.<br>
  Ainsi que cette ligne.
</p>
-->

</form>
</div>
</div>
<!--
    </div>
-->
    <footer id="footer" role="contentinfo"></footer>
  </body>
</html>
