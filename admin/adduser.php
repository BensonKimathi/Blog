<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!Session::get('userRole') == '0') {
        echo "<script> window.location= 'index.php'; </script>";
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $Username = $fm->validation($_POST['username']);
        $Password = $fm->validation(md5($_POST['password']));
        $Email = $fm->validation($_POST['email']);
        $Role = $fm->validation($_POST['role']);

        $username = mysqli_real_escape_string($db->link, $Username);
        $password = mysqli_real_escape_string($db->link, $Password);
        $email = mysqli_real_escape_string($db->link, $Email);
        $role = mysqli_real_escape_string($db->link, $Role);

        $permitted = array('jpg', 'jpeg', 'png', 'gif','jfif','bmp');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/user/".$unique_image;

        $mailquery = "SELECT * FROM tbl_user WHERE email= '$email' LIMIT 1 ";
        $mailuser = $db->select($query);

    if (empty($username) || empty($password) || empty($email) || empty($role) || empty($file_name)) { 
           echo "<span class='error'>Field is empty and cannot be saved</span> ";
        } elseif ($file_size > 1048567) {
            echo "<span class='error'>Image size should be less than 1MB</span> ";
        } elseif (in_array($file_ext, $permitted) == false) {
            echo "<span class='error'>You can only upload ".implode(',', $permitted)." </span> ";
        } elseif ($mailuser!=false ) {            
                echo "<span class='error'>This email already exits</span> ";            
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_user (username,password,email,role,image) VALUES 
                ('$username','$password','$email','$role','$uploaded_image') ";
            $useradd = $db->insert($query);
            if ($useradd) {
                echo "<span class='success'>You added a new User</span> ";
            } else {
                echo "<span class='error'>The user was not added</span> ";
            }

        }
    }
?>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
             
                <tr>
                    <td> <label>Username</label> </td>
                    <td> <input type="text" name="username" placeholder="Enter the Username here ..." 
                        class="medium" /> </td>
                </tr>        

                <tr>
                    <td> <label>Password</label> </td>
                    <td> <input type="password" name="password" placeholder="Enter Password here ..." 
                        class="medium" /> </td>
                </tr>

                <tr>
                    <td> <label>Email</label> </td>
                    <td> <input type="email" name="email" placeholder="Enter User Email here ..." 
                        class="medium" /> </td>
                </tr>

                <tr>
                    <td> <label>Upload Image</label> </td>
                    <td> <input type="file" name="image" /> </td>
                </tr>

                <tr>
                    <td> <label>User Role</label> </td>
                    <td>
                        <select id="select" name="role">
                            <option> Select User role </option>
                            <option value="0">Admin</option>
                            <option value="1">Blogger</option>
                            <option value="2">Editor</option>
                        </select>
                    </td>
                </tr>   


				<tr>
                    <td></td>
                    <td> <input type="submit" name="submit" Value="Save" /> </td>
                </tr>

            </table>
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