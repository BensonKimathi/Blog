<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $title    = mysqli_real_escape_string($db->link, $_POST['title']);
        $category = mysqli_real_escape_string($db->link, $_POST['category']);
        $body     = mysqli_real_escape_string($db->link, $_POST['body']);
        $author   = mysqli_real_escape_string($db->link, $_POST['author']);
        $tags     = mysqli_real_escape_string($db->link, $_POST['tags']);
        $userid     = mysqli_real_escape_string($db->link, $_POST['userid']);

        $permitted = array('jpg', 'jpeg', 'png', 'gif','jfif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/post/".$unique_image;

    if ($title == "" || $category == "" || $body == "" || $author == "" || $tags == "" || $userid == "" || $file_name == "") {
           echo "<span class='error'>Field is empty and cannot be saved</span> ";
        } elseif ($file_size > 1048567) {
            echo "<span class='error'>Image size should be less than 1MB</span> ";
        } elseif (in_array($file_ext, $permitted) == false) {
            echo "<span class='error'>You can only upload ".implode(',', $permitted)." </span> ";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_post (category,title,body,image,author,tags,userid) VALUES ('$category','$title','$body','$uploaded_image','$author','$tags','$userid') ";
            $postinsert = $db->insert($query);
            if ($postinsert) {
                echo "<span class='success'>You added a new Post</span> ";
            } else {
                echo "<span class='error'>The post was not saved</span> ";
            }

        }
    }
?>
        <div class="block">               
         <form action="addpost.php" method="post" enctype="multipart/form-data">
            <table class="form">
             
                <tr>
                    <td> <label>Title</label> </td>
                    <td> <input type="text" name="title" placeholder="Enter the title here ..." 
                        class="medium" /> </td>
                </tr>        
            
                <tr>
                    <td> <label>Category</label> </td>
                    <td>
                        <select id="select" name="category">
                            <option value="1">--- Select Category ---</option>
                        <?php 
                            $query = "SELECT * FROM tbl_category";
                            $category = $db->select($query);
                            if ($category) {
                                while ($result = $category->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $result['id']; ?>">
                                <?php echo $result['name']; ?>
                            </option>
                        <?php } } ?>
                        </select>
                    </td>
                </tr>   

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;"> <label>Content</label> </td>
                    <td> <textarea class="tinymce" name="body" ></textarea> </td>
                </tr>

                <tr>
                    <td> <label>Upload Image</label> </td>
                    <td> <input type="file" name="image" /> </td>
                </tr>

                <tr>
                    <td> <label>Author</label> </td>
                    <td> 
                        <input type="text" name="author" value="<?php echo Session::get('username'); ?>" 
                        class="medium" /> 
                        <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" 
                        class="medium" /> 
                    </td>
                </tr>

                <tr>
                    <td> <label>Tags</label> </td>
                    <td> <input type="text" name="tags" placeholder="Enter the related tags" 
                        class="medium" /> </td>
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