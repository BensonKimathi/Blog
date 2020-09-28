<?php include 'inc/header.php'; ?>
<?php 
	$postid = mysqli_real_escape_string($db->link, $_GET['id']);
	if (!isset($postid) || $postid == NULL) {
			header("Location:404.php");
		}else{
			$id = $_GET['id'];
		}				
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">

				<?php 
					$query = "SELECT * FROM tbl_post WHERE id = '$id' ";
					$post = $db->select($query);
						if ($post) {
							while ($result = $post->fetch_assoc()) {
				?>

				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="post image"/>
				<p><?php echo $result['body']; ?></p>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php 
						$catid = $result['category'];
						$rltquery = "SELECT * FROM tbl_post WHERE category = '$catid' ORDER BY rand() LIMIT 5";
						$relatedpost = $db->select($rltquery);
						if ($relatedpost) {
							while ($rresult = $relatedpost->fetch_assoc()) {
					?>

					<a href="post.php?id=<?php echo $rresult['id']; ?>">
						<img src="admin/<?php echo $rresult['image']; ?> " alt="post image"/>
					</a>
					<?php } } else echo "No related post available"; ?>

				</div>

			<?php } } else { header("Location:404.php"); } ?>
	</div>

		</div>
		<?php include 'inc/sidebar.php'; ?>

<?php include 'inc/footer.php'; ?>