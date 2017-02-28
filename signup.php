<?php
/**
 * Created by PhpStorm.
 * User: Erwan
 * Date: 27/02/2017
 * Time: 22:50
 */
require_once 'functions.php';

echo <<<_END
<script>
    function checkUser(){
    //verifie la disponibilité d'un nom d'utilisateur
    if(user.value == '')
    {
        0('info').innerHTML = ''
        return
    }
    // Construire la requête Ajax
        params = "user=" +user.value
        request = new ajaxRequest()
        request.open("POST","checkuser.php",true)
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        request.setRequestHeader("Content-length", params.length)
        request.setRequestHeader("Connection", "close")

        request.onreadystatechange = function()
        {
            if (this.readyState == 4)
                if (this.status == 200)
                    if (this.responseText != null)
                        0('info').innerHTML = this.reponseText
        }
        request.send(params)
    }

    function ajaxRequest()
    {
        try {
            var
            request = new XMLHttpRequest()
        } catch (e1) {
            try {
                request = new ActiveXObject("msxml2.XMLHTTP")
            } catch (e2) {
                try {
                    request = new ActiveXObject("Microsoft.XMLHTTP") } catch (e3) {
                    request = false
                }
            }
        }
        return request
        }
</script>
<div class="main"><h3>Entrez vos détails d'inscription</h3>
_END;

$error = $user = $password = "";
if(isset($_SESSION['user']))
    destroySession();
if(isset($_POST['user'])){
    $user = sanatizeString($_POST['user']);
    $password = sanatizeString($_POST['pass']);

    if ($user == "" || $password == "")
        $error = "Tous les champs ne sont pas remplis <br> <br>";
    else
    {
        $result = queryMysql("SELECT * FROM members WHERE user ='$user'");

        if($result->num_rows)
            $error = "Ce nom d'utilisateur est déjà pris<br><br>";
        else
        {
            queryMysql("INSERT INTO members VALUES ('$user', '$password')");
            die("<h4>Compte crée</h4><br>Identifiez-vous à nouveau.<br><br>");
        }
    }
}

echo <<<_END
<form method='post' action='signup.php'>$error
<span class='fieldname'>Nom d utilisateur</span>
<input type='text' maxlength='16' name='user' value='$user' onBlur='checkUser(this)'>
    <span id='info'></span><br>
<span class='fieldname'>Mot de passe</span>
<input type='password' maxlength='16' name="pass" value='$password'><br>
_END;
?>

<span class='fieldname'>&nbsp;</span>
<input type='submit' value='Je m&apos;inscris'>
</form>
</div><br>
</body>
</html>
