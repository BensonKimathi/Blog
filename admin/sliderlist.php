<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
    <?php
        if (isset($_GET['delslider'])) {
            $delid = $_GET['delslider'];
            $delquery = "DELETE FROM tbl_slider WHERE id = '$delid' ";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo "<span class='success'>The slider was deleted successfully</span> ";
            } else {
                echo "<span class='error'>The slider deletion was unsuccessful</span> ";
            }
        }
    ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Description</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		<?php 
				$query = "SELECT * FROM tbl_slider";
				$slider = $db->select($query);
				if ($slider) {
					$i = 0;
					while ($result = $slider->fetch_assoc()) {
						$i++;
		?>
				<tr class="odd gradeX">

					<td> <?php echo $i; ?> </td>
					<td> <?php echo $result['title']; ?> </td>
					<td> <?php echo $fm->ShortenText($result['description'],60); ?> </td>
					<td> <img src="<?php echo $result['image']; ?>" height="50px" width="120px" /> </td>
					<td>
						<a style="color: green; font-size: 15px" href="viewslider.php?viewsliderid=<?php echo $result['id'] ?>">View</a>
						|| <a style="color: green; font-size: 15px" href="editslider.php?sliderid=<?php echo $result['id'] ?>">Edit</a>
						|| <a style="color: red; font-size: 15px" onclick="return confirm ('Are you sure to delete'); " href="?delslider=<?php echo $result['id'] ?>">Delete</a>				
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