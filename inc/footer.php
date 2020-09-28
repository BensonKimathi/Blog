</div>
<div class="footersection templete clear">
  <div class="footermenu clear">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="about.php">About</a></li>
		<li><a href="contact.php">Contact</a></li>
	</ul>
  </div>
<?php 
    $query = "SELECT * FROM tbl_footer WHERE id='1' ";
    $footnote = $db->select($query);
    if ($footnote) {
        while ($result = $footnote->fetch_assoc()) {
?>

  <p>&copy; <?php echo $result['note']; ?> <?php echo date('Y'); ?></p>
<?php } } ?>
</div>

<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>