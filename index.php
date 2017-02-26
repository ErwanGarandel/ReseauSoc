<?php
/**
 * Created by PhpStorm.
 * User: Erwan
 * Date: 26/02/2017
 * Time: 16:13
 */

require_once 'header.php';

echo "<br><span class='main'>Bienvenue dans le $appname";

if($loggedin)
    echo ", $user, vous êtes connecté.";
else
    echo '.<br>Inscrivez-vous ou connectez-vous pour nous rejoindre.</span>';
?>
<br><br>