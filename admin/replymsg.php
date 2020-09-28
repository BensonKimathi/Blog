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
        <h2>Reply Message</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $from = $fm->validation($_POST['fromEmail']);
        $to = $fm->validation($_POST['toEmail']);
        $subj = $fm->validation($_POST['subject']);
        $msg = $fm->validation($_POST['message']);

        $sendMail = mail($to, $subj, $msg, $from);
        if ($sendMail) {
            echo "<span class='success'>You replied the mail successfully</span> ";
        } else {
            echo "<span class='error'>Oops! Something went wrong</span> ";
        }
    }
?>
        <div class="block">               
         <form action="" method="post">
            <?php 
                $query = "SELECT * FROM tbl_contact WHERE id = '$id' ";
                $msg = $db->select($query);
                if ($msg) {
                    while ($result = $msg->fetch_assoc()) {
            ?>
            
            <table class="form">
                
                <tr>
                    <td> <label>From</label> </td>
                    <td> <input type="email" name="fromEmail" class="medium" /> </td>
                </tr>
                <tr>
                    <td> <label>To</label> </td>
                    <td> <input type="text" name="toEmail" readonly value="<?php echo $result['email']; ?>" class="medium" /> </td>
                </tr>
                
                <tr>
                    <td> <label>Subject</label> </td>
                    <td> 
                        <input type="text" name="subject" placeholder="Enter the subject here ..." class="medium" /> </td>
                </tr> 
                <tr>
                    <td> <label>Message</label> </td>
                    <td> 
                        <textarea class="tinymce" name="message">  </textarea>
                    </td>
                </tr>
            	<tr>
                    <td></td>
                    <td> 
                        <input type="submit" name="submit" Value="Send" /> 
                        <span class="actiondel">
                            <a href="inbox.php">Back</a>
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