<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en-fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../codecss/main.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap//js/bootstrap.min.js">
        <title>Authentification</title>
    </head>

<body class="Bgauth1"> <br>
    <form action="authentification.php" method="POST" class="form-horizontal col-lg-6" id="form">
        <div class="form-group" id="legend" >
            <legend>Se connecter</legend>
        </div>

        <div class="row">
            <div class="form-group" id="login">
                <label for="login" class="col-lg-2"></label>
                <div class="col-lg-10">
                    <input type="text" name="login" id="write" value="<?php if (isset($_POST['envoyer'])) {echo $_POST['login'];} ?>" class="form-control" placeholder="Username" required/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" id="password">
                <label for="pwd" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="password" name="pwd" id="write" class="form-control" placeholder="Password" required/>
                    </div>
            </div>
        </div>
        <div class="form-group" id="sendauth">
            <button class="envoyerauth btn btn-default" name="envoyer">
               <p>Envoyer</p>
            </button>
        </div>
    </form>

    <?php

    if (isset($_POST['envoyer'])) {
      $login=$_POST['login'];
      $password=$_POST['pwd'];
    $fichier=fopen("login.txt", "r");
        while (!feof($fichier)) {
            $ligne=fgets($fichier);
            $user=explode(",",$ligne);
            if($login==$user[1] && $password==$user[2] && $user[5]=="admin" && $user[6]=='actif'){
                $_SESSION["profil"]="admin";
                header('location:ajoutuser.php');
            }
            elseif($login==$user[1] && $password==$user[2] && $user[5]=="user" && $user[6]=='actif'){
            $_SESSION["profil"]="user";
            header('location:listeProduits.php');
            }
        }
        echo " <h6 class='title'>Identifiant ou mot de passe incorrecte</h6>";

    fclose($fichier);
    $admin=fopen("admin.txt", "r");
        while (!feof($admin)) {
            $col=fgets($admin);
            $user=explode(",",$col);
            if($login==$user[0] && $password==$user[1] ){
                $_SESSION["profil"]="admin";
                header('location:ajoutuser.php');
            }
        }
    fclose($admin);
}
    ?>
</body>
</html>
