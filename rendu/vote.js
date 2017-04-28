function vote(btn, type) {
	var path_img = btn.parentElement.parentElement.children[0].src
	var div = btn.parentElement
	path_img = path_img.split('/');
	path_img = path_img[6];
	path_img = "montages/" + path_img;

	var data = new FormData();
	data.append("img_name", path_img);
	data.append("vote_value", type);

	ajax = getHttpRequest();
	ajax.open('POST', 'http://localhost:8080/openclass/rendu/checkvote.php', true);
	ajax.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	ajax.send(data);
	ajax.onreadystatechange = function () {
		if (ajax.readyState === 4) {
			if (ajax.status === 200) {
				var votes = JSON.parse(ajax.responseText)
				console.log("likes = " + votes.likes)
				console.log("dislikes = " + votes.dislikes)
				var btn_l = div.children[0];
				btn_l.childNodes[0].nodeValue = votes.likes;
				var btn_d = div.children[1];
				btn_d.childNodes[0].nodeValue = votes.dislikes;
			}
			else {
				console.log("err.ajax")
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