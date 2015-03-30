<?php
include('SQL.php');
session_start(); 
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
           
    $requete = 'INSERT INTO ficheFrais (Type,Libelle,Date,Montant) VALUES (:Type,:Libelle,:Date,:Montant)';
    
    
    date_default_timezone_set('Europe/Paris');
$date = new DateTime();
$date = $date->format('Y/m/d');
    
    try
         {
             $req_prep = $connect->prepare($requete);
             
             $req_prep->execute(array(':Type'=>$_POST['Type'],
                                      ':Libelle'=>$_POST['Libelle'],
                                      ':Date'=>$date,
                                      ':Montant'=>$_POST['Montant']));
             
             header('location:http://localhost/GSB/Formulaires/SaisirFrais%20-%20NEW.php');
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         }
         
         
    ?>