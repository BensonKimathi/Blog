<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        if (isset($_GET['seenid'])) {
            $seenid = $_GET['seenid'];
            $query = "UPDATE tbl_contact SET status ='1' WHERE id = '$seenid' ";
            $updated_row = $db->update($query);
            if ($updated_row) {
                echo "<span class='success'>Message sent to the seen box</span> ";
            } else {
                echo "<span class='error'>Oops! Something is wrong</span> ";
            }

        }
    ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id DESC";
				$message = $db->select($query);
				if ($message) {
					$i = 0;
					while ($result = $message->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td> <?php echo $result['email']; ?> </td>
					<td> <?php echo $fm->ShortenText($result['body'],30); ?> </td>
					<td> <?php echo $fm->formatDate($result['date']); ?> </td>
					<td>
						<a style="color: green; font-size: 15px" href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || 
						<a style="font-size: 15px" href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> || 
						<a style="color: #2543ae; font-size: 15px" onclick="return confirm ('Are you sure to move the message to seen box?');" href="?seenid=<?php echo $result['id']; ?>">Seen</a> 
					</td>
					
				</tr>
			<?php } } ?>
				
			</tbody>
		</table>
       </div>
    </div>

    <div class="box round first grid">
        <h2>Seen Messages</h2>
    <?php
        if (isset($_GET['delid'])) {
            $delid = $_GET['delid'];
            $delquery = "DELETE FROM tbl_contact WHERE id = '$delid' ";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo "<span class='success'>The message was deleted successfully</span> ";
            } else {
                echo "<span class='error'>The message deletion was unsuccessful</span> ";
            }
        }
    ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY id DESC";
				$message = $db->select($query);
				if ($message) {
					$i = 0;
					while ($result = $message->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td> <?php echo $result['email']; ?> </td>
					<td> <?php echo $fm->ShortenText($result['body'],30); ?> </td>
					<td> <?php echo $fm->formatDate($result['date']); ?> </td>
					<td>
						<a style="color: green; font-size: 15px" href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
						<a style="color: red; font-size: 15px" onclick="return confirm ('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>">Delete</a> 
					</td>
					
				</tr>
			<?php } } ?>
				
			</tbody>
		</table>
       </div>
    </div>

</div>
<?php include 'inc/footer.php'; ?>