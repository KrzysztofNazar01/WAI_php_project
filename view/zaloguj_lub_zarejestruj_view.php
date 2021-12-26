<?php if(!isset($_SESSION['login'])): ?>

<p>
    zaloguj lub zarejestruj sie:
</p>

<form action="zarejestruj" method="post" >

    <input type="submit" value="Zarejestruj" name="Zarejestruj"/>

</form>

<form action="zaloguj" method="post" >

    <input type="submit" value="Zaloguj" name="Zaloguj"/>

</form>

<?php endif ?>