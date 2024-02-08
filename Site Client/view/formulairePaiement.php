<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="view/css/formPaiement.css">
  </head>
  <body>
    <div id="container">
      <div id="form-container">
        <h3>INFORMATIONS BANCAIRES</h3>
        <form action="routeur.php" method="post">
          <div>
            <label for="nomTitulaire">Nom du titulaire : </label>
            <input type="text" id="nomTitulaire" name="nomTitulaire" placeholder="Nom du titulaire..." required>
          </div>
          <div>
            <label for="numeroCarte">Numéro de carte : </label>
            <input type="text" id="numeroCarte" name="numeroCarte" placeholder="Numéro de carte..." required>
          </div>
          <div>
            <label for="dateExpiration">Date d'expiration : </label>
            <input type="text" id="dateExpiration" name="dateExpiration" placeholder="MM/AA" required>
          </div>
          <div>
            <label for="codeSecurite">Code de sécurité : </label>
            <input type="text" id="codeSecurite" name="codeSecurite" placeholder="Code de sécurité..." required>
          </div>
          <div id="btnValider">
            <input type="submit" id="boutonEnvoyer" name="boutonEnvoyer" value="Valider">
          </div>          
        </form>
      </div>
    </div>
  </body>
</html>
