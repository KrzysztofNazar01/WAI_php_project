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
    <?php   if($show_error_imageFileType != null) echo $show_error_imageFileType; ?>
    <?php   if($show_error_fileExists != null) echo $show_error_fileExists; ?>
    <?php   if($show_error_size != null) echo $show_error_size; ?>
    <?php   if($show_error_sending != null) echo $show_error_sending; ?>
<form action="" method="post" enctype="multipart/form-data">
<?php if(isset($_SESSION['login'])): ?>
    <p>
 <label>public</label>
  <input type="radio" id="public" name="posting" value="public" checked>
 
  <p>
 <label >private</label>
  <input type="radio" id="private" name="posting" value="private">
 <?php else: ?>
    <input type="hidden" id="public" name="posting" value="public" checked>
 <?php endif ?>
 <p>
    <label>
        <span>Autor:</span>
        <?php   if(isset($_SESSION['login'])): ?>
        <input type="text" name="autor" value="<?= $_SESSION['login']?>" required/>
        <?php else: ?>
            <input type="text" name="autor" required/>
            <?php endif ?>

    </label>
    <p>
    <label>
        <span>Tytuł:</span>
        <input type="text" name="tytul" value="" required/>
    </label>
    <p>
    <label>
        <span>Watermark:</span>
        <input type="text" name="watermark" id="watermark"  value="" required />
    </label>
    <p>
    <label>
        <span>Zdjecie:</span>
        <input type="file" name="fileToUpload" id="fileToUpload2" name2="tak"  required />
    </label>


    <input type="hidden" name="id" value="<?= $product['_id'] ?>">
    <p>
    <div>
        <input type="submit" value="Zapisz" name="submit" onclick="setfor1()"/>
          <button  type="submit" name="submit_refreash" class="gallery_button" onclick="setfor1()"> <a href="index" class="cancel" >Anuluj</a></button>    
    </div>
    <input type="text" name="ilosc2" id="ilosc2" value="1">
</form>
<?php include 'partial/footer.php'; ?>


</body>
</html>
