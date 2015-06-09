<?php
include('SQL.php');
session_start(); 

if(!isset($_SESSION['login']))
    {
    header('location: ./SeConnecter.php');
    }

    if(($_POST['status'] < 3 && $_POST['status'] > -1) || !isset($_POST['status']))
        $requete= 'UPDATE fichefrais SET status = status + 1 WHERE id = :id';
    else if($_POST['status'] == 3)
        $requete= 'UPDATE fichefrais SET status = status - 1 WHERE id = :id';

    if($_POST['submit'] == 'Refuser')
        $requete= 'UPDATE fichefrais SET status = -1 WHERE id = :id';

    if($_POST['status'] == -1)
        $requete= 'UPDATE fichefrais SET status = 1 WHERE id = :id';

echo $_POST['status'];
echo $requete;

    try
    {
       $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login, $passwd);
    }
    catch (PDOException $e)
    {
        echo $e;
        exit('problème de connexion à la base');
    }

    try
     {
         $req = $connect->prepare($requete);
         $req->execute(array(':id'=>$_POST['id']));

          if($_SESSION['Poste'] == 'Employe')
            header('location: ../Formulaires/SaisirFrais.php');
          else if($_SESSION['Poste'] == 'Comptable')
            header('location: ../Formulaires/ValidFrais.php');
          else if($_SESSION['Poste'] == 'Admin')
            $location = 'location: ../Formulaires/Archives.php?employe='.$_POST['employe'];
            header($location);
            
     }    
     catch (PDOException $e)
     {
            $message = 'Problème dans la requête de sélection';
            echo $message;
     }
      
    // -1: Refusée   
    // 0: En cours
    // 1: En attente
    // 2: Validée
    // 3: Archivée



    ?>

