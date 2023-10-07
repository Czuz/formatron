#!/usr/bin/perl -Tw
###############
#
# RW konwerter do polskiej wersji OGAME
#
# Formatron 1.0 (c) Czuz 2006
# Oparte na rwkonw 0.5 (c) camera 2006
#
# Licencja: GNU GPL http://www.gnu.org/copyleft/gpl.html
# 
###############
use strict;
$ENV{PATH}='';
use CGI;

my $q=new CGI;
my %p=$q->Vars;
print $q->header('text/plain; charset=UTF-8');

my $wersja='1.0.4';
my $rundy=0;

my @wyroznienie = ( '4B0082', 'ff9900', '8080f0', '7B68EE' );
my @agresor = ( '4B0082', 'ccffcc', '8080f0', '7B68EE' );
my @obronca = ( '4B0082', 'eec273', '8080f0', '7B68EE' );

my %nazwy_flota = (
	"M.transp."	=> [ 1, "Mały transporter", 2000, 2000, 0,
			"2E8B57", "ff9900", "5F9EA0", "e43cb7" ],
	"D.transp."	=> [ 2, "Duży transporter", 6000, 6000, 0,
			"2E8B57", "00ff00", "5F9EA0", "c23ce4" ],
	"L.myśliw."	=> [ 3, "Lekki myśliwiec", 3000, 1000, 0,
			"2F4F4F", "33ff99", "90EE90", "743ce4" ],
	"C.mysliw."	=> [ 4, "Ciężki myśliwiec", 6000, 4000, 0,
			"2F4F4F", "ff00ff", "90EE90", "3c58e4" ],
	"Krazownik"	=> [ 5, "Krążownik", 20000, 7000, 2000,
			"4B0082", "00ffff", "40E0D0", "3cace4" ],
	"O.wojenny."	=> [ 6, "Okręt wojenny", 40000, 20000, 0,
			"191970", "ff9900", "66CDAA", "3ce4ba" ],
        "Recykler"	=> [ 7, "Recykler", 10000, 6000, 2000,
			"2E8B57", "0099ff", "5F9EA0", "3ce469" ],
	"St.kolon."	=> [ 8, "Statek kolonizacyjny", 10000, 20000, 10000,
			"2E8B57", "eec273", "5F9EA0", "69e43c" ],
        "So.szpieg."	=> [ 9, "Sonda szpiegowska", 0, 1000, 0, 
			"8B008B", "ff0099", "FFE4B5", "bde43c" ],
	"Bombowiec"	=> [ 10, "Bombowiec", 50000, 25000, 15000,
			"B22222", "00ff99", "FF7F50", "e4c03c" ],
	"Sat.slon."	=> [ 11, "Satelita słoneczny", 0, 2000, 500,
			"2E8B57", "00b0b0", "5F9EA0", "e46c3c" ],
	"Niszcz."	=> [ 12, "Niszczyciel", 60000, 50000, 15000,
			"B22222", "b000b0", "FF7F50", "e43c4a" ],
	"G.Smierci"	=> [ 13, "Gwiazda śmierci", 5000000, 4000000, 1000000,
			"FF0000", "a099ff", "FF4500", "e43ca1" ]
);
my %nazwy_obrona = (
	"Wyrz.rak"	=> [ 1, "Wyrzutnia rakiet", 2000, 0, 0,
			"2F4F4F", "a0ff99", "90EE90", "c23ce4" ],
	"L.laser"	=> [ 2, "Lekki laser", 1500, 500, 0,
			"2F4F4F", "ff99a0", "90EE90", "743ce4" ],
	"C.laser"	=> [ 3, "Ciężki laser", 6000, 2000, 0,
			"191970", "99ffa0", "66CDAA", "3cace4" ],
	"Gauss"		=> [ 4, "Działo gaussa", 20000, 15000, 2000,
	 		"B22222", "9900ff", "FF7F50", "3ce4ba" ],
	"Jon"		=> [ 5, "Działo jonowe", 2000, 6000, 0,
			"191970", "99a0ff", "66CDAA", "69e43c" ],
	"Plazma"	=> [ 6, "Wyrzutnia plazmy", 50000, 50000, 30000,
			"B22222", "ccffcc", "FF7F50", "bde43c" ],
	"M.powloka"	=> [ 7, "Mała powłoka", 10000, 10000, 0,
			"2E8B57", "ffcc99", "5F9EA0", "e46c3c" ],
	"D.powloka"	=> [ 8, "Duża powłoka", 50000, 50000, 0,
			"2E8B57", "ffcc99", "5F9EA0", "e43c4a" ]
);
#print "[b]Trwa przebudowa[/b]"; exit;
my $pokaz_koordy = $p{kordy} || $ARGV[0] || '0';#0 - nie pokazuj wspolzednych
my $pokaz_techy = $p{techy} || $ARGV[1] || '0';	#0 - nie pokazuj technologii
my $paleta = $p{paleta} || $ARGV[2] || '0';	#0 - jesna paleta
$paleta = 1 unless $paleta <= $#wyroznienie;

my (@flota_przed, @flota_po);
my @gracz;
my $kto_wygral=-1; #-1 jeszcze niewiadomo, 0-remis, 1-agr., 2-obr.
my $kto=0;
my $gracze_przetworzeni=0;
my $walka_skonczona=0;
my $na_planecie=0;
my @typy_statkow=[];
my @ilosci_statkow=[];

sub porzadek {
	my %tmp_tab = ( %nazwy_flota, %nazwy_obrona );
	$tmp_tab{$a}[0] <=> $tmp_tab{$b}[0];
}

sub czy_agresor {
	my ($kto) = @_;
	return ($gracz[$kto] =~ /^Agresor/);
}

sub czy_obronca {
	my ($kto) = @_;
	return !czy_agresor($kto);
}

sub commify {
	my $text = reverse $_[0];
	$text =~ s/(\d\d\d)(?=\d)(?!\d*\.)/$1./g;
	return scalar reverse $text;
}

sub przetworz_powitanie
{
	s/Starcie z //;
	my ($data,$godzina) = (split(/\s+/))[0,1];
	print "[size=11]Następujące floty [b]$data $godzina\[\/b] stanęły przeciwko sobie:\[\/size]\n\n";
	
}

sub przetworz_naglowek_gracza
{
	my ($linia,$kto) = @_;
	$linia =~ s/\s/ [b][color=#$obronca[$paleta]]/ if /^Obrońca/;
	$linia =~ s/\s/ [b][color=#$agresor[$paleta]]/ if /^Agresor/;
	$linia =~ s/\s\(/[\/color][\/b] (/;
	$linia =~ s/\(.*$// unless $pokaz_koordy;
	$gracz[$kto]=$linia;
	print $linia."\n";
}

sub przetworz_techy
{
	s/([0-9]+%)/[b]$1\[\/b]/g;
	print "[size=11]".$_."[/size]" if $pokaz_techy;
}

sub policz_statki
{
	my ($rtypy,$rilosci,$kto) = @_;
	
	my %tmp_hash;
	my @tmp_typ=@$rtypy;
	my @tmp_il=@$rilosci;

	#wazne: $i=1 bo przetwarzamy od drugiej pozycji!
	for (my $i=1; $i<=$#tmp_typ; $i++) {
		$tmp_hash{$tmp_typ[$i]}=$tmp_il[$i];
	}

	$flota_przed[${$kto}] = \%tmp_hash unless $gracze_przetworzeni;
	$flota_po[${$kto}] = \%tmp_hash;
}

sub pokaz_floty
{
	my ($kto) = @_;
	my (%tmp,%tmp_x);
	my ($flota,$obrona)=("","");

	%tmp_x=%{$flota_przed[$kto]};

	if ($kto_wygral > -1) {
		%tmp=%{$flota_po[$kto]};
	}
	
	foreach my $klucz (sort porzadek keys %tmp_x) {
		#uzupelniamy hasza zerami jesli nie ma wartosci 
		#czyli jesli stacony wsyzstkie jednostki danego typu
		$tmp{$klucz}=0 if $tmp_x{$klucz} and !$tmp{$klucz};
		
		my $strata=$tmp{$klucz}-$tmp_x{$klucz};
		my $tmp_str='';

		#pisanie punkcika z nastepnego koloru palety
		if ($nazwy_obrona{$klucz}) {
			$tmp_str='[color=#'.$nazwy_obrona{$klucz}[$paleta+5].']" ';
		} elsif ($nazwy_flota{$klucz}) {
			$tmp_str='[color=#'.$nazwy_flota{$klucz}[$paleta+5].']" ';
		} else {
			$tmp_str.='[color=#'.$wyroznienie[$paleta].']" ';
		}

		#wypisanie nazwy jednostki ze słownika
		if ($nazwy_obrona{$klucz}) {
			$tmp_str.=$nazwy_obrona{$klucz}[1];
		} elsif ($nazwy_flota{$klucz}) {
			$tmp_str.=$nazwy_flota{$klucz}[1];
		} else { #dziwny przypadek braku w slowniku
			$tmp_str.=$klucz;
		}
		
		$tmp_str.=': ';
		
		#ilosc jednostek floty po bitwie...
		if ($kto_wygral > -1) {
			#jesli pozostało 0 to piszemy "zniszczone"
			if ($tmp{$klucz}) {
				$tmp_str.=$tmp{$klucz};
			} else {
				$tmp_str.="zniszczone";
			}
		#i przed bitwą
		} else {
			$tmp_str.=$tmp_x{$klucz};
		}
			
		$tmp_str.='[/color] ';

		#jestli jest po bitwie wypisujey ilość strat
		if ($kto_wygral != -1 && $strata) {
			$tmp_str.='[color=#ff0000]['.$strata.'][/color]';
		}

		if ($nazwy_obrona{$klucz}) {
			$obrona.=$tmp_str."\n";
		} else {
			$flota.=$tmp_str."\n";
		}
	}
	
	#agresor zniszczony calkowicie
	if ($kto_wygral == 2 and czy_agresor($kto)) {
		print "[list][color=#ff0000][b]zniszczony[/b][/color][/list]\n";
	#obronca zniszczony calkowicie
	} elsif ($kto_wygral == 1 and czy_obronca($kto)) {
		print "[list][color=#ff0000][b]zniszczony[/b][/color][/list]\n";
	#remis albo obrabiamy zwycięsce albo walka nierostrzygnięta jeszcze..
	} else {
	
		print "[list]";
		print "[b]Flota:[/b] ";# if $kto == 2;
		if ($flota) {
			print "\n".$flota;
		} else {
			print "brak\n";
		}
		if ($kto > 1 && czy_obronca($kto) && !czy_obronca($kto-1)) {
			print "[b]Obrona:[/b] ";
			if ($obrona) {
				print "\n".$obrona;
			} else {
				print "brak\n";
			}
		}
		print "[/list]";
	}
}

my $tmp_rw=$p{rw};
$tmp_rw=~s/(%\s*Typ)/%\nTyp/g;
$tmp_rw=~s/(\d)\.(\d)/$1$2/g;
$tmp_rw=~s/(\)\s*Typ)/\)\nTyp/g;
my @rw=split("\n",$tmp_rw);

#najpierw nagłówki i powtanie
while ($_=$rw[0]) {
	if (/(^Flota agresora strzeliła|wygrał bitwę|bez rozstrzygnięcia)/) {
		$gracze_przetworzeni=1;
		last;
	}

	przetworz_powitanie($_) if /Starcie z /;

	$kto+=1 if /^(Agresor|Obrońca) .+\(.+\)/ && $rundy == 0;
	przetworz_naglowek_gracza($_,$kto) if /^(Agresor|Obrońca) .+\(.+\)/;

	przetworz_techy($_) if /^Broń:/;

	if (/^Typ/) {
		@typy_statkow= split (/\s+/);
	}

	if (/^Il\./ or /zniszcz/i) {

		if (/zniszcz/i) {
			#obronca zniszczony w 1 rundzie - farmienie
			@ilosci_statkow=[];
			@typy_statkow=[];
		} else {
			@ilosci_statkow= split (/\s+/);
		}

		policz_statki(\@typy_statkow,\@ilosci_statkow,\$kto);
		pokaz_floty($kto);
	}

	shift @rw;
}

#walka
while ($_=$rw[0]) {
	if (/(wygrał bitwę|bez rozstrzygnięcia)/) {
		if ($rundy == 0) {
			print "[i]Bez walki...[/i]\n\n";
		} elsif ($rundy == 1) {
			print "[i]Po ",$rundy," zaciętej rundzie...[/i]\n\n";
		} else {
			print "[i]Po ",$rundy," zaciętych rundach...[/i]\n\n";
		}
		$kto_wygral=1 if /^Agresor/;
		$kto_wygral=2 if /^Obrońca/;
		$kto_wygral=0 if /^Bitwa/;
		for (my $i=1; $i<=$#gracz; $i++) {
			print $gracz[$i];
			pokaz_floty($i);
		}
		print;
		shift @rw;
		last;
	}

	$kto+=1 if /^(Agresor|Obrońca) .+\(.+\)/;

	if (/^Zniszcz/) {
		@typy_statkow= [];
		@ilosci_statkow= [];
		policz_statki(\@typy_statkow,\@ilosci_statkow,\$kto);
	}
	
	@typy_statkow= split (/\s+/) if /^Typ/;

	if (/^Il\./) {
		@ilosci_statkow= split (/\s+/);
		policz_statki(\@typy_statkow,\@ilosci_statkow,\$kto);
	}

	if (/^Flota agresora strzeliła/) {
	        $rundy++;
	        $kto=0;
	}

	shift @rw;
	
}

#podsumowanie
my ($zlom_metal,$zlom_krysia,$szansa,$m,$k,$d) = (0,0,0,0,0,0);
my $przedliczb='[b][color=#'.$wyroznienie[$paleta].']';
my $policzb='[/color][/b]';
my $zlomwlasny=0;

while ($_=$rw[0]) {
	#s/^(.*)$/\[b\]$1\[\/b\]/ if /^Olbrzymie/;
	
	if (/^Na tych wsp/) {
		($zlom_metal,$zlom_krysia) = (split(/\s+/))[6,9];
		$szansa=sprintf "%.2f", (($zlom_metal+$zlom_krysia)/100000);
	}

	#początek od liczby, czyli linijka z farmieniem
	($m,$k,$d) = (split(/\s+/))[0,2,5] if (/^\d+\s+metalu/);
	$m = ($m < 0 ) ? 0 : $m;
	$k = ($k < 0 ) ? 0 : $k;
	$d = ($d < 0 ) ? 0 : $d;

	if ($kto_wygral == 1) {
		if (/^Agresor stracił/) {
			$zlomwlasny=(split(/\s+/))[3];
		}
	} elsif ($kto_wygral == 2) {
		if (/^Obrońca stracił/) {
			$zlomwlasny=(split(/\s+/))[3];
		}
	}

	#pogrubiamy i kolorujemy liczby oraz dodajemy przecinki
	foreach my $wyraz (split(/\s+/)) {
		my $liczba=$wyraz;
		if ($wyraz =~ /^\d+$/ or $wyraz =~ /^-\d+$/) {
			$liczba = commify($liczba);
			if ($wyraz > 10000000) {
				#megazłom
				$liczba= '[b][color=#f00000]'.
					$liczba.'[/color][/b]';
			} else {
				$liczba=$przedliczb.$liczba.$policzb;
			}
			s/$wyraz /$liczba /;
		}
	}
				
	s/%/% [color=#F00000][b]($szansa %)[\/b][\/color]/
		if /^Szansa/;

	if (/^Szansa/) {
		s/^/\n$1\n/;
		$na_planecie =1;
	}

	if (/^Olbrzymie/) {
		s/księżyc/[b]księżyc[\/b]/;
		$_.="\n[color=#F00000][b]Księżyc został dany...[/b][/color]\n";
	}
	
	shift @rw;
	next if /naprawi/;
	
	print;# $_."\n";;
}

if (!$na_planecie and int($szansa) > 0) {
print "\n\nSzansa na powstanie księżyca wynosi ",
	"$przedliczb", ($szansa > 20) ? 20 : int($szansa), "$policzb %",
       	" [color=#F00000][b]($szansa %)[\/b][\/color]",
	" [Choć i tak bitwa na księżycu się odbyła]\n";
}

print "\n" if $szansa == 0;
print "\nTeoretyczny zysk zwycięzcy wynosi ",
	$przedliczb,
	commify($m+$k+$d+$zlom_metal+$zlom_krysia-$zlomwlasny),
	$policzb,
	" jednostek. Farmienie ",
	$przedliczb,
	commify($m+$k+$d),
	$policzb,
	", zbiórka złomu ",
	$przedliczb,
	commify($zlom_metal+$zlom_krysia-$zlomwlasny),
	$policzb if $kto_wygral;

print "\n[size=9][ [url=https:\/\/github.com\/Czuz\/formatron\/]Formatron $wersja\[\/url] ][\/size]\n";
