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
    
?>

<form action="CreationUser.php" method="post">
    Nom:
    <input type="text" name="Nom">
    Prenom:
    <input type="text" name="Prenom">
    Poste:
    <input type='text' name='Poste'>
    Login:
    <input type="text" name='Login'>
    MDP:
    <input type='text' name='MDP'>
    <input value="Valider" type="submit" />
</form>

<?php 

}

?>
