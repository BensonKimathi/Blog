<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $note = $fm->validation($_POST['note']);
            
            $note = mysqli_real_escape_string($db->link, $note);

            if ($note == "") {
                echo "<span class='error'>Field cannot be empty</span>";
            } else {
                $query = "UPDATE tbl_footer SET note = '$note' WHERE id = '1' ";
                $updatedrow = $db->update($query);
                if ($updatedrow) {
                    echo "<span class='success'>Data updated successfully</span>";
                } else {
                    echo "<span class='error'>Data not updated</span>";
                }
            }
        }
    ?>
        <div class="block copyblock"> 
        <?php 
            $query = "SELECT * FROM tbl_footer WHERE id='1' ";
            $footnote = $db->select($query);
            if ($footnote) {
                while ($result = $footnote->fetch_assoc()) {
        ?>
        <form action="copyright.php" method="post">
            <table class="form">					
                <tr>
                    <td> <input type="text" value="<?php echo $result['note']; ?>" name="note" 
                            class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td> <input type="submit" name="submit" Value="Update" /> </td>
                </tr>
            </table>
        </form>
        <?php } } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>