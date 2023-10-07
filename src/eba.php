<?php
/* 
	Admin for Easyboard 
	written by Christian Heilmann
*/
$action=$_GET['action'];
$id=$_GET['id'];
$action=strip_tags($action);
$id=strip_tags($id);
$self=$HTTP_SERVER_VARS["PHP_SELF"];
$data=load("easyboard_entries.xml");
$entries=untag($data,"entry",1);
if ($_POST['edited']=="change"){
	$gb="<?xml version=\"1.0\"?>\n";
	$gb.="\n\t<guestbook>";
	$id=$_POST['entryid'];
	if($entries[0]!=''){foreach ($entries as $k=>$e){
		if (untag($e,"entryid",0)!=$id){
			$gb.="\n\t<entry>";
			$gb.=$e;
			$gb.="\n\t</entry>";
		}
		else {
			$gb.="\n\t<entry>";
			$keys=array_keys($_POST);
			for ($i=0;$i<count($_POST);$i++){
				if ($keys[$i]!="edited"){
					$gb.= "\n\t<".$keys[$i].'>'.stripslashes(htmlspecialchars($_POST[$keys[$i]],ENT_QUOTES)).'</'.$keys[$i].'>';
				}
			}
			$gb.="\n\t</entry>";
		}
	}}
	$gb.="\n\t</guestbook>";
	$data=save("easyboard_entries.xml",$gb);
	$self=explode("/",$self);
	header("Location:".$self[count($self)-1]);
}
if ($action=="del"){
	$gb="<?xml version=\"1.0\"?>\n";
	$gb.="\n\t<guestbook>";
	$k=0;
	if($entries[0]!=''){foreach ($entries as $e){
		if (untag($e,"entryid",0)!=$id){
			$k++;
			$gb.="\n\t<entry>";
			$gb.=rtrim(preg_replace("/<entryid>.*?<\/entryid>/","<entryid>$k</entryid>",$e));
			$gb.="\n\t\t</entry>";
		}
	}}
	$gb.="\n\t</guestbook>";
	$data=save("easyboard_entries.xml",$gb);
	$self=explode("/",$self);
	header("Location:".$self[count($self)-1]);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Easyboard admin</title>
<style type="text/css">
	body {
		background:#cccccc;
		font-family:verdana,sans serif;
		font-size:1em;
		color:#333333;
		font-weight:bold;
	}
	td {
		font-weight:bold;
		background:#eeeeee;
		color:#333333;
		padding:5px;
		font-family:verdana,sans serif;
		font-size:x-small;
	}
	.entry {
		font-weight:normal;
		background:#eeeeee;
		color:#333333;
		padding:5px;
		border-top:none;
		border-left:1px solid #333333;
		border-right:1px solid #333333;
		border-bottom:1px solid #333333;
		font-family:verdana,sans serif;
		font-size:x-small;
	}
	.del {
		background:#eeeeff;
		padding:5px;
		border-top:1px solid #333333;
		border-left:1px solid #333333;
		border-right:1px solid #333333;
		border-bottom:1px solid #333333;
		font-family:verdana,sans serif;
		font-size:x-small;
	}
	a{
		font-family:verdana,sans serif;
		font-size:x-small;
		color:#336699;
		text-decoration:none;
	}
</style>
</head>

<body>
<?php
if (!$action or $action!="del" and $action!="edit"){
	echo "<html><head><meta http-equiv=\"expires\" content=\"Fri, 5 Apr 1996 23:59:59 GMT\"></head><body>This is the admin part of easyboard, simply click the delete links to delete or edit to edit the entry.<br><br>";
	if($entries[0]!=''){foreach ($entries as $e){
		echo "<div class=\"del\"><a href=\"$self?action=del&id=".untag($e,"entryid",0)."\">delete</a>|<a href=\"$self?action=edit&id=".untag($e,"entryid",0)."\">edit</a></div>";
		echo "<div class=\"entry\">";
		preg_match_all("/<(.*?)>(.*?)<\/.*?>/si",$e,$item);	
		foreach ($item[1] as $f=>$i){
			if ($i != "entryid"){echo "<strong>".$item[1][$f]."</strong>: ".nl2br($item[2][$f])."<br>";}
		}
		echo "</div><br>";
	}}
}
if ($action=="edit"){
	if($entries[0]!=''){foreach ($entries as $k=>$e){
		if (untag($e,"entryid",0)==$id){
			echo '<form method="post" action="'.$self.'">';
			echo '<input name="entryid" type="hidden" value="'.untag($e,"entryid",0).'">';
			echo '<input name="entrydate" type="hidden" value="'.untag($e,"entrydate",0).'">';
			echo '<table border="0"><tr><td colspan="2">Please edit the entry:</td></tr>';
			preg_match_all("/<(.*?)>(.*?)<\/.*?>/si",$e,$item);	
			foreach ($item[1] as $f=>$i){
				if ($i != "entryid" and $i!="entrydate"){
				echo '<tr>';
				echo '<td valign="top">'.$item[1][$f].'</td><td>';
				if (strlen($item[2][$f]) < 50){ 
					echo '<input type="text" name="'.$item[1][$f].'" value="'.$item[2][$f].'">';
					}
				else {
					echo '<textarea cols="60" rows="6" name="'.$item[1][$f].'">'.$item[2][$f].'</textarea>';
				}
				echo '</td></tr>';
				}
			}
			echo '<tr><td colspan="2" align="right"><input type="submit" value="change" name="edited">';
			echo '</td></tr></table>';
			echo '</form>';
		}
	}}
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
</body>
</html>
