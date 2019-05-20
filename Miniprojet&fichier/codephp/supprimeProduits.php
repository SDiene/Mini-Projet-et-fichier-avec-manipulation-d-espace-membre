<?php
session_start();
if(!isset($_SESSION["profil"])){
    header("location: authentification.php");
}
?>
<!DOCTYPE html>
<html lang="en-fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../codecss/main.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap//js/bootstrap.min.js">
        <title>SUPPRIMER</title>
    </head>
<body>
    <?php
        include('menu.php');
    ?>
    <h1 class="title">Supprimer un produit</h1>
    <form action="supprimeProduits.php" method="POST" class="form-horizontal col-lg-6" id="form1">

        <div class="row">
            <div class="form-group" id="login" id="login">
                <label name="produit" class="col-lg-2"></label>
                <div class="col-lg-10">
                    <input type="text" name="produit" id="ajout" value="<?php if(isset($_POST['envoyer'])) {echo $_POST['produit'];} ?>" class="form-control" placeholder="Produit">
                </div>
            </div>
        </div>
        <div class="form-group" id="send">
            <button class="pull-right btn btn-default" name="envoyer">
               <p>Supprimer</p>
            </button>
        </div>
    </form>
<?php

if (isset($_POST['envoyer'])) {
  $pro = $_POST["produit"];
  $newligne="";
  $produits = fopen("table.txt", "r");
    while (!feof($produits)) {
      $ligne = fgets($produits);
        $col = explode(":", $ligne);
        if($col[0]==$pro){
            $sup="";
        }
        else{
            $sup=$ligne;
        }
      $newligne=$newligne.$sup; 
    }
    fclose($produits);
    $prod=fopen("table.txt","w+");
    fwrite($prod, trim($newligne));
    fclose($prod);
}
    $liste=fopen("table.txt", "r");
        echo "<table class='table1'>";
        echo "<tr><th>PRODUITS</th><th>PRIX UNITAIRE</th><th>QUANTITE</th><th>MONTANT</th></tr>";
        while ($text=fgets($liste)) {
            //$text=fgets($liste);
            $ligne=explode(":", $text);
            $ligne[3]=$ligne[1]*$ligne[2];
            if ($ligne[2]<10) {
                echo "<tr class='rouge'><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            }
            else {
                echo "<tr><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            }
        }
        echo "</table>";
    fclose($liste);
    ?>


</table>
</body>
</html>
