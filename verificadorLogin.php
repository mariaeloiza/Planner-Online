<?php
    if (!parametrosValidos($_SESSION, ["usuario_email"])) {
        header("Location: paginalogin.php");
    }

?>