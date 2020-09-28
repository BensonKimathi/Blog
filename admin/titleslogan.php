﻿<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style>
    .leftside { float: left; width: 70% }
    .rightside { float: left; width: 20% }
    .rightside img{ width: 170px; height: 160px; }
</style>             

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $title  = $fm->validation($_POST['title']);
        $slogan = $fm->validation($_POST['slogan']);
        
        $title  = mysqli_real_escape_string($db->link,$title);
        $slogan = mysqli_real_escape_string($db->link,$slogan);

        //$permitted = array('png');
        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_temp = $_FILES['logo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $same_image = 'logo'.'.'.$file_ext;
        $uploaded_image = "upload/".$same_image;

    if ($title == "" || $slogan == "") {
           echo "<span class='error'>Field is empty and cannot be saved</span> ";
        } else {
        if (!empty($file_name)) {
            if ($file_size > 1048567) {
            echo "<span class='error'>Image size should be less than 1MB</span> ";
        } elseif (in_array($file_ext, $permitted) == false) {
            echo "<span class='error'>You can only upload ".implode(',', $permitted)." </span> ";
        } else {

            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE tbl_title_slogan_logo SET title = '$title', slogan = '$slogan',logo = '$uploaded_image' WHERE id = '1' ";

            $updated_row = $db->update($query); 
            if ($updated_row) {
                echo "<span class='success'>Post was edited successfully</span> ";
            } else {
                echo "<span class='error'>Post editing was unsuccessful</span> ";
            }

        }

    } else {
            $query = "UPDATE tbl_title_slogan_logo SET title = '$title', slogan = '$slogan' WHERE id = '1' ";

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
            $query = "SELECT * FROM tbl_title_slogan_logo WHERE id='1' ";
            $blog_title = $db->select($query);
            if ($blog_title) {
                while ($result = $blog_title->fetch_assoc()) {
        ?>

        <div class="block sloginblock">

            <div class="leftside">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td> <label> Website Title </label> </td>
                        <td> <input type="text" value="<?php echo $result['title']; ?>"  name="title" 
                                class="medium" /> </td>
                    </tr>

                    <tr>
                        <td> <label>Website Slogan</label> </td>
                        <td> <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan"
                                class="medium" /> </td>
                    </tr>

                    <tr>
                         <td> <label>Upload Logo</label> </td>
                         <td> <input type="file" name="logo" class="medium"> </td>
                     </tr>

					<tr>
                        <td> </td>
                         <td> <input type="submit" name="submit" Value="Update" />  </td>
                     </tr>
               
                </table>
            </form>
            </div>
            <div class="rightside">
                <img src="<?php echo $result['logo']; ?>" alt="logo">
            </div>
        </div>
        <?php } } ?>
    </div>
</div>
<?php include 'inc/footer.php'; ?>