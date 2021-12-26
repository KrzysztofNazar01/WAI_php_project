<?php


if(isset($_POST["submit_refreash"])) {
$page = $_POST['ilosc'];

$products = show_private_photos($_SESSION['login'], $page);
}

else{
$page = 1;

$products = show_private_photos($_SESSION['login'], $page);

}


?>

