(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      img        = document.querySelector('img'),
      startbutton  = document.querySelector('#startbutton');

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
      height = video.videoHeight;
      width = video.videoWidth;
      canvas.setAttribute('width', 0);
      canvas.setAttribute('height', 0);
      // video.setAttribute('width', width);
      // video.setAttribute('height', height);
      // canvas.setAttribute('width', width);
      // canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.setAttribute('width', width);
    canvas.setAttribute('height', height);
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    //img.setAttribute('src', canvas.toDataURL('image/png'));
  }

  video.addEventListener('click', takepicture, false);

  // startbutton.addEventListener('click', function(ev){
  //     takepicture();
  //   ev.preventDefault();
  // }, false);

})();