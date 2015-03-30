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
           
    $requete= 'DELETE FROM lignedefrais WHERE id = :id';
    try
         {
             $req = $connect->prepare($requete);
             
             $req->execute(array(':id'=>$_POST['id']));
             
             header('location:http://localhost/GSB/Formulaires/SaisirFrais%20-%20NEW.php');
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         }
         
         
    ?>