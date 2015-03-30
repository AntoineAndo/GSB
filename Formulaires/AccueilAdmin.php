<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
    
if( $_SESSION['Poste'] != 'Admin' && $_SESSION['Poste'] == 'Employe')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilVisiteur.php">Accéder à l\'accueil employe</a>';
}
else if($_SESSION['Poste'] == 'Comptable')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilComptable.php">Accéder à l\'accueil comptable</a>';  
}
else
{
    try
           {
                   $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login);
           }
    catch (PDOException $e)
           {
                   exit('problème de connexion à la base');
           }
           
    $requete = 'SELECT Nom,Prenom,Date FROM formulaire WHERE Valider = 1 order by id';
    
    try
         {
             $req_prep = $connect->prepare($requete);
             $req_prep->execute();
             $resultat = $req_prep->fetchAll(); 
             $nb_result = count($resultat);
             
         }
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         } 
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Accueil visiteur de l'intranet</title>
    <link href="CSS/Accueil.css" rel="stylesheet" />
</head>
<body>
     <header>
        <img src="http://localhost/GSB/Ressources/GSB.png" alt="Galaxy-Swiss Bourdin" />

        <div id="User">
            <?php
            echo '<b>'.$_SESSION['Prenom'].' '.$_SESSION['Nom'].'</b>';
            ?>
            <img src="http://localhost/GSB/Ressources/Avatar.jpg" />
            <ul>
                <li>------------------</li>
                <li><a href="http://localhost/GSB/Appli/Deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>
    </header>
    <div class="Navi" style="background-color: gray;">

        <div class="BoutonConsulter" style="top: 200px; background-color: gray;" >
            <a id="Outils">Consulter</a>
        </div>
        <h2>Consulter Fiche</h2>
            <b>Frais</b>
            
                    <form method="POST" action="">
                        Mois/Année <input type="text" name="Date">
                        Prenom <input type="text" name="Prenom"><br>        
                        Nom <input type="text" name="Nom"><br>        
                        <input type="submit" value="Valider">        
                    </form>
    </div>

    <div class="Navi" style="background-color: rgb(75,148,186);">

        <div class="BoutonConsulter" style="top: 300px; background-color: rgb(75,148,186);">
            <a id="Consulter">Outils </a>
        </div>
        <h2>Compte utilisateur</h2>
        <ul>
            <li><b>Frais</b></li>
            <ul>
                <li><a href="ValidFrais.html">Enregistrer opération</a></li>
            </ul>
        </ul>
    </div>
    
    <div class="Navi" style="background-color: rgb(73,152,134);">

        <div class="BoutonConsulter" style="top: 400px; background-color: rgb(73,152,134);">
            <a id="Consulter">Outils </a>
        </div>
        <h2>Gestion forfaits</h2>
        <ul>
            <li><b>Frais</b></li>
            <ul>
                <li><a href="ValidFrais.html">Enregistrer opération</a></li>
            </ul>
        </ul>
    </div>
             <table border='1' id="Recap">
                 <caption><b><u> Fiches de frais non-validés </u></b></caption>
                 <tr style='background-color:rgb(150,150,150);'>
                     <th>Nom</th>
                     <th>Prenom</th>
                     <th>Date</th>
                 </tr>
     <?php        
             foreach ($resultat as $i) 
             {
      echo '<tr>
                <th>'.$i[0].'</th>
                <th>'.$i[1].'</th>
                <th>'.$i[2].'</th>
           </tr>';
             }
?>
                 
            </table>
</body>
<?php } ?>
