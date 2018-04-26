<?php
if($_GET["action"]=="deco")
{
    setcookie('mail');
    setcookie('password');
    echo("c'est fait");
    header('Location: index.php');
}
?>