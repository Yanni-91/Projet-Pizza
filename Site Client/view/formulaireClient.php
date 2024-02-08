<?php
require_once('controller/controllerClient.php');
require_once('controller/controllerHandler.php');
require_once('controller/controllerCommande.php');
require_once('controller/ControllerComprendre.php');
require_once("model/commande.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="view/css/formClient.css">
  </head>
  <body>
    <h3>VOS INFORMATIONS</h3>
    <form action="" method="post">
      <div>
        <label for="prenom">prenom : </label>
        <input type="text" name="prenom" placeholder="votre prénom..." required>
      </div>
      <div>
        <label for="nom">nom : </label>
        <input type="text" name="nom" placeholder="votre nom..." required>
      </div>
      <div>
        <label for="adresse">adresse : </label>
        <input type="text" name="adresse" placeholder="votre adresse..." required>
      </div>
      <div>
        <label for="telephone">telephone : </label>
        <input type="text" name="telephone" placeholder="votre telephone..." required>
      </div>      
      <div class="btnValider">
        <input type="submit" name="boutonEnvoyer" value="valider">
      </div>          
    </form>
  </body>
</html>
