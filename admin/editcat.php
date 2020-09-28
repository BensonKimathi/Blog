<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script> window.location= 'catlist.php'; </script>";
    } else {
        $id = $_GET['catid'];
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
        <div class="block copyblock"> 
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $name = mysqli_real_escape_string($db->link, $name);
        if (empty($name)) {
           echo "<span class='error'>The field is empty and cannot be saved</span> ";
        } else {
            $query = "UPDATE tbl_category SET name ='$name' WHERE id = '$id' ";
            $updated_row = $db->update($query);
            if ($updated_row) {
                echo "<span class='success'>Category was edited successfully</span> ";
            } else {
                echo "<span class='error'>Category editing was unsuccessful</span> ";
            }

        }
    }
?>
    <?php 
        $query = "SELECT * FROM tbl_category WHERE id = '$id' ORDER BY id DESC";
        $category = $db->select($query);
        while ($result = $category->fetch_assoc()) {
            
    ?>
    <form action="" method="POST">
        <table class="form">
            <tr>
                <td>
                    <input type="text" name="name" value="<?php echo $result['name']; ?> " 
                        class="medium" />
                </td>
            </tr>
            <tr>
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