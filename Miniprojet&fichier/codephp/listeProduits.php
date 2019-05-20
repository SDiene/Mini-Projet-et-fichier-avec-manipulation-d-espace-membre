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
    <title class="titre">LISTE PRODUIT</title>
    <link rel="stylesheet" href="../codecss/main.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap//js/bootstrap.min.js">
</head>
<body>
    <?php
        include('menu.php');
    ?>   <br> <br>
    <?php
        $liste=fopen("table.txt", "r");
            echo "<table class='table1'>";
            echo "<tr><th>PRODUITS</th><th>PRIX UNITAIRE</th><th>QUANTITE</th><th>MONTANT</th></tr>";
            while ($text=fgets($liste)) {
                $ligne=explode(":",$text);
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