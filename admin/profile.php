<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php 
  $userid = Session::get('userId');
  $userrole = Session::get('userRole');
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Profile</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $name    = mysqli_real_escape_string($db->link, $_POST['name']);
        $username = mysqli_real_escape_string($db->link, $_POST['username']);
        $email     = mysqli_real_escape_string($db->link, $_POST['email']);
        $details   = mysqli_real_escape_string($db->link, $_POST['details']);
        $role     = mysqli_real_escape_string($db->link, $_POST['role']);

        $permitted = array('jpg', 'jpeg', 'png', 'gif','jfif','bmp');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

    if ($name == "" || $username == "" || $email == "" || $details == "" || $role == "") {
           echo "<span class='error'>Field is empty and cannot be saved</span> ";
        } else {
        if (!empty($file_name)) {
            if ($file_size > 1048567) {
            echo "<span class='error'>Image size should be less than 1MB</span> ";
        } elseif (in_array($file_ext, $permitted) == false) {
            echo "<span class='error'>You can only upload ".implode(',', $permitted)." </span> ";
        } else {

            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE tbl_user SET name = '$name', username = '$username', role = '$role',           image = '$uploaded_image', email = '$email',details = '$details' WHERE id = '$userid' ";

            $updated_row = $db->update($query); 
            if ($updated_row) {
                echo "<span class='success'>User profile was edited successfully</span> ";
            } else {
                echo "<span class='error'>User profile editing was unsuccessful</span> ";
            }
        }

    } else {
            $query = "UPDATE tbl_user SET name = '$name', username = '$username', role = '$role',
             email = '$email',details = '$details' WHERE id = '$userid' ";

            $updated_row = $db->update($query); 
            if ($updated_row) {
                echo "<span class='success'>Post was edited successfully</span> ";
            } else {
                echo "<span class='error'>Post editing was unsuccessful</span> ";
            }
    }

}

    }
?>              
<?php 
        $query = "SELECT * FROM tbl_user WHERE id = '$userid' AND role = '$userrole' ";
        $user = $db->select($query);
        if ($user) {
            while ($result = $user->fetch_assoc()) {
            
?>
        <div class="block">
       <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td> <label>Name</label> </td>
                    <td> <input type="text" name="name" value="<?php echo $result['name']; ?> " 
                        class="medium" /> </td>
                </tr> 

                <tr>
                    <td> <label>Username</label> </td>
                    <td> <input type="text" name="username" value="<?php echo $result['username']; ?> " 
                        class="medium" /> </td>
                </tr>


                <tr>
                    <td> <label>Role</label> </td>
                    <td> <input type="text" name="role" value="<?php echo $result['role']; ?> " 
                        class="medium" /> </td>
                </tr>

                <tr>
                    <td> <label>Email</label> </td>
                    <td> <input type="email" name="email" value="<?php echo $result['email']; ?> " 
                        class="medium" /> </td>
                </tr>

                <tr>
                    <td> <label>Upload Image</label> </td>
                    <td> <img src="<?php echo $result['image']; ?>" height="80px" weight="200px" /> 
                        <input type="file" name="image" /> </br>
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
                    <td> <input type="submit" name="submit" Value="Update" /> </td>
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