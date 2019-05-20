<!DOCTYPE html>
<html lang="en-fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../codecss/main.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap//js/bootstrap.min.js">
    <title>CRÉER UN UTILISATEUR</title>
</head>
<body>
    <?php
        include("menuadmin.php");
    ?>
    <h1 class="title">Créer un utilisateur</h1>
    <form action="ajoutuser.php" method="POST" class="form-horizontal col-lg-6" id="form1">
        <div class="row">
            <div class="form-group" id="password">
                <label for="nom" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="text" name="nom" id="ajout" class="form-control" placeholder="Nom" required>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group" id="login" id="login">
                <label for="login" class="col-lg-2"></label>
                <div class="col-lg-10">
                    <input type="text" name="login" id="ajout"  class="form-control" placeholder="Login" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group" id="password">
                <label for="password" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="password" name="password" id="ajout" class="form-control" placeholder="Password" required>
                    </div>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group" id="password">
                <label for="adresse" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="text" name="adresse" id="ajout" class="form-control" placeholder="Adresse" required>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group" id="password">
                <label for="tel" class="col-lg-2"></label>
                    <div class="col-lg-10">
                        <input type="number" name="tel" id="ajout" class="form-control" placeholder="Téléphone" required>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group" id="password">
                <label for="adresse" class="col-lg-2">Status</label>
                    <div class="col-lg-10">
                        <select name="status" id="status">
                            <option value="user" placeholder="status"></option>
                            <option value="user" class="status" name="user">User</option>
                            <option value="admin" class="status" name="user">Admin</option>
                        </select>
                    </div>
            </div>
        </div>
        <div class="row">
        <div class="form-group" id="password">
                <label for="adresse" class="col-lg-2">Autorisation</label>
                    <div class="col-lg-10">
                        <select name="autorisation" id="status">
                            <option value="autorisation" placeholder="autorisation"></option>
                            <option value="inactif" class="botton" name="inactif">Actif</option>
                            <option value="actif" class="botton" name="actif">Inactif</option>
                        </select>
                    </div>
        </div>
        <div class="form-group" id="senduser">
            <button class="envoyer btn btn-default" name="envoyer">
               <p>Ajouter</p> 
            </button>
        </div>
    </form>
<?php
    if(isset($_POST['envoyer'])){
        $nom=$_POST['nom'];
        $login=$_POST['login'];
        $password=$_POST['password'];
        $adresse=$_POST['adresse'];
        $tel=$_POST['tel'];
        $status=$_POST['status'];
        $autorisation=$_POST['autorisation'];
        
      if($ajout=fopen("login.txt","a+"))
      {
      fwrite($ajout,"\n".$nom.",".$login.",".$password.",".$adresse.",".$tel.",".$status.",".$autorisation.",");
      fclose($ajout);     
      }
      else {echo "Fichier inaccessible";}     
    }
?>

</body>
</html>