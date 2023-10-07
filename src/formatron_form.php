<?php
/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
?>
<center>
<script type="text/javascript" src="js/opcje.js"></script>
<form id="formatron" method="POST" action="pokaz.php"><br>
<textarea cols="76" rows="5" name="rw" onfocus="if(this.value=='Wklej swój raport.')this.value='';" onblur="if(this.value=='')this.value='Wklej swój raport.';">Wklej swój raport.</textarea><br>
<input id="opt01" type="checkbox" name="kordy" value="1"> pokazuj współrzędne,
<input id="opt02" type="checkbox" name="techy" value="1"> pokazuj technologie,
kolory: <select id="opt03" name="paleta">
<option value="0">jasne tło
<option value="1" selected="selected">ciemne tło - takana
<option value="2">ciemne tło - pastele
<option value="3">ciemne tło - tęcza
</select><br>
<div id="zaawansowane" class="opcje">
<table>
<tr><td>
Wersja (<a href="opis.php#2">?</a>): <select id="opt04" name="wersja" onchange="weryfikuj();">
<option value="0">1.0.4
<option value="1" selected="selected">1.1.4
</select>
</td></tr>
<tr><td>
Opis bitwy: <input id="opt05" type="text" name="bitwa" value="Po x zaciętych rundach."  size="25" onfocus="if(this.value=='Po x zaciętych rundach.')this.value='';" onblur="if(this.value=='')this.value='Po x zaciętych rundach.';">
</td></tr>
<tr><td>
Czas starcia:<br>
<input id="opt06" type="checkbox" name="nagl" value="1" checked="checked" disabled="disabled" onclick="weryfikuj();"> Pokazuj linię "Następujące floty stoczyły walkę"<br>
<span class="opcje">
<input id="opt07" type="checkbox" name="czydata" value="1" checked="checked" disabled="disabled"> pokazuj datę starcia<br>
<input id="opt08" type="checkbox" name="czyczas" value="1" checked="checked" disabled="disabled"> pokazuj czas starcia<br>
</span>
</td></tr>
<tr><td>
Podsumowanie zysku/strat:<br>
<input id="opt09" type="checkbox" name="podsumdeu" value="1" checked="checked" disabled="disabled"> Uwzględniaj deuter przy obliczaniu strat<br>
<input id="opt10" type="checkbox" name="podsumsur" value="1" checked="checked" disabled="disabled"> Rozpisz na surowce
</td></tr>
<tr><td>
<input type="button" name="save" value="Zapisz ustawienia" onclick="zapisz_opcje();">
<input type="button" name="load" value="Wczytaj ustawienia" onclick="wczytaj_opcje();">
<br>
</td></tr></table>
</div>
<input type="submit" value="Konwertuj">
<input type="button" value="Wyczyść" onclick="this.form.reset(); weryfikuj();">
<input type="button" value="Opcje zaawansowane" onclick="ShowHide('zaawansowane');"><br>
</form>
</center>

Formatron jest oparty o skrypt <a href="http://pc162-41.karolinka.ds.polsl.pl/~camera/" target="_blank">rwkonw 0.5</a><br>
