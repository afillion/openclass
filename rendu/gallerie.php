<?php
session_start();
?>
<?php include("header.php"); ?>

<?php require_once("config/database.php"); $req = $pdo->prepare("SELECT * FROM images"); $req->execute(); $test = $req->fetchAll();?>
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
			<?php foreach($display as $value): ?>
		<div class="display-comment">
			
			<?= $value->comment ?>
	
		</div>
			<?php endforeach; ?>
		<div class="form_com">
			<input type="text" name="comment" placeholder="150 caracteres max !">
			<button onclick="comment(this);">Send !</button>
		</div>
	<? endif; ?>
	</div>
<?php endfor; ?>
</section>
<script type="text/javascript" src="vote.js"></script>
<?php include("footer.php"); ?>