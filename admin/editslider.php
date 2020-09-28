<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
        echo "<script> window.location= 'sliderlist.php'; </script>";
    } else {
        $id = $_GET['sliderid'];
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Slider</h2>
        <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $title    = mysqli_real_escape_string($db->link, $_POST['title']);
        $description     = mysqli_real_escape_string($db->link, $_POST['description']);

        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/slider/".$unique_image;

    if ($title == "" || $description == "") {
           echo "<span class='error'>Field is empty and cannot be saved</span> ";
        } else {
        if (!empty($file_name)) {
            if ($file_size > 1048567) {
            echo "<span class='error'>Image size should be less than 1MB</span> ";
        } elseif (in_array($file_ext, $permitted) == false) {
            echo "<span class='error'>You can only upload ".implode(',', $permitted)." </span> ";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE tbl_slider SET title = '$title',description = '$description',
                    image = '$uploaded_image'  WHERE id = '$id' ";

            $updated_row = $db->update($query); 
            if ($updated_row) {
                echo "<span class='success'>Slider was edited successfully</span> ";
            } else {
                echo "<span class='error'>Slider editing was unsuccessful</span> ";
            }

        }

    } else {
            $query = "UPDATE tbl_slider SET title = '$title', description = '$description' WHERE id = '$id' ";

            $updated_row = $db->update($query); 
            if ($updated_row) {
                echo "<span class='success'>Slider was edited successfully</span> ";
            } else {
                echo "<span class='error'>Slider editing was unsuccessful</span> ";
            }
    }

}

    }
?>              
<?php 
        $query = "SELECT * FROM tbl_slider WHERE id = '$id' ORDER BY id DESC";
        $slider = $db->select($query);
        while ($result = $slider->fetch_assoc()) {
            
?>
        <div class="block">
       <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
             
                <tr>
                    <td> <label>Title</label> </td>
                    <td> <input type="text" name="title" value="<?php echo $result['title']; ?> " 
                        class="medium" /> </td>
                </tr>          

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;"> <label>Description</label> </td>
                    <td> <textarea class="tinymce" name="description" >
                        <?php echo $result['description']; ?>
                    </textarea> </td>
                </tr>

                <tr>
                    <td> <label>Change Image</label> </td>
                    <td> <img src="<?php echo $result['image']; ?>" height="80px" weight="200px" /> 
                        <input type="file" name="image" /> </br>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td> <input type="submit" name="submit" Value="Save" /> </td>
                </tr>

            </table>
            </form>
<?php } ?>
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