<?php

session_start(); 
if(isset($_SESSION['login']) && $_SESSION['Poste']=='Employe' )   
    {
    header('location: ./AccueilVisiteur.php');
    }
else if(isset($_SESSION['login']) && $_SESSION['Poste']=='Comptable' )   
    {
    header('location: ./AccueilComptable.php');
    } 
else if(isset($_SESSION['login']) && $_SESSION['Poste']=='Admin' )   
    {
    header('location: ./AccueilAdmin.php');
    } 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="./CSS/SeConnecter.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Luckiest+Guy' rel='stylesheet' type='text/css' />
    <link rel="icon" href="../Ressources/favicon.ico" />
    <title>Intranet du Laboratoire GSB</title>
</head>
<body>
    <header>
        <img src="../Ressources/GSB.png" alt="Logo GSB" />
        <h1>Suivi du remboursement des frais</h1>
    </header>
    <div id="Blabla">



        <form action="../Appli/Connexion.php" method="post">

        <h2><u>Veuillez entrer ci-dessous vos identifiants: </u></h2>
<b style="color:red;"><?php if(isset($_SESSION['message']))
        echo $_SESSION['message'];
    ?></b>

            <table>
                <tbody>
                    <tr>
                        <td><b>Nom d'utilisateur :</b></td>
                        <td>
                            <input type="text" autocomplete="off" name="Login" maxlength="15" required="required"/></td>
                    </tr>
                    <tr>
                        <td><b>Mot de passe :</b></td>
                        <td>
                            <input type="password" autocomplete="off" name="MotDePasse" maxlength="15" required="required"/></td>
                    </tr>
                </tbody>
            </table>
                            <input type="submit" value="Valider" class="Bouton" />
                            <input type="reset" class="Bouton Effacer" value="Effacer" />
        </form>
    </div>

    <footer>
        <u>Copyright © 2015 SeeSharp Tous droits réservés</u>
    </footer>
</body>
</html>
