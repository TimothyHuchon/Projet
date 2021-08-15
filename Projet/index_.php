<!doctype html>
<?php
//index public
session_start();


include('./admin/lib/php/admin_liste_include.php');
$cnx = Connexion::getInstance($dsn, $user, $password);


?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site 2020</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="lib/css/style.css"/>
    <link rel="stylesheet" href="lib/css/custom.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="./admin/lib/js/fonction_jquery.js"></script>

</head>

<body>
<div id="page">
    <header class="img_header">

    </header>
    <section id="colGauche">
        <nav>
            <?php
            $path = "./lib/php/public_menu.php";
            if (file_exists($path)) {
                include ($path);
            }
            ?>


        </nav>

    </section>
    <section id="contenu">
        <div id="main">
            <?php
            if(!isset($_SESSION['page'])){
                $_SESSION['page']="./pages/accueil.php";
            }
            if(isset($_GET['page'])){
                $_SESSION['page']="./pages/".$_GET['page'];
            }
            $path=$_SESSION['page'];
            if(file_exists($path)){
                include ($path);
            } else {
                include ('./pages/page404.php');
            }
            ?>
        </div>
    </section>
</div>
<?php
$path = "./lib/php/public_footer.php";
if (file_exists($path)) {
    include($path);
}
?>
</body>
</html>