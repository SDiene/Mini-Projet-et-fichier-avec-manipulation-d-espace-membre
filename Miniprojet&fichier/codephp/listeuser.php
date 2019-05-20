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
    <title class="titre">Liste des utilisateurs</title>
    <link rel="stylesheet" href="../codecss/main.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap//js/bootstrap.min.js">
</head>
<body>
<!-- Notre menu -->
    <?php
        include("menuadmin.php");
    ?>
    <?php
    echo "<table class='table1'>";
    $montab = fopen("login.txt" ,"r");

    echo "<tr><th>NOM</th><th>LOGIN</th><th>MOT DE PASSE</th><th>ADRESSE</th><th>TELEPHONE</th><th>STATUT</th><th>Autorisation</th></tr>";
    while (!feof($montab)) {
        $ligne=trim(fgets($montab));
        $col=explode(",", $ligne);
        echo "<tr><td>$col[0]</td><td>$col[1]</td><td>$col[2]</td><td>$col[3]</td><td>$col[4]</td><td>$col[5]</td>

        <td>
        <a id=".$col[1]." href='traitement.php?login=$col[1] '>
        <button class=";
        if ($col[6]=='actif') {
            echo"vert";
        }
        elseif ($col[6]=='inactif') {
            echo"Bgdanger";
        }
            echo">

        $col[6]</button></a>
        </td>

        </tr>";

    }
    fclose($montab);
    echo "</table>";
    ?>


</body>
</html>
