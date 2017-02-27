<?php
/**
 * Created by PhpStorm.
 * User: Erwan
 * Date: 27/02/2017
 * Time: 22:51
 */
require_once 'functions.php';

if(isset($_POST['user']))
{
    $user = sanatizeString($_POST['user']);
    $result = queryMysql("SELECT * from members WHERE user='$user'");

    if($result->num_rows)
    {
        echo "<span class='taken'>&nbsp;&#x2718;"   .
             "Nom d'utilisateur déjà pris</span>"   ;
    }
    else
        echo "<span> class='available'>&nbsp;&#x2714;"  .
             "Nom d'utilisateur disponible</span>"      ;
}