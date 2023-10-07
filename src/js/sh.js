function ShowHide(id) {
	if (obj=document.getElementById(id)) {
		if (!obj.style.display || obj.style.display == "none"){
			obj.style.display = "block";
		} else {
			obj.style.display = "none";
		}
	} else { document.writeln("Brak elementu o identyfikatorze: "+id); }
}
