<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['viewpostid']) || $_GET['viewpostid'] == NULL) {
        echo "<script> window.location= 'postlist.php'; </script>";
    } else {
        $id = $_GET['viewpostid'];
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Post</h2>
        <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    }
?>              
<?php 
        $query = "SELECT * FROM tbl_post WHERE id = '$id' ORDER BY id DESC";
        $post = $db->select($query);
        while ($result = $post->fetch_assoc()) {
            
?>
        <div class="block">
       <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
             
                <tr>
                    <td> <label>Title</label> </td>
                    <td> <input type="text" readonly value="<?php echo $result['title']; ?> " 
                        class="medium" /> </td>
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
                                <?php if ($result['category'] == $result['id']) { ?> selected="selected" <?php } ?> value="<?php echo $result['id']; ?>">
                                <?php echo $result['name']; ?>
                            </option>
                        <?php } } ?>
                        </select>
                    </td>
                </tr>   

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;"> <label>Content</label> </td>
                    <td> <textarea class="tinymce" name="body" >
                        <?php echo $result['body']; ?>
                    </textarea> </td>
                </tr>

                <tr>
                    <td> <label>Upload Image</label> </td>
                    <td> <img src="<?php echo $result['image']; ?>" height="100px" weight="250px" /> 
                    </td>
                </tr>

                <tr>
                    <td> <label>Author</label> </td>
                    <td> 
                        <input type="text" readonly value="<?php echo $result['author']; ?> " 
                        class="medium" /> 
                    </td>
                </tr>

                <tr>
                    <td> <label>Tags</label> </td>
                    <td> <input type="text" readonly value="<?php echo $result['tags']; ?> " 
                        class="medium" /> </td>
                </tr>

                <tr>
                    <td></td>
                    <td> <input type="submit" name="submit" Value="Okay" /> </td>
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