<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Users List</h2>
    <?php
        if (isset($_GET['deluser'])) {
            $deluser = $_GET['deluser'];
            $delquery = "DELETE FROM tbl_user WHERE id = '$deluser' ";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo "<span class='success'>The user information has been deleted successfully</span> ";
            } else {
                echo "<span class='error'>The user information could not be deleted</span> ";
            }
        }
    ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="7%">Serial</th>
					<th width="12%">Name</th>
					<th width="8%">Username</th>
					<th width="23%">Email</th>
					<th width="12%">Image</th>
					<th width="11%">Details</th>
					<th width="10%">Role</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
		<?php 
				$query = "SELECT * FROM tbl_user ORDER BY id DESC";
				$user = $db->select($query);
				if ($user) {
					$i = 0;
					while ($result = $user->fetch_assoc()) {
						$i++;
		?>
				<tr class="odd gradeX">

					<td> <?php echo $i; ?> </td>
					<td> <?php echo $result['name']; ?> </td>
					<td> <?php echo $result['username']; ?> </td>
					<td> <?php echo $result['email']; ?> </td>
					<td> <img src="<?php echo $result['image']; ?>" height="40px" weight="60px" /> </td>
					<td> <?php echo $fm->ShortenText($result['details'],30); ?> </td>
					<td> 
						<?php 
							if ($result['role'] == '0') {
								echo "Admin";
							} elseif ($result['role'] == '1') {
								echo "Author";
							} elseif ($result['role'] == '2') {
								echo "Editor";
							}
						?> 
					</td>

					<td>
						<a style="color: green; font-size: 15px" href="viewuser.php?userid=<?php echo $result['id'] ?>">View</a>  
						<?php if (Session::get('userRole') == '0') { ?>
						|| <a style="color: red; font-size: 15px" onclick="return confirm ('Are you sure to delete'); " href="?deluser=<?php echo $result['id'] ?>">Delete</a>
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