<?php
include('sql.php');

session_start();
echo 'Session appellée<br>';

$_SESSION = array();
echo 'Tableau de session écrasé<br>';

session_destroy(); 
echo 'Session détruite<br>';

echo 'Vous êtes déconnectés';

header('location: http://localhost/GSB/Appli/SeConnecter.php');

?>