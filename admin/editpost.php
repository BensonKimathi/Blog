<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['postid']) || $_GET['postid'] == NULL) {
        echo "<script> window.location= 'postlist.php'; </script>";
    } else {
        $id = $_GET['postid'];
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Post</h2>
        <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $title    = mysqli_real_escape_string($db->link, $_POST['title']);
        $category = mysqli_real_escape_string($db->link, $_POST['category']);
        $body     = mysqli_real_escape_string($db->link, $_POST['body']);
        $author   = mysqli_real_escape_string($db->link, $_POST['author']);
        $tags     = mysqli_real_escape_string($db->link, $_POST['tags']);

        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/post/".$unique_image;

    if ($title == "" || $category == "" || $body == "" || $author == "" || $tags == "") {
           echo "<span class='error'>Field is empty and cannot be saved</span> ";
        } else {
        if (!empty($file_name)) {
            if ($file_size > 1048567) {
            echo "<span class='error'>Image size should be less than 1MB</span> ";
        } elseif (in_array($file_ext, $permitted) == false) {
            echo "<span class='error'>You can only upload ".implode(',', $permitted)." </span> ";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE tbl_post SET title = '$title', category = '$category',body = '$body', image = '$uploaded_image', author = '$author',tags = '$tags' WHERE id = '$id' ";

            $updated_row = $db->update($query); 
            if ($updated_row) {
                echo "<span class='success'>Post was edited successfully</span> ";
            } else {
                echo "<span class='error'>Post editing was unsuccessful</span> ";
            }

        }

    } else {
            $query = "UPDATE tbl_post SET title = '$title', category = '$category',body = '$body', author = '$author',tags = '$tags' WHERE id = '$id' ";

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

    $query = "SELECT * FROM tbl_post WHERE id = '$id' ORDER BY id DESC";
    $post = $db->select($query);
    while ($postresult = $post->fetch_assoc()) {
            
?>

  <div class="block">
    <form action="" method="POST">
        <table class="form">
            <tr>
                <td> <label>Title</label> </td>
                <td>
                    <input type="text" name="title" value="<?php echo $postresult['title']; ?> " 
                        class="medium" />
                </td>
            </tr> 

           <tr>
                    <td> <label>Category</label> </td>
                    <td>
                        <select id="select" name="category">
                            <option><?php echo $result['category']; ?></option>
                        <?php 
                            $query = "SELECT * FROM tbl_category";
                            $category = $db->select($query);
                            if ($category) {
                                while ($result = $category->fetch_assoc()) {
                        ?>
                            <option 
                                <?php if ($postresult['category'] == $result['id']) { ?> selected="selected" <?php } ?> value="<?php echo $result['id']; ?> " >
                                <?php echo $result['name']; ?>
                            </option>
                        <?php } } ?>
                        </select>
                    </td>
                </tr>        

            <tr>
                <td style="vertical-align: top; padding-top: 9px;"> <label>Content</label> </td>
                <td> <textarea class="tinymce" name="body" >
                    <?php echo $postresult['body']; ?>
                </textarea> </td>
            </tr>

            <tr>
                <td> <label>Change Image</label> </td>
                <td> <img src="<?php echo $postresult['image']; ?>" height="80px" weight="200px" /> <br>
                    <input type="file" name="image" /> </br>
                </td>
            </tr>

            <tr>
                <td> <label>Tags</label> </td>
                <td>
                    <input type="text" name="tags" value="<?php echo $postresult['tags']; ?> " 
                        class="medium" />
                </td>
            </tr>

            <tr>
                <td> <label>Author</label> </td>
                <td>
                    <input type="text" name="author" value="<?php echo $postresult['author']; ?> " 
                        class="medium" />
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