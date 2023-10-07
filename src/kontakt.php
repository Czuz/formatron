<?php
/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
// ini_set("include_path", ".:libs/");
require_once("head.php");

$nick = null; $nick = $_POST['nick'];
$mail = null; $mail = $_POST['mail'];
$temat = null; $temat = $_POST['temat'];
$tresc = null; $tresc = nl2br(htmlspecialchars($_POST['tresc']));

echo "<h1>Wyślij e-mail do autora.</h1><br>";
echo "<center><table class=\"ciemna\">";
if ($nick||$mail||$temat||$tresc) {
	echo "<tr><td class='ciemna' style='text-align: center;'>";
	if ($nick&&$mail&&$temat&&$tresc) {
		// require_once("Mail.php");
		// require_once("Mail/mime.php");

		$params["host"] = "CUT";
		$params["auth"] = TRUE;
		$params["username"] = "CUT";
		$params["password"] = "CUT";

		$headers["To"] = "CUT";
		$headers["Reply-To"] = $nick." <".$mail.">";
		$headers["Content-Transfer-Encoding"] = "8bit";

		$recipients = "CUT";

		$wiadomosc = "Wiadomość od: ".$nick." &lt;".$mail."&gt;:<br>\n";
		$wiadomosc.= $tresc;

		// $mime = new Mail_mime("\n");
		// $mime->setHTMLBody($wiadomosc);
		// $mime->setSubject("[FORMATRON]: $temat.");
		// $mime->setFrom("CUT");
		// $wiadomosc = $mime->get(
		// 	array(
		// 		"html_charset" => "iso-8859-2",
		// 		"head_charset" => "iso-8859-2"
		// 	)
		// );

		// $mailer =& Mail::factory("smtp", $params);
		// if (PEAR::isError($error=$mailer->send($recipients,
		// 	$mime->headers($headers), $wiadomosc))) {
		// 	die($error->getMessage());
		// } else {
			echo "<div class=\"thanks\">Mail wysłany.</div>";
		// } 
	} else {
		echo "<b>Wypełnij wszystkie pola.</b>";
	}
	echo "</td></tr>";
}
?>

<tr><td>
<form action="kontakt.php" method="Post">
<table>
<tr><td>
Twoje imię:
</td><td>
<input type="text" name="nick" size="40">
</td></tr><tr><td>
Twój e-mail:
</td><td>
<input type="text" name="mail" size="40">
</td></tr><tr><td>
Temat:
</td><td>
<input type="text" name="temat" size="40">
</td></tr><tr><td>
Treść:
</td><td>
<textarea name="tresc" rows="10" cols="65"></textarea>
</td></tr><tr><td colspan="2" align="center">
<input type="submit" value="Wyślij">
</td></tr>
</table>
</form>
</td></tr></table></center>
<?php
require_once("tail.php");
?>
