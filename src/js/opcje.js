/*
 * Copyright© 2007 Czuz
 * Licencja: MIT Licence https://github.com/Czuz/formatron/blob/main/LICENSE
 */
function setCookie(name, value, expires, path, domain, secure)
{
	if (!expires) {
		expires = new Date();
		expires.setFullYear(expires.getFullYear() + 1);
	}
    document.cookie= name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires.toGMTString() : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function getCookie(Name) {
	var search = Name + "="
	var returnvalue = "";
	if (document.cookie.length > 0) {
		offset = document.cookie.indexOf(search)
		// if cookie exists
		if (offset != -1) {
			offset += search.length
			// set index of beginning of value
			end = document.cookie.indexOf(";", offset);
			// set index of end of cookie value
			if (end == -1) end = document.cookie.length;
				returnvalue=unescape(document.cookie.substring(offset, end))
		}
	}
	return returnvalue;
}

function weryfikuj() {
	var wersja = document.getElementById("opt04").value;

	document.getElementById("opt05").disabled = false;
	document.getElementById("opt06").disabled = false;
	document.getElementById("opt07").disabled = false;
	document.getElementById("opt08").disabled = false;
	document.getElementById("opt09").disabled = false;
	document.getElementById("opt10").disabled = false;

	if (wersja > 1) {
		document.getElementById("opt04").value = 1;
	}

	if (wersja < 1) {
		document.getElementById("opt05").disabled = true;
		document.getElementById("opt06").disabled = true;
		document.getElementById("opt07").disabled = true;
		document.getElementById("opt08").disabled = true;
		document.getElementById("opt09").disabled = true;
		document.getElementById("opt10").disabled = true;
	}

	if (!document.getElementById("opt06").checked) {
		document.getElementById("opt07").checked = false;
		document.getElementById("opt07").disabled = true;
		document.getElementById("opt08").checked = false;
		document.getElementById("opt08").disabled = true;
	}
}

function zapisz_opcje() {
	var opcje = new Array();

	opcje.push(document.getElementById("opt01").checked);
	opcje.push(document.getElementById("opt02").checked);
	opcje.push(document.getElementById("opt03").value);
	opcje.push(document.getElementById("opt04").value);
	opcje.push(document.getElementById("opt05").value);
	opcje.push(document.getElementById("opt06").checked);
	opcje.push(document.getElementById("opt07").checked);
	opcje.push(document.getElementById("opt08").checked);
	opcje.push(document.getElementById("opt09").checked);
	opcje.push(document.getElementById("opt10").checked);
	setCookie('opcje', opcje.toString());
}

function wczytaj_opcje() {
	var ciacho = getCookie('opcje');
	if (!ciacho) {
		weryfikuj();
		return;
	}

	var opcje = ciacho.split(',');
	opcje = opcje.reverse();
	document.getElementById("opt01").checked = (opcje.pop() == 'true');
	document.getElementById("opt02").checked = (opcje.pop() == 'true');
	document.getElementById("opt03").value = opcje.pop();
	document.getElementById("opt04").value = opcje.pop();
	document.getElementById("opt05").value = opcje.pop();
	document.getElementById("opt06").checked = (opcje.pop() == 'true');
	document.getElementById("opt07").checked = (opcje.pop() == 'true');
	document.getElementById("opt08").checked = (opcje.pop() == 'true');
	document.getElementById("opt09").checked = (opcje.pop() == 'true');
	document.getElementById("opt10").checked = (opcje.pop() == 'true');
	weryfikuj();
}

onload=wczytaj_opcje;
