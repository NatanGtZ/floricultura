<?php
require_once 'conecta.php';

include 'header.php'

?>

<div class="formulario">
    <form method="post" class="form">

        <label>
            Usuário<br/>
            <input type="text" />
        </label><br/>
        <label>
            Senha<br/>
            <input type="password" />
        </label><br/>
        <label>
            <input type="submit" value="Login" class="btn btn-lg btn-success botao"/>
        </label>

    </form>
</div>

<?php
include 'footer.php'
?>