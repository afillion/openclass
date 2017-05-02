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

function comment(btn, input) {
	var path_img = btn.parentElement.parentElement.children[0].src
	path_img = path_img.split('/')
	path_img = path_img[6];
	path_img = "montages/" + path_img;
	var input = btn.parentElement.children[0].value;
	var parent = btn.parentElement.parentElement

	var data = new FormData();
	data.append("img_name", path_img);
	data.append("comment", input);

	var ajax = getHttpRequest();
	ajax.open('POST', 'http://localhost:8080/openclass/rendu/comment.php', true);
	ajax.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	ajax.send(data);
	ajax.onreadystatechange = function () {
		if (ajax.readyState === 4) {
			if (ajax.status === 200) {
				console.log(parent);
				var i = parent.childElementCount - 1
				var add_before = parent.children[i]
				var comment = document.createElement('div');
				comment.setAttribute('class', 'display-comment')
				comment.innerHTML = ajax.responseText
				parent.insertBefore(comment, add_before)

			}
			else if (ajax.status === 201) {
				var div = document.getElementsByClassName('alert-wrong');
				if (div.length > 0) {
					div = div[0]
					div.removeChild(div.childNodes[0]);
					div.innerHTML = "<p>" + ajax.responseText + "</p>"
				}
				else {
				var div = document.createElement('div');
				div.setAttribute("class", "alert-wrong");
				div.innerHTML = "<p>" + ajax.responseText + "</p>";
				var nav = document.getElementsByTagName('nav');
				nav = nav[0];
				nav.parentNode.insertBefore(div, nav.nextSibling.nextElementSibling);
				//window.location.reload();
				}
			}
			else {
				//err
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