function aff_del() {
	document.getElementById("button_del").removeAttribute('hidden');
}

function mask_del() {
	document.getElementById("button_del").setAttribute('hidden', true);
}

function supp_select(img) {
	if (img.classList.value === 'choosen') {
		img.setAttribute('class', '');
	}
	else {
		img.setAttribute('class', 'choosen');
	}
	var choosen = document.getElementsByClassName('choosen');
	if (choosen) {
		aff_del();
	}
	else {
		mask_del();
	}
}

function supp_choosen() {
	var choosen = document.getElementsByClassName('choosen');
	if (choosen.length === 0) {
		alert("Veuillez selectionnez les elements a supprimer en cliquant dessus !");
	}
	else {
		var data = new FormData();
		for (var i = 0; i < choosen.length; i++) {
			data.append(i, choosen[i].src);
		}
		var ajax = getHttpRequest();
		ajax.open('POST', 'http://localhost:8080/openclass/rendu/supp_montage.php', true);
		ajax.setRequestHeader('X-Requested-With', 'xmlhttprequest');
		ajax.send(data);
		ajax.onreadystatechange = function () {
			if (ajax.readyState === 4) {
				if (ajax.status === 200) {
					for (var i = 0; i < choosen.length; i++) {
						choosen[i].setAttribute('hidden', true);
					}
					document.getElementById('button_del').setAttribute("hidden", true)
				}
				else {
					console.log("erreur ajax");
				}
			}
		}
	}
}

var getHttpRequest = function () {
	var httpRequest = false;

  if (window.XMLHttpRequest) { // Mozilla, Safari,...
  	httpRequest = new XMLHttpRequest();
  	if (httpRequest.overrideMimeType) {
  		httpRequest.overrideMimeType('text/xml');
  	}
  }
  else if (window.ActiveXObject) { // IE
  	try {
  		httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
  	}
  	catch (e) {
  		try {
  			httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
  		}
  		catch (e) {}
  	}
  }

  if (!httpRequest) {
  	alert('Abandon :( Impossible de créer une instance XMLHTTP');
  	return false;
  }

  return httpRequest
}

document.getElementById('button_del').addEventListener('click', supp_choosen, true);