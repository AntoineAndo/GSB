<?php
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
    
if( $_SESSION['Poste'] == 'Admin')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilAdmin.php">Accéder à l\'accueil Admin</a>';
}
else if($_SESSION['Poste'] == 'Employe')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilVisiteur.php">Accéder à l\'accueil Employé</a>';  
}    
else {    
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="CSS/ValidFrais.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Validation des frais - GSB</title>
</head>
<body>
    <header>
        <a href="Accueil.html">
            <img src="GSB.png" alt="Logo GSB" />
        </a>
        <h1>Validation des frais</h1>

        <div id="User">
            <?php
            echo '<b>'.$_SESSION['Prenom'].' '.$_SESSION['Nom'].'</b>';
            ?>
            <img src="Avatar.jpg" />
            <ul>
                <li>------------------</li>
                <li><a href="http://localhost/GSB/Appli/Deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>

    </header>
    <div id="Navi">

        <div id="BoutonOutils">
            <a id="Outils">Consulter</a>
        </div>
        <h2>Outils</h2>
        <ul>
            <li><b>Frais</b></li>
            <ul>
                <li><a href="ValidFrais.html">Enregistrer opération</a></li>
            </ul>
        </ul>
    </div>

    <div id="Navi2">

        <div id="BoutonConsulter">
            <a id="Consulter">Outils </a>
        </div>
        <h2>Consulter une archive</h2>
        <ul>
            <li><b>Frais</b></li>
            <ul>
                <li><a href="ValidFrais.html">Enregistrer opération</a></li>
            </ul>
        </ul>
    </div>
    <form name="formValidFrais" method="post" action="enregValidFrais.php">
        <div class="Blabla">
            <h2>Validation des frais par visiteur</h2>

            <label class="titre">Choisir le visiteur :</label>
            <select name="lstVisiteur" class="zone">
                <option value="a131">Villechalane</option>
            </select>
            <label class="titre">Mois :</label>
            <input class="zone" type="text" name="dateValid" size="12" />
            <p class="titre" />
        </div>
        <div class="Blabla">
            <div>
                <h2>Frais au forfait </h2>
            </div>
            <table border="1">
                <tr>
                    <th>Repas midi</th>
                    <th>Nuitée </th>
                    <th>Km </th>
                    <th>Situation</th>
                </tr>
                <tr align="center">
                    <td width="90">
                        <input type="text" size="6" name="repas" /></td>
                    <td width="90">
                        <input type="text" size="6" name="nuitee" /></td>
                    <td width="90">
                        <input type="text" size="6" name="km" /></td>
                    <td width="80">
                        <select size="3" name="situ">
                            <option value="E">Enregistré</option>
                            <option value="V">Validé</option>
                            <option value="R">Remboursé</option>
                        </select></td>
                </tr>
            </table>
        </div>
        <div class="Blabla">
            <h2>Hors forfait</h2>
            <table border="1">
                <tr>
                    <th>Date</th>
                    <th>Libellé </th>
                    <th>Montant</th>
                    <th>Situation</th>
                </tr>
                <tr align="center">
                    <td width="100">
                        <input type="text" size="12" name="hfDate1" /></td>
                    <td width="220">
                        <input type="text" size="30" name="hfLib1" /></td>
                    <td width="90">
                        <input type="text" size="10" name="hfMont1" /></td>
                    <td width="80">
                        <select size="3" name="hfSitu1">
                            <option value="E">Enregistré</option>
                            <option value="V">Validé</option>
                            <option value="R">Remboursé</option>
                        </select></td>
                </tr>
            </table>
            <p></p>
            <div class="titre">Nb Justificatifs</div>
            <input type="text" class="zone" size="4" name="hcMontant" />
            <p class="titre" />
            <label class="titre">&nbsp;</label>
            <input type="submit" value="Valider" class="Bouton" />
            <input type="reset" class="Bouton Effacer" value="Effacer" />
        </div>
    </form>


</body>
</html>

<?php } ?>

