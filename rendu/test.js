  function hasGetUserMedia() 
  {
    return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
      navigator.mozGetUserMedia || navigator.msGetUserMedia);
  }

  if (hasGetUserMedia()) 
  {
    alert('getUserMedia() is supported in your browser')
  } 
  else 
  {
    alert('getUserMedia() is not supported in your browser');
  }

  var errorCallback = function(e) 
  {
    console.log('Reejected!', e);
  };

  navigator.getUserMedia({video: true}, function(localMediaStream) 
  {
    var video = document.querySelector('video');
    video.src = window.URL.createObjectURL(localMediaStream);

    video.onloadedmetadata = function(e) 
    {
      //Ready to go. Do some stuff
    };
  }
  , errorCallback);

  var video = document.querySelector('video');
  var canvas = document.querySelector('canvas');
  var ctx = canvas.getContext('2d');
  //var localMediaStream = null;

  function snapshot() 
  {
    if (localMediaStream) 
    {
      ctx.drawImage(video, 0, 0);
      document.querySelector('img') = canvas.toDataURL('image/png');
    }
  }

  video.addEventListener('click', snapshot, false);
  
  navigator.getUserMedia({video: true}, function(stream) 
  {
    video.src = window.URL.createObjectURL(stream);
    localMediaStream = stream;
  }
  , errorCallback);
