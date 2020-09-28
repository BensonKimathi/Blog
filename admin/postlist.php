<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
    <?php
        if (isset($_GET['delpost'])) {
            $delid = $_GET['delpost'];
            $delquery = "DELETE FROM tbl_post WHERE id = '$delid' ";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo "<span class='success'>The post was deleted successfully</span> ";
            } else {
                echo "<span class='error'>The post deletion was unsuccessful</span> ";
            }
        }
    ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="6%">Serial</th>
					<th width="14%">Post Title</th>
					<th width="8%">Category</th>
					<th width="23%">Description</th>
					<th width="9%">Image</th>
					<th width="10%">Author</th>
					<th width="10%">Tags</th>
					<th width="10%">Date</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$query = "SELECT tbl_post.*, tbl_category.name
			FROM tbl_post 
			INNER JOIN tbl_category ON tbl_post.category = tbl_category.id
			ORDER BY tbl_post.id DESC";
	
				$post = $db->select($query);
				if ($post) {
					$i = 0;
					while ($result = $post->fetch_assoc()) {
						$i++;
		?>
				<tr class="odd gradeX">

					<td> <?php echo $i; ?> </td>
					<td> <?php echo $result['title']; ?> </td>
					<td> <?php echo $result['name']; ?> </td>
					<td> <?php echo $fm->ShortenText($result['body'],50); ?> </td>
					<td> <img src="<?php echo $result['image']; ?>" height="40px" weight="60px" /> </td>
					<td> <?php echo $result['author']; ?> </td>
					<td> <?php echo $result['tags']; ?> </td>
					<td> <?php echo $fm->formatDate($result['date']); ?> </td>

					<td>
						<a style="color: green; font-size: 15px" href="viewpost.php?viewpostid=<?php echo $result['id'] ?>">View</a>
					<?php if (Session::get('userId') == $result['id'] || Session::get('userRole')== '0') { ?>
						|| <a style="color: green; font-size: 15px" href="editpost.php?postid=<?php echo $result['id'] ?>">Edit</a>
						|| <a style="color: red; font-size: 15px" onclick="return confirm ('Are you sure to delete'); " href="?delpost=<?php echo $result['id'] ?>">Delete</a>
					<?php } ?>
						
					</td>
					
				</tr>
		<?php } } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>