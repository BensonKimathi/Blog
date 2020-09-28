<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
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

    if ($title == "" || $description == "" || $file_name == "") {
           echo "<span class='error'>Field is empty and cannot be saved</span> ";
        } elseif ($file_size > 1048567) {
            echo "<span class='error'>Image size should be less than 1MB</span> ";
        } elseif (in_array($file_ext, $permitted) == false) {
            echo "<span class='error'>You can only upload ".implode(',', $permitted)." </span> ";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_slider (title,description,image) VALUES ('$title','$description','$uploaded_image') ";
            $sliderinsert = $db->insert($query);
            if ($sliderinsert) {
                echo "<span class='success'>You added a new slider</span> ";
            } else {
                echo "<span class='error'>The slider was not saved</span> ";
            }

        }
    }
?>
        <div class="block">               
         <form action="addslider.php" method="post" enctype="multipart/form-data">
            <table class="form">
             
                <tr>
                    <td> <label>Title</label> </td>
                    <td> <input type="text" name="title" placeholder="Enter the title here ..." class="medium" /> </td>
                </tr> 

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;"> <label>Content</label> </td>
                    <td> <textarea class="tinymce" name="description" ></textarea> </td>
                </tr>

                <tr>
                    <td> <label>Upload Image</label> </td>
                    <td> <input type="file" name="image" /> </td>
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
<!-- Load TinyMCE -->
<script type="text/javascript" src="js/tiny-mce/jquery.tinymce.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>