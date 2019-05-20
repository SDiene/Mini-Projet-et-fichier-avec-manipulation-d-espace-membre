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
    <title>MODIFIER</title>
</head>
<body>
    <?php
        include('menu.php');
    ?>
    <h1 class="title">Modifier un produit</h1>
    <form action="updateProduits.php" method="POST" class="form-horizontal col-lg-6" id="form1">

        <div class="row">
            <div class="form-group" id="login" id="login">
                <label for="produit" class="col-lg-2"></label>
                <div class="col-lg-10">
                    <input type="text" name="produit" id="ajout" value="<?php if(isset($_POST['envoyer'])){echo $_POST['produit'];}  ?>" class="form-control" placeholder="Produit">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" id="password">
                <label for="Quantite" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="text" name="quantite" id="ajout" value="<?php if(isset($_POST['envoyer'])) {echo $_POST['quantite'];} ?>" class="form-control" placeholder="Quantité">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group" id="password">
                <label for="Prix Unitaire" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="text" name="prix-unitaire" id="ajout" value="<?php if(isset($_POST['envoyer'])) {echo $_POST['prix-unitaire'];} ?>" class="form-control" placeholder="Prix Unitaire">
                    </div>
            </div>
        </div>
        <div class="form-group" id="send">
            <button class="pull-right btn btn-default" name="envoyer">
               <p>Modifier</p>
            </button>
        </div>
    </form>
<?php
if (isset($_POST['envoyer'])) {
  $pro = $_POST["produit"];
  $qte = $_POST["quantite"];
  $prix = $_POST["prix-unitaire"];
  $produits = fopen("table.txt", "r");
  $newligne="";
    while (!feof($produits)) {
        $ligne = fgets($produits);
        $col = explode(":", $ligne);
        if($pro==$col[0]){
            $col[1]=$qte;
            $col[2]=$prix;
            $modif=$pro.":".$qte.":".$prix.":";
        }
        else{
            $modif=$ligne;
        }
        $newligne.=$modif;
    }
    fclose($produits);
    $prod=fopen("table.txt","w+");
    fwrite($prod,$newligne);
    fclose($prod);
}

    $liste=fopen("table.txt", "r");
        echo "<table class='table1'>";
        echo "<tr><th>PRODUITS</th><th>PRIX UNITAIRE</th><th>QUANTITE</th><th>MONTANT</th></tr>";
        while ($text=fgets($liste)) {
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
</body>
</html>
