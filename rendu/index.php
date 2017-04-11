<?PHP
session_start();
?>
<?php include("header.php"); ?>
<section>
  <header id="header_section">
    <h2>What is Camagru ?</h2>
    <p>Thanks to web app Camagru, take pictures using your webcam and have fun modifying them with our filters !</p>
    <p>Please register before or loggin if you have already signed up :)</p>
  </header>
  <article>
    <p>Ceci est la balise article</p>
    <video autoplay id="video"></video>
  </article>
  <aside>
    <p>Ceci dois appararaitre sur le cote de l'article</p>
    <canvas id="canvas"></canvas>
  </aside>
</section>
<script type="text/javascript" src="webrtc.js"></script>
<?php include("footer.php"); ?>