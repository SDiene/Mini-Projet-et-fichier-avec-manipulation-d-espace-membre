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
    <title>RECHERCHE</title>
</head>
<body>
    <?php
        include('menu.php');
    ?>
    <h1 class="title">Rechercher un produit</h1>
    <form action="rechercheProduits.php" method="POST" class="form-horizontal col-lg-6" id="form1">

        <div class="row">
            <div class="form-group" id="login" id="login">
                <label for="Quantite" class="col-lg-2"></label>
                <div class="col-lg-10">
                    <input type="number" name="quantite" id="ajout" value="<?php if(isset($_POST['envoyer'])) {echo $_POST['quantite'];} ?>" class="form-control" placeholder="Quantité">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" id="password">
                <label for="prixMin" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="number" name="prixMin" id="ajout" value="<?php if(isset($_POST['envoyer'])) {echo $_POST['prixMin'];} ?>" class="form-control" placeholder="Prix min">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group" id="password">
                <label for="prixMax" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="number" name="prixMax" id="ajout" value="<?php if(isset($_POST['envoyer'])) {echo $_POST['prixMax'];} ?>" class="form-control" placeholder="Prix max">
                    </div>
            </div>
        </div>
        <div class="form-group" id="send">
            <button class="pull-right btn btn-default" name="envoyer">
               <p>Rechercher</p>
            </button>
        </div>
    </form>
<?php

if (isset($_POST['envoyer'])) {
  $qte = $_POST['quantite'];
  $pmax = $_POST['prixMax'];
  $pmin = $_POST['prixMin'];
    $search = fopen("table.txt", "r");
    echo "<table class = 'table'>";
    echo "<tr><th>PRODUITS</th><th>PRIX UNITAIRE</th><th>QUANTITE</th><th>MONTANT</th></tr>";
    while ($text=fgets($search)) {
        $ligne=explode(":", $text);
        $ligne[3]=$ligne[1]*$ligne[2];
        if ($qte >= $ligne[2] && $qte !="" && $pmax == "" && $pmin == "" && $qte>0) {
            if ($ligne[2]<10) {
                echo "<tr class='rouge'><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            } else {
                echo "<tr><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            }
        }
        elseif ($pmin <= $ligne[1] && $pmax == "" && $pmin !="" && $qte == "" && $pmin > 0){
            if ($ligne[2]<10) {
                echo "<tr class='rouge'><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            } else {
                echo "<tr><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            }
        }
        elseif(($pmax <= $ligne[1] && $pmin == "" && $qte == "" && $pmax > 0)){
            if ($ligne[2]<10) {
                echo "<tr class='rouge'><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            } else {
                echo "<tr><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            }
        }
        elseif($pmin <= $ligne[1] && $pmax >= $ligne[1] && $pmax > $pmin && $pmax != "" && $pmin != "" && $qte == "" && $pmin > 0 && $pmin > 0){
            if ($ligne[2]<10) {
                echo "<tr class='rouge'><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            } else {
                echo "<tr><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            }
        }
        elseif($qte <= $ligne[2] && $pmin <= $ligne[1] && $pmax >= $ligne[1] && $pmax > $pmin && $pmax != "" && $pmin != "" && $qte != "" && $pmin > 0 && $pmin > 0 && $qte > 0){
            if ($ligne[2]<10) {
                echo "<tr class='rouge'><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            } else {
                echo "<tr><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td></tr>";
            }
        }
    }
    echo"</table>";
    fclose($search);
}
?>

    </table>

</body>
</html>
