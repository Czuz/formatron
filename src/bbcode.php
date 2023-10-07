<?php
/* Skrypt wygenerowany przez http://bbcode.strefaphp.net/bbcode.php */

// bbcode
Function bbcode($str){

// usun zbedne
$str=htmlspecialchars(trim($str));

// Odnośnik, otwieranie w nowym oknie
$str = preg_replace("#\[url\](.*?)?(.*?)\[/url\]#si", "<a class=\"link\" href=\"\\1\\2\" >\\1\\2</A>", $str);

// Odnośnik, otwieranie w nowym oknie, definiowanie treści odnośnika
$str = preg_replace("#\[url=(.*?)?(.*?)\](.*?)\[/url\]#si", "<a class=\"link\" href=\"\\2\" >\\3</A>", $str);

// Automatyczne tworzenie linków
$str = preg_replace_callback("#([\n ])([a-z]+?)://([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]+)#si", "bbcode_autolink", $str);
$str = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]*)?)#i", " <a class=\"link\" href=\"http://www.\\2.\\3\\4\" target=\"_blank\">www.\\2.\\3\\4</a>", $str);
$str = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+)#i", "\\1<a class=\"link\" href=\"javascript:mailto:mail('\\2','\\3');\">\\2_(at)_\\3</a>", $str);

// Pogrubiony tekst
$str = preg_replace("#\[b\](.*?)\[/b\]#si", "<b>\\1</b>", $str);

// Pochylony tekst
$str = preg_replace("#\[i\](.*?)\[/i\]#si", "<i>\\1</i>", $str);

// Podkreślony tekst
$str = preg_replace("#\[u\](.*?)\[/u\]#si", "<u>\\1</u>", $str);

// Wyśrodkowanie tekstu
$str = preg_replace("/\[center\](.*?)\[\/center\]/si", "<center>\\1</center>", $str);

// Kolor tekstu
$str = preg_replace("#\[color=(http://)?(.*?)\](.*?)\[/color\]#si", "<span style=\"color: \\2\">\\3</span>", $str);

// Wielkość czcionki
$str = preg_replace("#\[size=(http://)?(.*?)\](.*?)\[/size\]#si", "<span style=\"font-size: \\2px;\">\\3</span>", $str);

// Kroj czcionki
$str = preg_replace("#\[font=(http://)?(.*?)\](.*?)\[/font\]#si", "<span style=\"font-family: \\2;\">\\3</span>", $str);

// Obrazek
$str = preg_replace("#\[img\](.*?)\[/img\]#si", "<img src=\"\\1\" border=\"0\" alt=\"Obrazek\" />", $str);

// Znaki specjalne
// znaki specjalne
$str = str_replace('&amp;plusmn;', '&plusmn;', $str);
$str = str_replace('&amp;trade;', '&trade;', $str);
$str = str_replace('&amp;bull;', '&bull;', $str);
$str = str_replace('&amp;deg;', '&deg;', $str);
$str = str_replace('&amp;copy;', '&copy;', $str);
$str = str_replace('&amp;reg;', '&reg;', $str);
$str = str_replace('&amp;hellip;', '&hellip;', $str);

// błędne kodowanie m.in. z phpmyadmina
$str = str_replace('&amp;#261;', 'ą', $str);
$str = str_replace('&amp;#263;', 'ć', $str);
$str = str_replace('&amp;#281;', 'ę', $str);
$str = str_replace('&amp;#322;', 'ł', $str);
$str = str_replace('&amp;#347;', 'ś', $str);
$str = str_replace('&amp;#378;', 'Ľ', $str);
$str = str_replace('&amp;#380;', 'ż', $str);

// znaki specjalne z m$ word
$str = str_replace('&amp;#177;', 'ą', $str);
$str = str_replace('&amp;#8217;', '\'', $str);
$str = str_replace('&amp;#8222;', '"', $str);
$str = str_replace('&amp;#8221;', '"', $str);
$str = str_replace('&amp;#8220;', '"', $str);
$str = str_replace('&amp;#8211;', '-', $str);
$str = str_replace('&amp;#8230;', '&hellip;', $str);

// Lista
$str = preg_replace("#\[list\](.*?)\[/list\]#si", "<ul>\\1</ul>", $str);
$str = preg_replace("#\[list=(http://)?(.*?)\](.*?)\[/list\]#si", "<ol type=\"\\2\">\\3</ol>", $str);
$str = preg_replace("#\[\*\](.*?)\\s#si", "<li>\\1</li>", $str);

// Odnośnik e-mail
$str = preg_replace("#\[email\]([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#i", "<a class=\"link\" href=\"mailto:\\1@\\2\">\\1@\\2</a>", $str);

// Odnośnik e-mail(własne definiowanie wyświetlanego tekstu)
$str = preg_replace("#\[email=([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+)?(.*?)\](.*?)\[/email\]#i", "<a class=\"link\" href=\"mailto:\\1@\\2\">\\5</a>", $str);

// kolejny wiersz
$str=nl2br($str);

// js
$str = preg_replace_callback("#\<(.*?)javascript(.*?)\>#si", "bbcode_js", $str);

// wynik
return $str;}


function bbcode_autolink($str){
$lnk=$str[3];
if(strlen($lnk)>30){
if(substr($lnk,0,3)=='www'){$l=9;}else{$l=5;}
$lnk=substr($lnk,0,$l).'(...)'.substr($lnk,strlen($lnk)-8);}
return ' <a clas=\"link\" href="'.$str[2].'://'.$str[3].'" target="_blank">'.$str[2].'://'.$lnk.'</a>';}

// anti js
Function bbcode_js($str){
if(!preg_match('#<a class=\"link\" href=\"javascript:mailto:mail\(\'#i',$str[0])){
return str_replace('javascript','java_script',$str[0]);
}else{return $str[0];}}
?>
