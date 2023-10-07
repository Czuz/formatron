<?php
/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
require_once("head.php");
	echo("Dane zbierane od 26 VIII 2007r.<br>");
	printf( "Do tej pory na stronie był%s <b>%d</b> wizyt%s.<br>",
		$licz == 1 ? "a" 
		: ( ( $licz >= 5 && $licz <= 21 ) || ( $licz % 10 >= 5 ) || ( $licz % 10 <= 1 )
	       	? "o" : "y" ), $licz, $licz == 1 ? "a"
		: ( ( $licz >= 5 && $licz <= 21 ) || ( $licz % 10 >= 5 ) || ( $licz % 10 <= 1 )
		? "" : "y" ) );


        if ( file_exists( "formatron.n" ) )
	{
		$file = fopen( "formatron.n", "r" );
		flock( $file, 1 );
		$form = fgets( $file, 100 );
		fclose( $file );
	}
	printf("Skonwertowano <b>%d</b> raport%s.<br><br>",
		$form, $form == 1 ? ""
		: ( ( $form >= 5 && $form <= 21 ) || ( $form % 10 >= 5 ) || ( $form % 10 <= 1 )
		? "ów" : "y" ) );

require_once("tail.php");
?>
