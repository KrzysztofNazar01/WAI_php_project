<form method="post" action="">
    <p>
    
    <button type="submit" name="submit_refreash" onclick="decrement()" class="gallery_button" >Poprzednia</button>
  <?php for ($x = 1; $x <= (count_items())/3 + 1 ; $x++): ?>
    <button  id="myButton1" type="submit" name="submit_refreash" class="gallery_button" value= "<?= $x ?>" onclick="myFunction(value)"> <?= $x ?></button>

<?php endfor ?>

    <button type="submit" name="submit_refreash" onclick="increment()" class="gallery_button" >Kolejna</button>


  <br>
    Strona nr: <input type="text" name="ilosc" id="ilosc" value="1">
    </p>


  </form>


