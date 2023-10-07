<?php
/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
require_once("head.php");
?>

<h1>SpeedSim - symulator walk Ogame<br></h1>
<center><table class="ciemna" style="width: 100%; padding: 3px;"><tr class="ciemna"><td>
<h1>Spis treści</h1>
<ol>
<li><a href="#1">O SpeedSim</a>
<li><a href="#2">Pliki</a>
<li><a href="#3">Instalacja</a>
<li><a href="#4">Bezpieczeństwo</a>
</ol>
</td></tr>
<tr><td>
<a name="1"></a>
<h1>O SpeedSim</h1>
<p>Program do symulacji walk w ogame o bardzo dużych możliwościach. Jego podstawowe cechy to:</p>
<ul type="circle">
<li>automatyczne wczytywanie raportów szpiegowskich i raportów wojennych (nie trzeba danych wczytywać ręcznie),
<li>możliwość zapisania własnej floty i technologii w programie,
<li>symulowanie przebiegu bitwy - przypadek pesymistyczny, optymistyczny i oczekiwany,
<li>możliwość symulacji ataków falowych i ACS,
<li>dokładne dane na temat zużycia paliwa, czasu lotu, potrzebnych recyclerów, spodziewanego zysku.
</ul>
<p>Niestety, program SpeedSim w obecnej wersji nie posiada obsługi nowego statku, dodanego w Ogame v0.75. Aby pozbyć się tego ograniczenia, pobierz poniższe pliki.</p>
<? include("reklama/reklama04.php"); ?>
</td></tr>
<tr><td>
<a name="2"></a>
<h1>Pliki</h1>
<p>Poniżej zamieszczam pliki, dzięki którym można używać SpeedSima do symulacji walk z Pancernikiem.</p>
<ul type="disc">
<li><a href="http://www.speedsim.de.vu/">SpeedSim</a> oryginalny program, do pobrania z oficjalnej strony,
<li><a href="SpeedSim/pancernik.rar">pliki konfiguracyjne</a> zamieniające statek kolonizacyjny na pancernik.
</ul>
</td></tr>
<tr><td>
<a name="3"></a>
<h1>Instalacja</h1>
<p>W poniższej instrukcji opiszę jedynie instalację plików konfiguracyjnych. Instalacja programu SpeedSim ogranicza się do rozpakowania odpowiedniego archiwum ZIP lub użyciu prostego instalatora i nie będę jej opisywał.</p>
<p>Należy wypakować pliki konfiguracyjne do katalogu z programem SpeedSim, a następnie go uruchomić. W menu "Więcej opcji" (F4) należy wybrać trzecią zakładkę ("Ideenplanet") i zaznaczyć oba checkboxy tak jak na rysunku. Przy każdym zaznaczeniu, program poprosi cię o wybranie pliku z odpowiednio, definicjami szybkich dział oraz parametrami statków. Wskazać należy pliki "pancernik.rf" oraz "pancernik.sd".</p>
<center><img src="SpeedSim/scr01.png" alt="wiecej opcji"></center>
<p>Dzięki powyższym plikom, SpeedSim będzie używał uaktualnionych danych dotyczących szybkich dział oraz innych parametrów statków. Dodatkowo następuje podmiana statku kolonizacyjnego na pancernik. Aby ułatwić sobie obsługę programu, a także automatyczne wczytywanie raportów szpiegowskich zawierających pancerniki, należy jeszcze wczytać odpowiedni plik językowy. Plik ten nosi nazwę "pancernik_lang.ini", a wczytuje się go przyciskiem "Wczytaj plik językowy".</p>
<center><img src="SpeedSim/scr02.png" alt="plik jezykowy"></center>
<p>Po wykonaniu powyższych czynności SpeedSim jest gotowy do symulacji walk z pancernikami.</p>
<p>Życzę wielu owocnych bitw.</p>
</td></tr>
<tr><td>
<a name="4"></a>
<h1>Bezpieczeństwo</h1>
<p>Ze względów bezpieczeństwa, zalecam pobieranie programu SpeedSim z jego oficjalnej strony. Pliki oferowane przeze mnie są plikami tekstowymi, zawierającymi jedynie odpowiednią konfigurację dla SpeedSima. Używanie ich jest w pełni bezpieczne.</p>
</td></tr>
<tr><td>
<? include("reklama/reklama05.php"); ?>
</td></tr></table>
</center>
<?php
require_once("tail.php");
?>

