<!DOCTYPE html>
<html>
<head>
    <title>Sport - Moje Hobby</title>
    <link rel="stylesheet" href="static/main.css"/>
    <script src="static/JS_file.js" type="text/javascript">
</script>


</head>
<body onload="load_counter();">

<?php include 'partial/header.php'; ?>

<div id="pudelko1" >

    <?php include 'pagination_view.php' ?>

    <?php include 'galeria_view.php' ?>

</div>


<div id="pudelko2">
        
    <?php include 'ilosc_zdjec_view.php' ?>
    
    <?php include 'wyslij_nowe_zdjecie_view.php' ?>


    <?php include 'zaloguj_lub_zarejestruj_view.php' ?>

    <?php if(isset($_SESSION['login'])) include 'wyloguj_view.php'; ?>

    <?php include 'przywitanie.php'; ?>

</div>

</body>
</html>
