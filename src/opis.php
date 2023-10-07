<?php
/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
require_once("head.php");
?>
<center>
<table class="ciemna">
<tr><td>
<h1>Spis treści</h1>
<ol>
<li><a href="#1">Informacje ogólne</a>
<li><a href="#2">Changelog</a>
<li><a href="#3">W planach</a>
<li><a href="#4">Instrukcja obsługi</a>
<li><a href="#5">Prawa autorskie</a>
</ol>
</td></tr>
<tr><td>
<a name="1"></a>
<h1>Informacje ogólne</h1>
<p>Formatron, to narzędzie do konwersji raportów wojennych z popularnej gry internetowej <a href="http://ogame.pl/">Ogame</a>. Wspomniana gra polega na budowie gwiezdnego imperium i toczeniu walk z innymi graczami. Formatron daje możliwość, by w prosty i czytelny sposób pochwalić się sukcesami militarnymi na forach internetowych poświęconych tej grze.</p>
<p>Pierwowzorem i podstawą do powstania Formatrona był skrypt PERLowy rwkonw 0.5. Niestety, pierwowzór posiadał jeszcze wiele błędów i braków - w tym brak obsługi walk ACS. Wersja 1.0 w założeniach miała stanowić stabilną, pozbawioną błędów i rozszerzoną o wsparcie dla ACS wersję rwkonw. W rzeczywistości poszła o krok dalej i niesie ze sobą przygotowania do późniejszych innowacji.</p>
<p>Zmianie uległ również interfejs obsługi Formatrona. Pomimo, że sam Fromatron jest skryptem PERLowym, to cała obsługa odbywa się przez stronę www. Nowy interfejs pozwala m.in. podejrzeć wygenerowany raport przed wklejeniem go na forum.</p>
</td></tr>
<tr><td>
<a name="2"></a>
<h1>Changelog</h1>
<h2>27.02.2007 - Formatron 1.1</h2>
<ul type="disc">
<li>możliwość podania własnego tekstu w miejsce "Po x zaciętych rundach",
<li>możliwość wyłączenia pokazywania daty starcia,
<li>rozdzielenie zysku z ataku na poszczególne surowce (metal, kryształ i deuter),
<li>rozdzielenie strat na poszczególne surowce (metal, kryształ i deuter),
<li>rozbudowane opcje,
<li>możliwość zapisania ustawień.
<li>uaktualniona cena Okrętu Wojennego
<li>dodany Pancernik
</ul>
<h2>21.09.2006 - Formatron 1.0</h2>
<ul type="disc">
<li><b>obsługa ACS</b>,
<li>czytelny, kolorowy format,
<li>4 palety kolorów do wyboru,
<li>podliczanie zysku z ataku,
<li>podliczanie strat dla każdego typu jednostki,
<li>podgląd sformatowanego RW.
</ul>
</td></tr>
<tr><td>
<a name="3"></a>
<h1>W planach</h1>
<h2>w najbliższym czasie</h2>
<ul type="disc">
<li>konwerter raportów z recyclerów.
</ul>
<h2>być może, w dalszej prespektywie</h2>
<ul type="disc">
<li>opcjonalna informacja o wartości utraconych jednostek ("Lekki myśliwiec: 470 [-20] (60.000 metalu, 20.000 kryształu)),
<li>możliwość podania sojuszu uczestników bitwy.
</ul>
</td></tr>
<tr><td>
<a name="4"></a>
<h1>Instrukcja obsługi</h1>
<h2>Wybór opcji</h2>
<p>Formatron posiada szereg opcji, które pozwalają dopasować sformatowany
raport wojenny do swoich potrzeb. Zostały one podzielone na dwie grupy:</p>
<center><table class="ciemna"><caption>Opcje podstawowe</caption><tbody><tr><td><img src="grafika/formularz01.png" alt="opcje podstawowe"><br></td></tr></tbody></table></center>
<ul type="disc">
<li><strong>POKAZUJ WSPÓŁRZĘDNE</strong> - określa, czy w sformatowanym raporcie wojennym mają być widoczne współrzędne biorących udział w bitwie osób. Jeśli przygotowujesz raport na forum Ogame, powinieneś pozostawić tę opcję odznaczoną.
<li><strong>POKAZUJ TECHNOLOGIE</strong> - określa, czy raport ma zawierać informacje o technologiach: bojowej, obronnej i opancerzeniu.
<li><strong>KOLORY</strong> - pozwala wybrać paletę barw, w której zostanie przygotowane RW.
</ul>
<p>Do opcji zaawansowanych dostęp uzyskuje się naciskając podpisany przycisk. W tej grupie ustawień znajdują się następujące opcje:<p>
<center><table class="ciemna"><caption>Opcje zaawansowane</caption><tbody><tr><td><img src="grafika/formularz02.png" alt="opcje zaawansowane"><br></td></tr></tbody></table></center>
<ul type="disc">
<li><strong>WERSJA</strong> - pozwala wybrać, z której wersji Formatrona chcesz skorzystać. Zwróć uwagę na to, że starsze wersje nie będą obsługiwały nowych opcji. Pozostawiam możliwość wyboru starszych wersji, na wypadek gdyby nowa z jakichś powodów nie działała.
<li><strong>OPIS BITWY</strong> - pozwala zastąpić domyślny komunikat "Po x zaciętych rundach" swoim własnym. Można stosować BBCode.<br>Działa od wersji 1.1.
<li><strong>POKAZUJ LINIĘ...</strong> - włącza/wyłącza wyświetlanie pierwszej linijki RW.<br>Działa od wersji 1.1.
<li><strong>POKAZUJ DATĘ STARCIA</strong> - działa tylko wtedy, gdy jest włączona opcja "POKAZUJ LINIĘ..." i pozwala zdecydować, czy data starcia ma być wyświetlona, czy ukryta.<br>Działa od wersji 1.1.
<li><strong>POKAZUJ CZAS STARCIA</strong> - działa tylko wtedy, gdy jest włączona opcja "POKAZUJ LINIĘ..." i pozwala zdecydować, czy godzina starcia ma być wyświetlona, czy ukryta.<br>Działa od wersji 1.1.
<li><strong>UWZGLĘDNIJ DEUTER...</strong> - w RW z Ogame podsumowanie strat uwzględnia tylko metal i kryształ. Jeśli zostawisz tą opcję włączoną, Formatron sam wyliczy ile surowców faktycznie straciła każda ze stron. Przy wyłączonej opcji, Formatron podaje wartości takie, jakie były w oryginalnym raporcie z Ogame.<br>Działa od wersji 1.1.
<li><strong>ROZPISZ NA SUROWCE</strong> - pozwala dodać informację o zysku/stratach w rozbiciu na poszczególne surowce. Informacja jest zapisywana w formacie: (metal/kryształ/deuter).<br>Działa od wersji 1.1.
<li><strong>ZAPISZ USTAWIENIA</strong> - pozwala zapamiętać twoje ustawienia w tzw. ciasteczkach. Dzięki temu, nie trzeba za każdym razem zmieniać ustawień ręcznie.
<li><strong>WCZYTAJ USTAWIENIA</strong> - wczytuje, zapisane wcześniej ustawienia. Ustawienia są również wczytywane, automatycznie, przy otwieraniu strony Formatrona.
</ul>
<h2>Formatowanie RW</h2>
<p>Aby sformatować raport wojenny należy skopiować całość raportu do schowka systemowego (CTRL+a, CTRL+c), wkleić go do okienka z napisem "Wklej swój raport" (CTRL+v), a następnie przycisnąć przycisk "Konwertuj".</p>

<p>Gotowy raport można skopiować z okienka pod napisem "Twoje RW". To jest jedyne miejsce, z którego należy kopiować RW.</p>

<p>Poniżej znajduje się podgląd sformatowanego RW. Nie kopiuj go, ponieważ nie zawiera znaczników BBCode i po wklejeniu na forum nie będzie widać kolorów.</p>
</td></tr>
<tr><td>
<a name="5"></a>
<h1>Prawa autorskie</h1>
<h2>Formatron</h2>
<pre>
 Formatron 1.0, 1.1 (c) Czuz 2007
 Oparte na rwkonw 0.5 (c) camera 2006

 Licencja: GNU GPL http://www.gnu.org/copyleft/gpl.html
</pre>
<h2>Strona</h2>
<pre> Copyright&copy; 2007 Czuz</pre>
</td></tr>
</table>
</center>
<?php
require_once("tail.php");
?>
