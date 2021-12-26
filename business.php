<?php

require '../../vendor/autoload.php';


use MongoDB\BSON\ObjectID;


function get_db(){
    try{
            $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;
    return $db;
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }

}

function get_products(){
    try{
        $db = get_db();
        return $db->products->find()->toArray();
    }
    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }

}



function get_product($id){
    try{
        $db = get_db();
        return $db->products->findOne(['_id' => new ObjectID($id)]);
    }
 
    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }
}

function save_product($id, $product){
    try{
        $db = get_db();

        if ($id == null) {
            $db->products->insertOne($product);
        } else {
            $db->products->replaceOne(['_id' => new ObjectID($id)], $product);
        }

        return true;
    }
     
    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }
}

function check_if_logged(){
    try{
        if($_SESSION['login'] == null){
            $_SESSION['login'] = null; 
        }
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }
}

function count_items(){
    try{
        $db = get_db();

        $amount = $db->products->count();
        return $amount; 
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }
}

function login_jest_juz_zajety($wpisany_login){
    try{
        $db = get_db();

        $query = ['login' => $wpisany_login];
        
        $user = $db->uzytkownicy->findOne($query);

        return $user; 
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }
}

function utworz_konto($id_uzytkownika, $email, $login, $haslo){
    try{
        $db = get_db();

        $id = $id_uzytkownika;
        
        $hash = password_hash($haslo, PASSWORD_DEFAULT);

        $db->uzytkownicy->insertOne([
            'email' =>$email,
            'login' => $login,
            'haslo' => $hash,
            'haslo_powtorzone' => $hash,
            'id' => $id
        ]);

        $_SESSION['login'] = $login;   
    }
    
    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }
}

function znajdz_uztykownika($login){
    try{
        $db = get_db();

        $uzytkownik = $db->uzytkownicy->findOne(['login' => $login]);
        return $uzytkownik;
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }

}

function sprawdz_haslo($login, $haslo ){
    try{
        $db = get_db();

        $uzytkownik = $db->uzytkownicy->findOne(['login' => $login]);
        $hash = $uzytkownik['haslo'];

        return password_verify($haslo, $hash); 
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }
}


function zaloguj_uzytkownika($login, $id ){

    try{
        session_regenerate_id();

        $_SESSION['user_id'] =  $id;
        $_SESSION['login'] = $login;
    }

    catch (MongoDB\Exception $error_message) {
        echo "Wystapil błąd podczas logowania użytkownika ", $error_message->getMessage(), "\n";   
    }
}



function wyloguj_uzytkownika(){
    try{
        session_unset();
        session_destroy();
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    catch (MongoDB\Exception $error_message) {
        echo "Wystapil błąd podczas wylogowowania użytkownika", $error_message->getMessage(), "\n";   
    }
}



function sprawdz_rozmiar($size, &$uploadOK){
    try{
        if ($size > 1048576) {
        $uploadOK = 1;
        return " Ten plik jest za duży.";
        }
     
        else return null;
    }
    catch (MongoDB\Exception $error_message) {
        echo "Bład wysyłania zdjecia. ", $error_message->getMessage(), "\n";   
    }
}

function sprawdz_czy_juz_istnieje($name, &$uploadOK){
    try{
        $target_file = "images/" . basename($name);

        if (file_exists($target_file)) {
            $uploadOK = 1;
            return "Plik o tej nazwie juz istnieje. ";
            
        }
        else
        return null;   
    }
    catch (MongoDB\Exception $error_message) {
        echo "Bład wysyłania zdjecia. ", $error_message->getMessage(), "\n";   
    }

}

function sprawdz_typ_pliku($name, &$uploadOK){
    try{
        $target_file = "images/" . basename($name);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png") {
            $uploadOK = 1;
            return "Dozwolone sa pliki tylko w formacie JPG lub PNG";
        }
        else
        return null;
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład wysyłania zdjecia. ", $error_message->getMessage(), "\n";   
    }
}

function stworz_miniaturke($imageURL,$target_file, $destiantion_name ){
    try{
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        list($szer,$wys) = getimagesize($imageURL);
        
        $newwidth = 200;
        $newheight = 125;
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $thumbURL = "images/miniatures/";
        
        if($imageFileType == "jpg"){
        $source = imagecreatefromjpeg($imageURL);
        }
        else{
        $source = imagecreatefrompng($imageURL);
        }
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $szer, $wys);
        imagejpeg($thumb, $thumbURL . $destiantion_name, 100);
        imagedestroy($thumb);
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład wysyłania zdjecia. ", $error_message->getMessage(), "\n";   
    }
}

function orginalne_zdjecie_i_watermark($imageURL, $WaterMarkText, $destiantion_name){
    try{
        $target_file = "images/" . basename($destiantion_name);
        $imageURL = $_FILES["fileToUpload"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        stworz_miniaturke($imageURL,$target_file, $destiantion_name);

        copy($imageURL, "images/original_photos/" . $destiantion_name);
            
        if($imageFileType == "png"){
        $image = imagecreatefrompng($imageURL);
        imagejpeg($image, $imageURL, 100);
        imagedestroy($image);
        } 

        //watermark
        list($width,$height) = getimagesize($imageURL);
        $imageProperties = imagecreatetruecolor($width, $height);
        $targetLayer = imagecreatefromjpeg($imageURL);
        imagecopyresampled($imageProperties, $targetLayer, 0, 0, 0, 0, $width, $height, $width, $height);
        
        $font_size = 50;
        $font = 'static/arial/arial.ttf';
        $watermarkColor = imagecolorallocate($imageProperties, 200, 500,200); // kolor napisu
        
        imagettftext($imageProperties, $font_size, 45, $width/2, $height/2, $watermarkColor, $font, $WaterMarkText);
        
        imagejpeg($imageProperties, $imageURL, 100);

        if(move_uploaded_file($imageURL, $target_file)) return true;
        else return false;
    }
    
    catch (MongoDB\Exception $error_message) {
        echo "Bład wysyłania zdjecia. ", $error_message->getMessage(), "\n";   
    }
}


function zapisz_zdjecie_w_MongoDB($autor, $tytul, $WaterMarkText, $nick_zdjecia, $posting ){
    try{
        $db = get_db();

        if (!empty($autor) && !empty($tytul) )
            {
                if(isset($_SESSION['login'])){
                $product = [
                'autor' => $_SESSION['login'],
                'tytul' => $tytul,
                'watermark' => $WaterMarkText,
                'nick_zdjecia' => $nick_zdjecia,
                'posting' => $posting,

                ];
                }
                else{
                $product = [
                'autor' => $autor,
                'tytul' => $tytul,
                'watermark' => $WaterMarkText,
                'nick_zdjecia' => $nick_zdjecia,
                'posting' => "public"
                ];  
                }

                if (empty($id)){
                $db->products->insertOne($product);
                } 
                else{
                $db->products->replaceOne(['_id' => new ObjectID($id)], $product);
                }
                return true;
            }

            else{
                return false;
            }
    }

    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }


}

function start_session(){
    try{
        session_start();
    }
    catch (MongoDB\Exception $error_message) {
        echo "Bład rozpoczecia nowej sesji ", $error_message->getMessage(), "\n";   
    }
}



function show_private_photos($login, $page){
    try{
        $opts = [
            'skip' => ($page - 1) * $pageSize,
            'limit' => $pageSize
            ];
        $pageSize = 3;

        $db = get_db();
        $products = $db->products->find();
    
        if(isset($login) ){
            $products=$db->products->find([ 'autor' => $login, 'posting' => "private"], $opts);
            return $products;
        }
    }


    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }
}

function show_public_photos($page){
    try{
        $db = get_db();
        $products = $db->products->find();

        $pageSize = 3;
        $opts = [
        'skip' => ($page - 1) * $pageSize,
        'limit' => $pageSize
        ];
    
        $products=$db->products->find([], $opts);

        return $products;
    }


    catch (MongoDB\Exception $error_message) {
        echo "Bład polączenia z bazą danych. ", $error_message->getMessage(), "\n";   
    }

}


