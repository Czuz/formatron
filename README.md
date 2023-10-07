# O Formatronie
Formatron był w latach 2006-2008 narzędziem do konwersji raportów wojennych (RW) z polskich serwerów gry internetowej Ogame. Sformatowane RW były gotowe do skopiowania i wklejenia na forach i w systemach portalowych obsługujących BBCode.

Wydobyłem niniejsze kody źródłowe z otchłani niebytu w ramach sentymentalnych podróży wgłąb starych dysków. Postanowiłem choć na chwilę przywrócić do życia ten hobbystyczny projekt ze studenckich czasów trenując przy tej okazji konteneryzację.

Jeżeli korzystałeś kiedyś z tego narzędzia, zostaw komentarz lub gwiazdkę.

# Jak uruchomić?
Na maszynie z zainstalowanym Dockerem oraz klientem GIT należy wykonać poniższe polecenia:
```
git clone git@github.com:Czuz/formatron.git
cd formatron
docker build -t formatron .
docker run -d -p 80:80 formatron:latest
```

Po uruchomieniu kontenera narzędzie będzie dostępne z poziomu tej maszyny pod adresem http://localhost/.

Możesz je przetestować formatując [przykładowy raport](https://github.com/Czuz/formatron/blob/main/przyklad.txt) z tamtych czasów.

# Prawa Autorksie
## Formatron
```
Formatron 1.0, 1.1 (c) Czuz 2007
Oparte na rwkonw 0.5 (c) camera 2006
```

Licencja: GNU GPL http://www.gnu.org/copyleft/gpl.html

## Strona
```
Copyright© 2007 Czuz
```

Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE

Wykorzystane komponenty:
* Easyboard Version 3.4 written by Christian Heilmann. Homepage: http://www.onlinetools.org/
* Parser BBCode wygenerowany przez http://bbcode.strefaphp.net/bbcode.php
