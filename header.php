<?php
	session_start();

	echo "<!DOCTYPE html>\n<html><head>";

	require_once 'functions.php';

	$userstr = ' (Invité)';

	if (isset($_SESSION['user'])) 
	{
		$user = $_SESSION['user'];
		$loggedin = TRUE;
		$userstr = " ($user)";
	}
	else
		$loggedin = FALSE; #Utilisateur non identifié

	echo "<title>$appname$userstr</title><link rel='stylesheet' " 	.
		 "<href ='styles.css' type='text/css'>"						.
        "</head><body><div style=\"text-align: center;\"><canvas id='logo' width='638' " .
        "heigth=96>$appname</div></canvas>" .
		 "<div class='appname'>$appname$userstr</div>"				.
		 "<script src='javascript.js'></script>";

	if ($loggedin)
	{	#si identifié
		echo "<br > <ul class='menu'>"	                                .
			 "<li><a href='members.php?view=$user'>Accueil</a></li>"	.
			 "<li><a href='members.php'>Membres</a></li>"				.
			 "<li><a href='friends.php'>Amis</a></li>"					.
			 "<li><a href='messages.php'>Messages</a></li>"				.
			 "<li><a href='profile.php'>Modifier Profil</a></li>"		.
			 "<li><a href='logout.php>Déconnecter</a></li>/ul></br>"				;
	}
	else
	{
		echo ("<br><ul class='menu'>"                                   .
			"<li><a href='index.php?'>Accueil</a></li>"					.
			"<li><a href='signup.php'>S'inscrire /</a></li>"			.
			"<li><a href='login.php'>Se Connecter</a></li></ul></br>"	.
			"<span class='info'>&#8658 ; Vous devez être connecté pour"	.
			"voir cette page.</span><br><br>"
			);
	}	 	

?>