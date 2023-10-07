function sprawdz_www() {
	var www = new String();
	www = document.getElementById('www').value;

	if (www.indexOf('http')!=0 && !www.match(/^$/)) {
		www=www.replace(/^/,'http:\/\/');
		document.getElementById('www').value = www;
	}
}
