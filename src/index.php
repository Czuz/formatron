<?php
/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
require_once("head.php");
?>
<h1>Ogame - konwerter RW.<br></h1>
<center><table class="ciemna" style="margin: 20px; width: 480px;"><tr class="ciemna"><td>
<p>Formatron jest narzędziem do konwersji raportów wojennych (RW) z polskich serwerów gry internetowej <a href="http://ogame.pl/">Ogame</a>. Sformatowane RW są gotowe do skopiowania i wklejenia na forach i w systemach portalowych obsługujących BBCode.</p>
<h2>Cechy formatrona:</h2>
<ul type="disc">
<li><b>obsługa ACS</b>
<li>czytelny, kolorowy format
<li>4 palety kolorów do wyboru
<li>podliczanie zysku z ataku
<li>podliczanie strat dla każdego typu jednostki 
<li>podgląd sformatowanego RW
</ul>
</td></tr>
<tr><td>
<h2>UWAGA</h2>
<p>Formatron domyślnie <b>dolicza</b> do strat <b>deuter</b>. Jeśli chcesz mieć wyniki zgodne z tymi z Ogame musisz wyłączyć opcję <a href="opis.php#4">UWZGLĘDNIJ DEUTER</a>.</p>
</td></tr></table>
</center>

<?php
$blokada = false;
if ($blokada) {
	echo "<span class=\"warning\">UWAGA: Trwa przerwa konserwacyjna, zapraszamy ponownie po przerwie.</span><br><br>";
} else {
	include_once("formatron_form.php");
}
require_once("tail.php");
?>
