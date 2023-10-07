<?php
/*
	Easyboard Version 3.4
	written by Christian Heilmann
	Homepage:http://www.onlinetools.org/

	Do not change any code here, the whole functionality is triggered by 
	comments in the HTML Template!
	requires entries.xml and guestbook_template.html to work.
*/


$action=$_GET['action'];
if ($_POST['action']!="") {$action=$_POST['action'];}
$start=$_GET['start'];
$action=strip_tags($action);
$start=strip_tags($start);

$HTML=load("easyboard_template.html");

preg_match("/<!-- dateformat:(.*?) -->/",$HTML,$dateformat);
if($dateformat[1]==""){$dateformat = "M d Y H:i:s";}
else {$dateformat = $dateformat[1];}

if ($action==''){
	echo displaysetup("invalidemail,forgottenfields,thanks,form,display,spam");
}

if ($action=="view"){
	$gb=load("easyboard_entries.xml");
	if (untag($gb,"entry",1)!=""){
	$HTML=displaysetup("invalidemail,forgottenfields,thanks,form,hello,spam");
	preg_match_all("/<!-- start:item -->(.*?)<!-- end:item -->/si",$HTML,$item);	
	$entries=array_reverse(untag($gb,"entry",1));
	preg_match_all("/%(.*?)%/",$item[1][0],$vars);
	preg_match("/<!-- increase:(.*?) -->/si",$HTML,$inc);	
	if ($inc[1]==""){$increase=sizeof($entries);}
	else{$increase=$inc[1];}
	if(!$start){$start=0;}
	$end=$start+$increase;
	if ($start >= $increase){
	preg_match_all("/<!-- start:back -->(.*?)<!-- end:back -->/si",$HTML,$back);	
	$back=$back[1][0];
	$back=preg_replace("/backurl/",$PHP_SELF."?action=view&amp;start=".($start-$increase),$back);
	$HTML=preg_replace("/<!-- start:back -->(.*?)<!-- end:back -->/si",$back,$HTML);	
	}
	else {$HTML=preg_replace("/<!-- start:back -->(.*?)<!-- end:back -->/si","",$HTML);}
	if ($end < sizeof($entries)){
	preg_match_all("/<!-- start:next -->(.*?)<!-- end:next -->/si",$HTML,$back);	
	$back=$back[1][0];
	$back=preg_replace("/nexturl/si",$PHP_SELF."?action=view&amp;start=".($start+$increase),$back);
	$HTML=preg_replace("/<!-- start:next -->(.*?)<!-- end:next -->/si",$back,$HTML);	
	}
	else {$HTML=preg_replace("/<!-- start:next -->(.*?)<!-- end:next -->/si","",$HTML);}
	$disp=array_slice($entries,$start,$increase);
	$htmlinclude="";
	foreach ($disp as $e){
		$ditem=$item[1][0];
		foreach ($vars[1] as $v){
			$con=untag($e,$v,0);
			$ditem=preg_replace("/%".$v."%/si",stripslashes(nl2br($con)),$ditem);	
		}
		if (preg_match("/<!-- spamprotect -->/si",$HTML)){$ditem=preg_replace("/@/si","@_nospam_",$ditem);}
		$htmlinclude.= $ditem;
	}
	$HTML=preg_replace("/<!-- start:item -->.*?<!-- end:item -->/si",$htmlinclude,$HTML);	
	}
	else {
	$HTML=displaysetup("invalidemail,forgottenfields,thanks,form,display,spam");
	}
	echo $HTML;
}
if ($action=="sign"){
	$HTML=displaysetup("invalidemail,forgottenfields,thanks,display,hello,spam");
	$HTML=preg_replace("/%.*%/","",$HTML);
	echo $HTML;
}
if ($action=="verify"){
	$keys=array_keys($_POST);
	for ($i=0;$i<count($_POST);$i++){
		$HTML=preg_replace("/%".$keys[$i]."%/si",stripslashes($_POST[$keys[$i]]),$HTML);
	}
	$req=explode(",",$_POST['required']);
	foreach ($req as $r){
		if ($_POST[$r]==""){
			$errorfields[]=$r;
		}	
	}
/*
	
                              ZZZzz    |\      _,,,---,,_
Sometimes when I look at the       z   /,`.-'`'    -.  ;-;;,_.
amount of work on my schedule       zz|,4-  ) )-,_. ,\ (  `'-'
I wish that I was born a cat         '---''(_/--'  `-'\_)     
*/

	$HTML=displaysetup("display,hello");
	if ($errorfields[0]!=""){
		$inc="<ul>";
		foreach ($errorfields as $e){$inc.="<li>$e</li>";}
		$inc.="</ul>";
		$HTML=preg_replace("/<!-- fields -->/si",$inc,$HTML);
		$HTML=displaysetup("spam,thanks");
	}
	else {$HTML=displaysetup("forgottenfields");}
	if (checkmail($_POST['email'])){$HTML=displaysetup("invalidemail");}
	if (checkmail($_POST['email']) and $errorfields[0]==""){
		$gb=load("easyboard_entries.xml");
		$id=count(untag($gb,"entry",1));
		$allentries=untag($gb,"entry",1);
		if ($id==1 and $allentries[0]==""){$id=1;}
		else {$id++;}
		$data="\n<entry>";
		$data.="\n\t<entryid>$id</entryid>";
		$data.="\n\t<entrydate>".date ($dateformat)."</entrydate>";
		$mail.="New Entry id:$id\nDate:".date ($dateformat)."\n";
		$keys=array_keys($_POST);
		for ($i=0;$i<count($_POST);$i++){
			if ($keys[$i]!="required" and $keys[$i]!="action"){
			$data.="\n\t<".$keys[$i].">".htmlspecialchars(stripslashes($_POST[$keys[$i]]),ENT_QUOTES)."</".$keys[$i].">";
			$mail.="\n".$keys[$i].":".stripslashes($_POST[$keys[$i]]);
			}
		}
		$data.="\n</entry>";
		$preg="/\s|<entry>|<\/entry>|<entryid>.*?<\/entryid>|<entrydate>.*?<\/entrydate>/si";
		if(preg_replace($preg,"",$data) == preg_replace($preg,"",$allentries[count($allentries)-1])){$HTML=displaysetup("thanks,form");}
		else{save ("easyboard_entries.xml",preg_replace("/<\/guestbook>/","".$data."\n</guestbook>",$gb));
		$HTML=displaysetup("spam,form");
			if (preg_match("/<!-- owner:.*? -->/si",$HTML)){
				preg_match_all("/<!-- owner:(.*?) -->/si",$HTML,$owner);
				$mailheaders = "From: Easyboard\n";
				$mailheaders .= "Reply-To: $email\n";
				mail ($owner[1][0],"New entry in the Guestbook!",$mail,$mailheaders);
			}
		}
	}
	if (!checkmail($_POST['email'])){$HTML=displaysetup("spam,thanks");}
	echo preg_replace("/<!--.*?-->/","",$HTML);
}

function displaysetup($fields){
	global $HTML;
	$fields=explode(",",$fields);
	foreach ($fields as $f){
		$HTML=preg_replace("/<!-- start:".$f." -->.*?<!-- end:".$f." -->/si","",$HTML);
	}
	return $HTML;
}

/*
	Function urlize($name)
	checks if the submitted string is a valid email and returns a boolean
*/
function checkmail($string){
	global $HTML;
	if (preg_match("/<!-- nomailcheck -->/",$HTML)){return true;}
	return preg_match("/^[^\s()<>@,;:\"\/\[\]?=]+@\w[\w-]*(\.\w[\w-]*)*\.[a-z]{2,}$/i",$string);
}

/*
	Function urlize($name)
	converts an item name into a url na,e
*/
function urlize($name){
	return strtolower(preg_replace("/[^\w\.]/","",$name));
}

/*
	Function load($file)
	reads the content of the file that you send and returns it
*/
function load($filelocation){
	if (file_exists($filelocation)){
		$newfile = fopen($filelocation,"r");
		$file_content = fread($newfile, filesize($filelocation));
		fclose($newfile);
		return $file_content;
		}
	}

/*
	Function save($file,$content)
	writes the content to the file and generates it if needed
*/
function save($filelocation,$newdatas){
	$newfile = @fopen($filelocation,"w+");
	@fwrite($newfile, $newdatas);
	@fclose($newfile);
	if($newfile!=""){$fileerror=0;}
	else {$fileerror=1;}
	return $fileerror;
	}

/*
	Function untag($string,$tag,mode){
	written by Chris Heilmann (info@_nospam_onlinetools.org)
	filters the content of tag $tag from $string 
	when mode is 1 the content gets returned as an array
	otherwise as a string
*/
function untag($string,$tag,$mode){
	if($mode==1)
		$tmpval=[];
	else
		$tmpval="";
	$preg="/<".$tag.">(.*?)<\/".$tag.">/si";
	preg_match_all($preg,$string,$tags); 
	foreach ($tags[1] as $tmpcont){
		if ($mode==1){$tmpval[]=$tmpcont;}
		else {$tmpval.=$tmpcont;}
		}
	return $tmpval;
}	

?>
