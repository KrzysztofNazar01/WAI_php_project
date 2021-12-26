<?php


if(isset($_POST["submit_refreash"])) {
    $page = $_POST['ilosc'];
    $products = show_public_photos($page);    
  
}


else{
    $page = 1;
    $products = show_public_photos($page);    
    $model['fotos'] = $products;
}

?>

