<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: ../Appli/SeConnecter.php');
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
    <html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Accueil administrateur de l'intranet</title>
    <link href="CSS/Accueil.css" rel="stylesheet" />
    <link rel="icon" href="../Ressources/favicon.ico" />
</head>
<body>
    <?php include_once("header.php") ?>

    <h1>Accueil administrateur de l'intranet GSB</h1>
    <div id="Blabla" style='margin:auto;'>
        <div class="btn">
            <a onclick="window.setTimeout(function(){location.href='NouvelUser.php';},200)" style="background-color: #24a7b0;" class="Bloc">
                <p>Gestion des utilisateurs</p>
            </a>
        </div>
        <div class="btn">
            <a onclick="window.setTimeout(function(){location.href='Archives.php';},200)" style="background-color: #52dae4;" class="Bloc">
                <p>Gestion des archives</p>
            </a>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
    <script>
        var tg, tgqe, x, y = null;
        $("div.btn > a").on('click',function(e){
            tg = $(this).parent();
            if(tg.find('.qe').length == 0){
                tg.prepend("<span class='qe'></span>");
            }
            tgqe = tg.find(".qe");
            tgqe.removeClass("ani");
            if(!tgqe.height() && !tgqe.width()){
                var maxsz = Math.max(tg.outerWidth(), tg.outerHeight());
                tgqe.css({height: maxsz, width: maxsz});
            }
            x = e.pageX - tg.offset().left - tgqe.width()/2;
            y = e.pageY - tg.offset().top - tgqe.height()/2;
            tgqe.css({top: y+'px', left: x+'px'}).addClass("ani");
        })
    </script>
</body>
<?php } ?>
