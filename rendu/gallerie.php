<?php
session_start();
?>
<?php include("header.php"); ?>

<?php 
require_once("config/database.php"); 

$req = $pdo->prepare("SELECT COUNT(*) AS nb FROM images");
$req->execute();
$nb_img = $req->fetch();
$nb_img = $nb_img->nb;
$nb_page = ceil($nb_img/10);

if (isset($_GET['page'])) {
	$page = intval($_GET['page']);
	if ($page > $nb_page) {
		$page = $nb_page;
	}
}
else {
	$page = 1;
}

$offset = ($page - 1) * 10;
?>

<?php $req = $pdo->prepare("SELECT * FROM images ORDER BY id ASC LIMIT 10 OFFSET " .$offset); $req->execute(); $test = $req->fetchAll();?>
<section>
	<?php
	$i = 0;
	while ($test[$i]) {
		$i++;
	}
	for ($j = 0; $j < $i; $j++): ?>
	<div class="vote">
		<img src="<?php echo $test[$j]->path ?>">	
		<div class="vote_bar">
			<div class="vote_progress" style="width: <?= ($test[$j]->likes + $test[$j]->dislikes) == 0 ? 100 : (100 * ($test[$j]->likes / ($test[$j]->likes + $test[$j]->dislikes)))?>%"></div>
		</div>
		<?php if ($_SESSION['auth']): ?>
		<div class="vote_btns">
			<button class="vote_btn vote_like" onclick="vote(this, 1);"> <?php $req = $pdo->prepare("SELECT likes FROM images WHERE path = ?"); $req->execute([$test[$j]->path]); $likes = $req->fetch(); $likes = $likes->likes; echo $likes; ?> <i class="fa fa-thumbs-up"></i></button>
			<button class="vote_btn vote_dislike" onclick="vote(this, -1);"> <?php $req = $pdo->prepare("SELECT dislikes FROM images WHERE path = ?"); $req->execute([$test[$j]->path]); $dislikes = $req->fetch(); $dislikes = $dislikes->dislikes; echo $dislikes; ?> <i class="fa fa-thumbs-down"></i></button>
		</div>
		<?php $req = $pdo->prepare("SELECT * FROM comments WHERE id_img = ?"); $req->execute([$test[$j]->id]); $display = $req->fetchAll(); ?>
				<div class="display-comment">
			<?php foreach($display as $value): ?>
			<p><?=$value->comment_username?> says: "<?=$value->comment?>"</p>
			<?php endforeach; ?>
					</div>
		<div class="form_com">
			<input type="text" name="comment" placeholder="150 caracteres max !">
			<button onclick="comment(this);">Send !</button>
		</div>
	<? endif; ?>
	</div>
<?php endfor; ?>
	<div id="page">
<?php  for ($i=1; $i <= $nb_page; $i++): ?>
	 <a href="gallerie.php?page=<?=$i?>"><?=$i?></a>
<?php endfor; ?>
	</div>
</section>
<script type="text/javascript" src="vote.js"></script>
<?php include("footer.php"); ?>