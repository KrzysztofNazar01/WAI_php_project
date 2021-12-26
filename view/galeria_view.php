<table>
    <thead>
    <tr>
        <th>Autor</th>
        <th>Tytuł</th>
        <th>Zdjecie</th>
        <th>Opublikowane</th>
    </tr>
    </thead>

    <tbody>


    <?php if (count_items()!= 0):require 'page.php';foreach ($products as $product):  ?>
    
        <?php if($product['posting'] == "public"):  ?>
            
            <tr>
                <td><?= $product['autor'] ?></td>
                <td><?= $product['tytul'] ?></td>
                <?php include 'bordersbegin.php'; ?>
                    <a href='images/<?= $product['nick_zdjecia'] ?>' target="_blank"><img src='images/miniatures/<?= $product['nick_zdjecia'] ?>' /></a>
                <?php include 'bordersend.php'; ?>
                <td><?= $product['posting'] ?>
            </td>
            </tr>
           
        
        <?php elseif(($product['posting'] == "private") && ($product['autor'] == $_SESSION['login'] )): ?>
            <tr>
                <td><?= $product['autor'] ?></td>
                <td><?= $product['tytul'] ?></td>
                <?php include 'bordersbegin.php'; ?>
                    <a href='images/<?= $product['nick_zdjecia'] ?>' target="_blank"><img src='images/miniatures/<?= $product['nick_zdjecia'] ?>' /></a>
                <?php include 'bordersend.php'; ?>
                <td><?= $product['posting'] ?> 
                 <p>
                </td>
            </tr>
           

        <?php else: ?>
            <tr>
                <td colspan="4">Zdjecie niedostępne - opublikowane prywatnie </td>
            </tr>
        <?php endif ?>

        <?php endforeach ?>

    <?php  else: ?>
        <tr>
            <td colspan="4">Brak zdjec w bazie danych</td>
        </tr>
    <?php endif  ?>
    </tbody>
</table>