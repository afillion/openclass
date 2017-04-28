<?PHP
session_start();
?>
<?php include("header.php"); ?>
<section>
  <header id="header_section">
    <h2>What is Camagru ?</h2>
    <p>Thanks to web app Camagru, take pictures using your webcam and have fun modifying them with our filters !</p>
    <?php if  (empty($_SESSION['auth'])): ?>
      <p>Please register before or loggin if you have already signed up :)</p>
    <?php endif; ?>
  </header>
  <?php if ($_SESSION['auth']): ?>
    <article>
      <p>Ceci est la balise article</p>
      <video autoplay id="video"></video>
      <center>
        <!-- <form action="upload_img.php" method="POST" enctype="multipart/form-data" class="form-group"> -->
          <div class="form-group">
            <label for="">Utiliser une image (PNG) :</label>
            <input id="file" type="file" accept="image/png" name="img"/>
            <!-- <button type="submit" class="btn">Upload !</button> -->
          </div>
        <!-- </form> -->
      </center>
    </article>
    <aside>
      <p>Ceci dois appararaitre sur le cote de l'article</p>
      <canvas id="canvas" hidden ></canvas>
      <img id="photo" src="" />
    </aside>
  <?php endif; ?>
</section>
<?php if ($_SESSION['auth']): ?>
  <section id='section_filters'>
    <header id="header_section">
      <p>Choose a filter !</p>
    </header>
    <?php
    $dir = opendir("./filters");
    $allow = array("png");
    while ($file = readdir($dir)) {
      if (in_array(substr($file, -3), $allow)) {
        ?>
        <img id="" class="filters" src="filters/<?php echo $file ?>" alt="" name="<?php echo $file ?>" onclick="select(this);"/>
        <?php
      }
    }?>
  </section>
  <br/>
  <script type="text/javascript" src="select.js"></script>
  <script type="text/javascript" src="webrtc.js"></script>
<?php endif; ?>
<?php include("footer.php"); ?>