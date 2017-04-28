function select (img) {

	if (document.getElementById('photo').src != "http://localhost:8080/openclass/rendu/index.php") {
		var all = document.getElementsByClassName('filters');
		for (var i = 0; i < all.length; i++) {
			all[i].setAttribute('id', '1');
		}
		img.setAttribute('id', 'choosen');
	}
	
	if (document.getElementById('photo').src != "http://localhost:8080/openclass/rendu/index.php" && document.getElementById('choosen') != null) {
		var data = new FormData();
		var getcanvas = canvas.toDataURL('image/png');
    	document.getElementById('photo').setAttribute('src', getcanvas);
		data.append('img', document.getElementById('photo').src);
		data.append('filter', document.getElementById('choosen').src)
		var ajax = getHttpRequest();
		ajax.open('POST', 'http://localhost:8080/openclass/rendu/montage.php', true);
		ajax.setRequestHeader('X-Requested-With', 'xmlhttprequest');
		ajax.send(data);
		ajax.onreadystatechange = function() {
			if (ajax.readyState === 4) {
				if (ajax.status === 200) {
					document.getElementById('photo').src = ajax.responseText;
					var aside = document.getElementsByTagName('aside');
					var image = document.getElementById('photo').src;
					image = image.split(",");
					image = image[1];
					var tosend = document.getElementById('tosend');

					if (!tosend) {
						var div = document.createElement('div');
						div.setAttribute('class', 'form-group');

						var form = document.createElement('form');
						form.setAttribute('action', 'save_montage.php');
						form.setAttribute('method', 'POST');
						form.setAttribute('class', 'form-action');
						form.setAttribute('id', 'toto');

						var input_txt = document.createElement('input');
						input_txt.setAttribute('type', 'text');
						input_txt.setAttribute('name', 'save_img');
						input_txt.setAttribute('value', image);
						input_txt.setAttribute('hidden', true);
						input_txt.setAttribute('id', 'tosend');

						var input_btn = document.createElement('input');
						input_btn.setAttribute('type', 'submit');
						input_btn.setAttribute('class', 'btn');
						input_btn.setAttribute('value', 'Save ?');

						div.appendChild(input_txt);
						div.appendChild(input_btn);
						form.appendChild(div);
						aside[0].appendChild(form);
					}
					else {
						tosend.setAttribute('value', image);
					}
				}
				else {
					//le serveur a renvoye un status d'erreur
				}
			}
		}
	}
}

var imageLoader = document.getElementById('file');
imageLoader.addEventListener('change', handleImage, false);
var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

function handleImage(e){
	var reader = new FileReader();
	reader.onload = function(event){
		var img = new Image();
		img.onload = function(){
			canvas.width = img.width;
			canvas.height = img.height;
			ctx.drawImage(img,0,0);
		}
		img.src = event.target.result;
	}
	reader.readAsDataURL(e.target.files[0]);
	var getcanvas = canvas.toDataURL('image/png');
    document.getElementById('photo').setAttribute('src', getcanvas);   
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

// function section_filters() {
// 	alert('section_filters');
// 	if (document.getElementById('photo').src == "http://localhost:8080/openclass/rendu/index.php") {
// 		document.getElementById("section_filters").setAttribute("style", "hidden");
// 	}
// }