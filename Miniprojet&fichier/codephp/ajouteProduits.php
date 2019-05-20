<?php
session_start();
if(!isset($_SESSION["profil"])){
    header("location: authentification.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../codecss/main.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap//js/bootstrap.min.js">
        <title>AJOUTER</title>
    </head>
<body>
    <?php
        include('menu.php');
    ?>
    <h1 class="title">Ajouter un produit</h1>
    <form action="ajouteProduits.php" method="POST" class="form-horizontal col-lg-6" id="form1">

        <div class="row">
            <div class="form-group" id="login" id="login">
                <label for="produit" class="col-lg-2"></label>
                <div class="col-lg-10">
                    <input type="text" name="produit" id="ajout" value="<?php if (isset($_POST['envoyer'])) {echo $_POST['produit'];} ?>" class="form-control" placeholder="Produit" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" id="password">
                <label for="Quantite" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="number" name="quantite" id="ajout" value="<?php if (isset($_POST['envoyer'])) {echo $_POST['quantite'];} ?>" class="form-control" placeholder="Quantité" required>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group" id="password">
                <label for="Prix Unitaire" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="number" name="prix-unitaire" id="ajout" value="<?php if(isset($_POST['envoyer'])) {echo $_POST['prix-unitaire'];} ?>" class="form-control" placeholder="Prix Unitaire" required>
                    </div>
            </div>
        </div>
        <div class="form-group" id="send">
            <button class="pull-right btn btn-default" name="envoyer">
               <p>Ajouter</p>
            </button>
        </div>
    </form>
 <?php
if(isset($_POST['envoyer'])){
    $produit=$_POST['produit'];
    $quantite=$_POST['quantite'];
    $prix_unitaire=$_POST['prix-unitaire'];
    $montant=$_POST['quantite']*$_POST['prix-unitaire'];

    $montab = fopen("table.txt","r");
    $trouve=false;

    while ($text=fgets($montab)) {
    $ligne=explode(':',$text);
        if (strcasecmp($produit,$ligne[0])==0) {
            $trouve=true;
            echo "<h6 class='title'>Ce produit existe déja</h6>";
        }
    }
fclose($montab);

$montab = fopen("table.txt","a+");
   if ($trouve==false && !empty($quantite) && !empty($prix_unitaire)) {
    fwrite($montab,"\n".$produit.":".$quantite.":".$prix_unitaire.":".$montant.":");
    }
fclose($montab);
}
$montab=fopen("table.txt", "r");
    echo "<table class='table1'>";
    echo "<tr><th>PRODUITS</th><th>PRIX UNITAIRE</th><th>QUANTITE</th><th>MONTANT</th></tr>";
    while($text=fgets($montab))
    {
        $ligne=explode(":",$text);
        if ($ligne[2]<10) {
            echo "<tr class='rouge'>
                    <td>$ligne[0]</td>
                    <td>$ligne[1]</td>
                    <td>$ligne[2]</td>
                    <td>$ligne[3]</td>
                </tr>";
      }else{
        echo "<tr>
        <td>$ligne[0]</td>
        <td>$ligne[1]</td>
        <td>$ligne[2]</td>
        <td>$ligne[3]</td>
        </tr>";
      }

    }

    echo "</table>";
    fclose($montab);

?>

</body>
</html>
