
<!DOCTYPE html>
<html>
<head>
    <title>Rejestracja użytkownika</title>
    <link rel="stylesheet" href="static/main.css"/>
    <script src="static/JS_file.js" type="text/javascript">
</script>
</head>
<body  onload="hide();">
<?php   if($show_error != null) echo $show_error; ?>

<?php include 'partial/header.php'; ?>

<form action="" method="post">
    <p>
        <label>
            <span>Email:</span>
            <input type="text" name="email"  required/>
        </label>
    </p>

    <p>
        <label>
            <span>Login:</span>
            <input type="text" name="login"  required/>
        </label>
    </p>

    <p>
        <label>
            <span>Haslo:</span>
            <input type="password" name="haslo"  required/>
        </label>
    </p>
    <p>
        <label>
            <span>Powtorz haslo:</span>
            <input type="password" name="haslo_powtorzone"  required/>
        </label>
    </p>
    <p>
        <input type="submit" value="Zapisz" name="submit"/>
        <button  type="submit" name="submit_refreash" class="gallery_button" onclick="setfor1()"> <a href="index" class="cancel" >Anuluj</a></button>    
    </p>
        
    <p>
        <input type="text" name="ilosc2" id="ilosc2" value="1">
        <input type="hidden" name="id" value="<?= $uzytkownik['_id'] ?>">
    </p>
</form>

<?php include 'partial/footer.php'; ?>

</body>
</html>
