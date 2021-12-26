<?php
require_once 'business.php';

function edit(&$model){
    $model = [
        'show_error_sending' => null,
        'show_error_imageFileType' => null,
        'show_error_fileExists' => null,
        'show_error_size' => null
        ];

        $uploadOK = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){  
      if(isset($_POST["submit"])){
        $error_imageFileType = sprawdz_typ_pliku($_FILES["fileToUpload"]["name"], $uploadOK);
        $error_fileExists = sprawdz_czy_juz_istnieje($_FILES["fileToUpload"]["name"], $uploadOK);
        $error_size = sprawdz_rozmiar($_FILES["fileToUpload"]["size"], $uploadOK);

        if($uploadOK === 1){
            $model = [
                'show_error_sending' => ' Twoje zdjecie nie zostalo wysłane.',
                'show_error_imageFileType' => $error_imageFileType,
                'show_error_fileExists' => $error_fileExists,
                'show_error_size' => $error_size
                ]; 
        }
          else{ 
            if (orginalne_zdjecie_i_watermark($_FILES["fileToUpload"]["tmp_name"],  $_POST["watermark"], $_FILES['fileToUpload']['name'])){
              if(zapisz_zdjecie_w_MongoDB($_POST['autor'], $_POST['tytul'], $_POST["watermark"], $_FILES['fileToUpload']['name'], $_POST['posting'])){
                return 'redirect:index';
              } 
              else{
                $model = ['show_error_sending' => ' Wystabil blad wysylania twojego zdjecia'];
                //$model['wyswietl'] =" Wystabil blad wysylania twojego zdjecia";
              }
            }
          }
      }
    }
    return 'edit_view';
}


function index(){
    check_if_logged();
    return 'index_view'; 
}

function zarejestruj(&$model){
    $model = ['show_error' => null];

    if(isset($_POST["submit"])){
        $orginalne  = $_POST['haslo'];
        $powtorzone = $_POST['haslo_powtorzone'];
        if(strlen($orginalne) >= 8){
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $orginalne)){
                if($orginalne===$powtorzone){ 
                    if (login_jest_juz_zajety($_POST['login'])){
                        $model = ['show_error' => 'UWAGA! Login ' . $_POST['login'] . ' jest już zajety!'];
                    } 
                    else{
                        utworz_konto($_POST['id'], $_POST['email'], $_POST['login'], $_POST['haslo']);
                        return 'redirect:index'; 
                    }
                }
                else{
                    $model = ['show_error' => 'UWAGA! Hasła do siebie nie pasują!'];
                }
            }
            else{
                $model = ['show_error' => 'UWAGA! Hasło powinno zawierać przynajmniej jeden znak specjalny!'];
            }
        }
        else{
            $model = ['show_error' => 'UWAGA! Hasło powinno miec przynajmniej 8 znaków!'];
        }
    }
    
    return 'zarejestruj_view'; 
}


function zaloguj(&$model){
    $model = ['show_error' => null];

    if(isset($_POST["submit"])){
        $haslo = $_POST['haslo'];
        $login = $_POST['login'];
        $id = $_POST['id'];

        if(znajdz_uztykownika($login) !== null && sprawdz_haslo($login, $haslo)){
            zaloguj_uzytkownika($login, $id);

            return 'redirect:index';
        } 
        else{
            $model = ['show_error' => 'UWAGA! Niepoprawny login lub hasło!'];
        }
    }
return 'zaloguj_view';
}


function wyloguj(){
    if(isset($_POST["wyloguj"])){
        wyloguj_uzytkownika();
        return 'redirect:wylogowano';
    }
    if(isset($_SESSION['login'])){
        return 'wyloguj_view';
    }
}

function wylogowano(){

    if(isset($_POST["wyloguj"])){
        $_SESSION['login'] = null; 
        return 'redirect:index';
        }
    return 'wylogowano_view';
}













