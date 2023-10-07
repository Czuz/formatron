<?php
/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
require_once("head.php");
require_once("bbcode.php");
?>

<center><table class="ciemna"><tr class="ciemna"><td>
<?php
$techy	= 0; $techy	= $_POST['techy'];
$kordy	= 0; $kordy	= $_POST['kordy'];
$paleta	= 0; $paleta	= $_POST['paleta'];
$rw	= ""; $rw	= ( !strcmp( $_POST['rw'], "Wklej swój raport." ) )
				? "" : urlencode( $_POST['rw'] );
$bitwa	= ""; $bitwa	= ( !strcmp( $_POST['bitwa'], "Po x zaciętych rundach." ) )
				? "" : urlencode( $_POST['bitwa'] );
$wersja	= 0; $wersja	= $_POST['wersja'];
$nagl	= 0; $nagl	= $_POST['nagl'];
$czydata	= 0; $czydata	= $_POST['czydata'];
$czyczas	= 0; $czyczas	= $_POST['czyczas'];
$podsumdeu	= 0; $podsumdeu	= $_POST['podsumdeu'];
$podsumsur	= 0; $podsumsur	= $_POST['podsumsur'];

$bufor = "";

$opcje="kordy=".$kordy."&amp;techy=".$techy."&amp;paleta=".$paleta;
if ( $wersja > 0 ) {
	$opcje.= "&amp;bitwa=".$bitwa."&amp;nagl=".$nagl;
	$opcje.= "&amp;czydata=".$czydata."&amp;czyczas=".$czyczas;
	$opcje.= "&amp;podsumdeu=".$podsumdeu."&amp;podsumsur=".$podsumsur;
}

$opcje.= "&amp;rw=".$rw;

$opts = array(
	"http"=>array(
		"method"=>"POST",
		"content"=>$opcje
	)
);

switch ( $wersja ) {
	default:
	case 0: $formatron = "http://localhost/cgi-bin/formatron.cgi";
		break;
	case 1: $formatron = "http://localhost/cgi-bin/formatron2.cgi";
		break;
	case 2: $formatron = "http://localhost/cgi-bin/formatron3.cgi";
		echo "<div class=\"warning\">UWAGA: Wersja testowa.</div>";
		break;
}

if ( !strcmp( $rw, "" ) ) {
	echo "<br><div class=\"warning\">Brak RW do przetworzenia.</div>";
} else {

	$fp = fopen( $formatron, "r", false, stream_context_create( $opts ) );

	if (!$fp) {
		echo "<br><div class=\"warning\">BŁĄD: Nie mogę połączyć się z formatronem. Spróbuj póniej.</div>";
	} else {
		while(!feof($fp)) {
			$bufor .= fgets($fp, 4096);
		}
		fclose($fp);

		if ( file_exists( "formatron.n" ) )
		{
			$file = fopen( "formatron.n", "r" );
			flock( $file, 1 );
			$form = fgets( $file, 100 );
			fclose( $file );
			$form += 1;
		}
		else
		{
			$form = 1;
		}
		$file = fopen( "formatron.n", "w" );
		flock( $file, 2 );
		fwrite( $file, $form );
		fclose( $file );
	}
}
?>
<h1>Twoje RW:</h1>
(Skopiuj i wklej na forum.)
<center><form method="POST" action="pokaz.php">
<textarea cols="60" rows="5" name="wynik" readonly="readonly" onclick="this.select()">
<?php
echo $bufor;
?>
</textarea></form>
</center>
</td></tr>
<tr class="ciemna"><td>
<?php include_once("reklama/reklama03.php"); ?>
<p>Podgląd:</p><hr>
</td></tr>
<?php
if($paleta!=0){
	echo("<tr class='ciemna' style='font-size: 12px;'><td>");
}else{
	echo("<tr class='jasna' style='font-size: 12px;'><td>");
}

$bufor = bbcode($bufor);
echo($bufor);
?>
</td></tr><tr><td>
<hr>
<a href="/" onclick="history.back();return(false);">
<span style="font-size: 8px;">&lt;&lt;</span> Wróć</a>
</td></tr></table></center><br>

<?php
/*include_once("formatron_form.php");*/
require_once("tail.php");
?>
