<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script> window.location= 'inbox.php'; </script>";
    } else {
        $id = $_GET['msgid'];
    }
?>
<style>
    .actiondel {margin-left: 10px;}
    .actiondel a{background:#f0f0f0 none repeat scroll 0 0; border: 1px solid #ddd; color: #444;cursor: pointer;font-size: 20px;padding: 2px 10px;}
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script> window.location= 'inbox.php'; </script>";
    }
?>
        <div class="block">               
         <form action="" method="post">
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
            <?php 
                $query = "SELECT * FROM tbl_contact WHERE id = '$id' ";
                $msg = $db->select($query);
                if ($msg) {
                    while ($result = $msg->fetch_assoc()) {
            ?>
            <table class="form">
                <tr>
                    <td> <label>Name</label> </td>
                    <td> 
                        <input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname']; ?>"     class="medium" /> </td>
                </tr>  
                <tr>
                    <td> <label>Email</label> </td>
                    <td> <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" /> </td>
                </tr>
                <tr>
                    <td> <label>Date</label> </td>
                    <td> <input type="text" readonly value="<?php echo $fm->formatDate($result['date']); ?>" 
                        class="medium" /> </td>
                </tr>
                <tr>
                    <td> <label>Message</label> </td>
                    <td> 
                        <textarea class="tinymce" name="body">
                            <?php echo $result['body']; ?>
                        </textarea>
                    </td>
                </tr>
            	<tr>
                    <td></td>
                    <td> 
                        <input type="submit" name="submit" Value="Back" />  
                        <span class="actiondel">
                            <a style="font-size: 15px" href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a>
                        </span>
                        <span class="actiondel">
                            <a style="color: red; font-size: 15px" onclick="return confirm ('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>">Delete</a>
                        </span>
                    </td>
                </tr>
            </table>
        <?php } } ?>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/tiny-mce/jquery.tinymce.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>