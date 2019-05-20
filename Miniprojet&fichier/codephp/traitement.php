<?php

$login=$_GET['login'];
$vide="";
$montab=fopen("login.txt", "r");
while ($ligne=fgets($montab)) {
    //$ligne=fgets($montab);
    $col=explode(",", $ligne);
    if ($login==$col[1]) {
        if ($col[6]=='actif') {

            $col[6]='inactif';
            
        }
        else {
            $col[6]='actif';
        }
    }
    $rempli=$col[0].",".$col[1].",".$col[2].",".$col[3].",".$col[4].",".$col[5].",".$col[6].",\n";
    $vide=$vide.$rempli;
    }
fclose($montab);
$montab=fopen('login.txt', "w+"); // ouvrir un nouveau fichier nommé login1.txt
fputs($montab,trim($vide));
fclose($montab);
header("location:listeuser.php#$login");

?>