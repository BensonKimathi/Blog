<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
        echo "<script> window.location= 'userlist.php'; </script>";
    } else {
        $id = $_GET['userid'];
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Profile</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script> window.location= 'userlist.php'; </script>";
    }
?>              
<?php 
        $query = "SELECT * FROM tbl_user WHERE id = '$id' ";
        $user = $db->select($query);
        if ($user) {
            while ($result = $user->fetch_assoc()) {
            
?>
        <div class="block">
       <form action="" method="post" >
            <table class="form">
                <tr>
                    <td> <label>Name</label> </td>
                    <td> <input type="text" readonly value="<?php echo $result['name']; ?> " 
                        class="medium" /> </td>
                </tr> 

                <tr>
                    <td> <label>Username</label> </td>
                    <td> <input type="text" readonly value="<?php echo $result['username']; ?> " 
                        class="medium" /> </td>
                </tr>

                <tr>
                    <td> <label>Email</label> </td>
                    <td> <input type="email" readonly value="<?php echo $result['email']; ?> " 
                        class="medium" /> </td>
                </tr>

                <tr>
                    <td> <label>User Photo</label> </td>
                    <td> <img src="<?php echo $result['image']; ?>" height="80px" weight="200px" /> </br>
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;"> <label>Details</label> </td>
                    <td> <textarea class="tinymce" name="details" >
                        <?php echo $result['details']; ?>
                    </textarea> </td>
                </tr>                
                
                <tr>
                    <td></td>
                    <td> <input type="submit" name="submit" Value="Okay" /> </td>
                </tr>

            </table>
            </form>
<?php } } ?>
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