<?PHP
session_start();
?>
<?php include("header.php"); ?>
<br/>
<nav>
  <?php if(isset($_SESSION['auth'])): ?>
    <div class="element_nav" onclick="location.href='log_out.php'">
      <p>Se deconnecter</p> <!-- Se deconnecter -->
    </div>
  <?php else: ?>
    <div class="element_nav" onclick="location.href='sign_up.php'">
      <p><a href="sign_up.php">Sign Up</a></p> <!-- S'enregistrer / S'inscrire -->
    </div>
    <div class="element_nav" onclick="location.href='sign_in.php'">
      <p><a href="sign_in.php">Sign In</a></p> <!-- Se connecter -->
    </div>
  <?php endif; ?>
</nav>
<br/>
<section>
  <header id="header_section">
    <h2>What is Camagru ?</h2>
    <p>Thanks to web app Camagru, take pictures using your webcam and have fun modifying them with our filters !</p>
    <p>Please register before or loggin if you have already signed up :)</p>
  </header>
  <article>
    <p>Ceci est la balise article</p>
    <video autoplay id="video"></video>
      <!-- <script type="text/javascript">
        function hasGetUserMedia() {
          return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia || navigator.msGetUserMedia);
        }

        if (hasGetUserMedia()) {
          alert('getUserMedia() is supported in your browser')
        } else {
          alert('getUserMedia() is not supported in your browser');
        }

        var errorCallback = function(e) {
          console.log('Reejected!', e);
        };

        navigator.getUserMedia({video: true}, function(localMediaStream) {
          var video = document.querySelector('video');
          video.src = window.URL.createObjectURL(localMediaStream);
          width = 380;
          height = 0;

          video.onloadedmetadata = function(e) {
              //Ready to go. Do some stuff
            };
          }, errorCallback);
        </script> -->
      </article>
      <aside>
        <p>Ceci dois appararaitre sur le cote de l'article</p>
      </aside>
    </section>
    <section>
      <!--       <img src=""> -->
      <canvas id="canvas"></canvas>
<!--       <button id="startbutton"></button>
 --><!--       <script type="text/javascript">
        var video = document.querySelector('video');
        var canvas = document.querySelector('canvas');
        var ctx = canvas.getContext('2d');
        var localMediaStream = null;
        function snapshot() {
          if (localMediaStream) {
            ctx.drawImage(video, 0, 0);
            document.querySelector('img') = canvas.toDataURL('image/png');
          }
        }

        video.addEventListener('click', snapshot, false);
        navigator.getUserMedia({video: true}, function(stream) {
          video.src = window.URL.createObjectURL(stream);
          localMediaStream = stream;
        }, errorCallback);
      </script> -->
      <script type="text/javascript" src="webrtc.js"></script>
    </section>
    <?php include("footer.php"); ?>