<!DOCTYPE html>
<html>
<head>
    <title>Edycja</title>
    <link rel="stylesheet" href="static/main.css"/>
    <script src="static/JS_file.js" type="text/javascript">
</script>
</head>
<body onload="hide();">

<?php include 'partial/header.php'; ?>
  
  <p>
  Wylogowano pomyślnie użytkownika.
  </p>
  <form action="wylogowano" method="post" >

    <input type="submit" value="Powrot na stronę główną" name="wyloguj" onclick="setfor1()"/>
</form>
<?php include 'partial/footer.php'; ?>


</body>
</html>
