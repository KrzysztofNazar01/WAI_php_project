<div id="cart">

    <h2>Koszyk</h2>

    <table>
        <thead>
        <tr>
            <th>Nazwa</th>
            <th>Ilość</th>
        </tr>
        </thead>

        <tbody>
        <?php if (!empty($cart)): ?>
            <?php foreach ($cart as $id => $product): ?>
                <tr>
                    <td>
                        <a href="view?id=<?= $id ?>"><?= $product['name'] ?></a>
                    </td>
                    <td><?= $product['amount'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="2">Brak produktów w koszyku</td>
            </tr>
        <?php endif ?>
        </tbody>

        <tfoot>
        <tr>
            <td>Łącznie pozycji: <?= count($cart) ?></td>
            <td>
                <form action="cart/clear" method="post" class="inline"
                      data-role="cart_form">
                    <input type="submit" value="Usuń wszystkie" name="clear_cart"/>
                </form>
            </td>
        </tr>
        </tfoot>
    </table>

    <script>
        $(function () {
            $('form[data-role=cart_form]').unbind('submit').submit(function (e) {
                e.preventDefault();

                $('#cart').ajaxMask();

                $.post($(this).attr('action'), $(this).serialize(),
                    function (response) {
                    $('#cart').replaceWith(response);
                });
            });
        });
    </script>
</div>
