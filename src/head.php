<?php
/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
        setcookie( "visited", "1", time( ) + 3600 * 3);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="Description" content="Formatron - konwerter do raportów wojennych Ogame">
<meta name="Keywords" content="Ogame, formatron, konwerter, raport, wojenny, raportów, wojennych">
<meta name="Robots" content="index, follow">
<link rel="stylesheet" type="text/css" href="styl.css">
<title>Formatron - konwerter raportów wojennych Ogame</title>
<script type="text/javascript" src="js/sh.js"></script>
</head>

<body>
<?php 
	$banned = array ( );

	for ($i = 0; $i < count($banned); $i++ ) {
		if ( preg_match( $banned[$i], gethostbyaddr( $_SERVER["REMOTE_ADDR"] ) ) ) {
			echo "<center><p class=\"warning\">You have been banned from this site.</p></center>";
			echo "</body>";
			echo "</html>";
			exit();
		}
	}

	$licz = 0;
	
	if ( file_exists( "licznik.n" ) )
	{
		$file = fopen( "licznik.n", "r" );
		if ( flock( $file, 1 ) )
		{
			$licz = fgets( $file, 100 );
			fclose( $file );

			if( $_COOKIE["visited"] != "1" )
			{
				$licz += 1;
				$file = fopen( "access.log", "a" );
				flock( $file, 2 );
				$logline = sprintf( "%s %s\n", date( "r" ), gethostbyaddr( $_SERVER["REMOTE_ADDR"] ) );
				fwrite( $file, $logline );
				fclose( $file );
			}
		}
	}
	else
	{
		$licz = 1;
		$file = fopen( "access.log", "a" );
		flock( $file, 2 );
		$logline = sprintf( "%s %s\n", date( "r" ), gethostbyaddr( $_SERVER["REMOTE_ADDR"] ) );
		fwrite( $file, $logline );
		fclose( $file );
	}

	if ( $licz != 0 )
	{
		$file = fopen( "licznik.n", "w" );
		if ( flock( $file, 2 ) )
		{
			fwrite( $file, "$licz" );
			fclose( $file );
		}
	}
?>
<table class="strona">
<tr><td class="bok">
<!-- menu -->
<?php
require_once("menu.php");
?>

</td><td class="srodek">
