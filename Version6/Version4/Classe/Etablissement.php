<?php
// Nous créons une classe « Personnage ».
class Etablissement
{
    
  private $_id;
  private $_nom;
  private $_nbClique;

    public function __construct($id, $nom) // Constructeur demandant 2 paramètres

  {

    echo 'Voici le constructeur !'; // Message s'affichant une fois que tout objet est créé.

    $this->_id=$id; // Initialisation de la force.

    $this->_nom=$nom; // Initialisation des dégâts.


  }
        
  // Nous déclarons une méthode dont le seul but est d'afficher un texte.
  public function parler()
  {
    echo 'Je suis un établissement !';
  }

    public function getiD()
  {
    echo $this->_id ;
  }
  

  
}
 
?>

