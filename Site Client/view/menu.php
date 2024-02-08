<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="image/LOGO.png" sizes="256x256">
    <link rel="stylesheet" type="text/css" href="view/css/menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Passion+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="view/css/footer.css"> 
    <title>HeyPizza</title>
</head>
<body>
    <nav>
        <a href="routeur.php?action=displayAbout">Accueil</a>
        
        <!-- Modified "Nos Pizzas" link with a dropdown -->
        <div class="dropdown">
            <a href="#" class="dropbtn">Nos Pizzas</a>
            <div class="dropdown-content">
                <a href="routeur.php?action=displayAll">Toutes les Pizzas</a>
                <a href="routeur.php?action=displayVegan">Pizzas Vegan  <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M476.188,24.146c-6.748-3.504-60.728,38.022-185.304,67.086C230.347,105.355,62.5,153.527,65.286,392.815 L0,431.218l20.338,35.598c63.073-40.692,236.014-120.042,409.766-323.621c0,0-26.875,134.419-334.096,311.056 c103.685,53.758,249.604,53.758,360.979-76.806C568.346,246.888,476.188,24.146,476.188,24.146z"></path> </g> </g></svg></a>
            </div>
        </div>
        
        <img src="image/LOGO.png" alt="LOGO" class="logo">
        <a href="routeur.php?action=displayProduit">Autres Produits</a>
        <a href="routeur.php?action=displayPanier">Votre Panier</a>
    </nav>
    <?php include 'footer.php'; ?>
</body>
</html>
