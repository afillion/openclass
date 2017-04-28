(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 320,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  function clickcam() {
    takepicture();
    section_filters();
  }

  video.addEventListener('click', clickcam, false);

  function section_filters() {
    if (document.getElementById('photo').src == "http://localhost:8080/openclass/rendu/index.php") {
      var section_filter = document.getElementById("section_filters");
      section_filter.setAttribute("hidden", true);
      var i = 0;
      while (i < section_filter.children.length) {
        section_filter.children[i].setAttribute('hidden', true);
        for (var j = 0; j < section_filter.children[i].children.length; j++) {
          section_filter.children[i].children[j].setAttribute('hidden', true);
          j++;
        }
        i++;
      }
    }
    if (document.getElementById('photo').src != "http://localhost:8080/openclass/rendu/index.php") {
      var section_filter = document.getElementById("section_filters");
      section_filter.removeAttribute("hidden");
      var i = 0;
      while (i < section_filter.children.length) {
        section_filter.children[i].removeAttribute('hidden');
        for (var j = 0; j < section_filter.children[i].children.length; j++) {
          section_filter.children[i].children[j].removeAttribute('hidden');
          j++;
        }
        i++;
      }
    }
  }
  window.onload = section_filters();

  // startbutton.addEventListener('click', function(ev){
  //     takepicture();
  //   ev.preventDefault();
  // }, false);

})();