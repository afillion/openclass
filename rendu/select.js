function select (img) {
	var all = document.getElementsByClassName('filters');
	for (var i = 0; i < all.length; i++) {
		all[i].setAttribute('id', '1');
	}
	img.setAttribute('id', 'choosen');	
}