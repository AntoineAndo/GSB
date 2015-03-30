<?php

session_start(); 
if(isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Formulaires/AccueilVisiteur.php');
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="SeConnecter.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Luckiest+Guy' rel='stylesheet' type='text/css' />
    <title>Intranet du Laboratoire GSB</title>
</head>
<body>
    <header>
        <img src="http://localhost/GSB/Ressources/GSB.png" alt="Logo GSB" />
        <h1>Suivi du remboursement des frais</h1>
    </header>
    <div id="Blabla">
        <h2><u>Veuillez entrer ci-dessous vos identifiants: </u></h2>


        <form action="Connexion.php" method="post">
            <u>Identification utilisateur :</u>
            <table>
                <tbody>
                    <tr>
                        <td><b>Nom d'utilisateur :</b></td>
                        <td>
                            <input type="text" autocomplete="off" name="Login" maxlength="15" style="width: 350px" required="required"/></td>
                    </tr>
                    <tr>
                        <td><b>Mot de passe :</b></td>
                        <td>
                            <input type="password" autocomplete="off" name="MotDePasse" maxlength="15" style="width: 350px" required="required"/></td>
                    </tr>

                    <tr>
                        <td colspan="2" style="">
                            <input type="submit" value="Valider" class="Bouton" />
                            <input type="reset" class="Bouton Effacer" value="Effacer" />
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <footer>
        <u>Copyright © 2014 JAVA Tous droits réservés</u>
    </footer>
</body>
</html>
