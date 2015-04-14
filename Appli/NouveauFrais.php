<?php
include('SQL.php');
session_start(); 
$date = new DateTime();
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
   
    try
           {
                   $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login);
           }
    catch (PDOException $e)
           {
                   exit('problème de connexion à la base');
           }
           
    $currentMonth = (new dateTime())->format('m');
    $currentYear = (new dateTime())->format('Y');
    $requete2 = 'SELECT * FROM fichefrais WHERE mois = '.$currentMonth;

    try
    {
            $req_prep = $connect->prepare($requete2);
            $req_prep->execute();
            $resultat2 = $req_prep->fetchAll(); 
    } 
    catch (PDOException $e)
    {
      $message = 'Problème dans la requête de sélection';
      echo $message;
    }

    print_r($resultat2); 

    if (! $resultat2)
    {
        $requete2 = 'INSERT INTO fichefrais (mois, annee, idEmploye) VALUES (:Mois, :Annee, :idEmploye)';

        try
        {
            $req_prep = $connect->prepare($requete2);
            $req_prep->execute(array(':Mois'=>$currentMonth,
                                     ':Annee'=>$currentYear,
                                     ':Mois'=>$currentMonth,
                                     ':idEmploye'=>$_SESSION['id']));
            $resultat2 = $req_prep->fetchAll(); 
        } 
        catch (PDOException $e)
        {
          $message = 'Problème dans la requête de sélection';
          echo $message;
        }

    }

    $requete = 'INSERT INTO lignefrais (Type,Libelle,Date,Montant, idFicheFrais) VALUES (:Type,:Libelle,:Date,:Montant, (SELECT id FROM fichefrais WHERE mois = :Mois))';
    
    
    date_default_timezone_set('Europe/Paris');
    $date = date("Y/m/d H:i:s ", strtotime($_POST["Date"]));
    
    try
         {
             $req_prep = $connect->prepare($requete);
             
            $req_prep->execute(array(':Type'=>$_POST['Type'],
                                      ':Libelle'=>$_POST['Libelle'],
                                      ':Date'=>$date,
                                      ':Montant'=>$_POST['Montant'],
                                      ':Mois'=>$currentMonth));
            
            header('location:http://localhost/GSB/Formulaires/SaisirFrais.php');
         }    
         catch (PDOException $e)
         {
            $message = 'Problème dans la requête de sélection';
            echo $message;
         }
         
         
    ?>